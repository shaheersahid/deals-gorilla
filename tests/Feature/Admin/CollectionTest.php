<?php

namespace Tests\Feature\Admin;

use App\Models\Collection;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class CollectionTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;
    protected $category;
    protected $collection;
    protected $product1;
    protected $product2;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'is_admin' => 1,
            'is_active' => 1,
        ]);

        $this->category = Category::create([
            'name' => 'Test Category',
            'slug' => 'test-category',
            'is_active' => true,
        ]);

        $this->collection = Collection::create([
            'name' => 'Test Collection',
            'slug' => 'test-collection',
            'type' => 'grid',
            'is_active' => true,
        ]);
        
        $this->product1 = Product::create([
             'name' => 'Product 1',
             'slug' => 'product-1',
             'price' => 100,
             'category_id' => $this->category->id,
             'is_active' => true,
             'description' => 'Test Description 1',
        ]);

        $this->product2 = Product::create([
             'name' => 'Product 2',
             'slug' => 'product-2',
             'price' => 200,
             'category_id' => $this->category->id,
             'is_active' => true,
             'description' => 'Test Description 2',
        ]);

        $this->collection->products()->attach([
            $this->product1->id => ['sort_order' => 1],
            $this->product2->id => ['sort_order' => 2],
        ]);
    }

    /** @test */
    public function an_admin_can_create_a_collection()
    {
        $response = $this->actingAs($this->admin)->post(route('collections.store'), [
            'name' => 'Featured Products',
            'type' => 'slider',
            'is_active' => 1,
        ]);

        $response->assertRedirect(route('collections.index'));
        $this->assertDatabaseHas('collections', ['name' => 'Featured Products']);
    }

    /** @test */
    public function an_admin_can_assign_products_to_a_collection()
    {
        $response = $this->actingAs($this->admin)->put(route('collections.update', $this->collection->id), [
            'name' => 'Updated Collection',
            'type' => 'grid',
            'product_ids' => [$this->product1->id],
        ]);

        $response->assertRedirect(route('collections.index'));
        $this->assertEquals(1, $this->collection->fresh()->products()->count());
    }

    /** @test */
    public function a_collection_can_toggle_status()
    {
        $response = $this->actingAs($this->admin)->post(route('collections.toggle-status'), [
            'id' => $this->collection->id,
            'value' => 0,
        ]);

        $response->assertJson(['success' => true]);
        $this->assertFalse($this->collection->fresh()->is_active);
    }

    /** @test */
    public function an_admin_can_reorder_collection_products()
    {
        $response = $this->actingAs($this->admin)->postJson(route('collections.reorder'), [
            'collection_id' => $this->collection->id,
            'order' => [
                ['id' => $this->product1->id, 'position' => 2],
                ['id' => $this->product2->id, 'position' => 1],
            ]
        ]);

        $response->assertSuccessful();

        // Refresh verification
        $p1Order = DB::table('collection_product')
            ->where('collection_id', $this->collection->id)
            ->where('product_id', $this->product1->id)
            ->value('sort_order');
            
        $p2Order = DB::table('collection_product')
            ->where('collection_id', $this->collection->id)
            ->where('product_id', $this->product2->id)
            ->value('sort_order');

        $this->assertEquals(2, $p1Order);
        $this->assertEquals(1, $p2Order);
    }

    /** @test */
    public function an_admin_can_view_collection_products_datatable_with_correct_order()
    {
        // 1: P1, 2: P2
        $response = $this->actingAs($this->admin)->getJson(route('collections.products', [
            'collection' => $this->collection->id,
            'draw' => 1,
            'columns' => [
                ['data' => 'sort_order', 'name' => 'sort_order', 'searchable' => 'false', 'orderable' => 'true', 'search' => ['value' => '', 'regex' => 'false']],
            ],
            'order' => [
                ['column' => 0, 'dir' => 'asc']
            ],
            'length' => 10,
            'search' => ['value' => '', 'regex' => 'false']
        ]), ['X-Requested-With' => 'XMLHttpRequest']);

        $response->assertSuccessful();

        $content = $response->json();
        $data = $content['data'];
        
        // P1 should be first (order 1)
        $this->assertEquals($this->product1->id, $data[0]['id']);
        $this->assertEquals(1, $data[0]['sort_order']);
        $this->assertEquals($this->product2->id, $data[1]['id']);
        $this->assertEquals(2, $data[1]['sort_order']);
    }
}
