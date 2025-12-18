<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\AttributeOption;
use App\Models\Product;
use App\Models\ProductSpecification;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DemoDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Seeding demo data...');

        // Seed Brands
        $brands = $this->seedBrands();
        $this->command->info('✓ Seeded ' . count($brands) . ' brands');

        // Seed Categories
        $categories = $this->seedCategories();
        $this->command->info('✓ Seeded ' . count($categories) . ' categories');

        // Seed Attributes
        $attributes = $this->seedAttributes();
        $this->command->info('✓ Seeded ' . count($attributes) . ' attributes');

        // Seed Products
        $products = $this->seedProducts($brands, $categories);
        $this->command->info('✓ Seeded ' . count($products) . ' products');

        $this->command->info('Demo data seeding completed!');
    }

    private function seedBrands()
    {
        $brandNames = [
            'Samsung', 'Apple', 'Sony', 'LG', 'Nike',
            'Adidas', 'IKEA', 'Herman Miller', 'LEGO', 'Mattel',
            'Hasbro', 'Fisher-Price', 'Zara', 'H&M', 'Uniqlo'
        ];

        $brands = [];
        foreach ($brandNames as $name) {
            $brands[] = Brand::firstOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name]
            );
        }

        return collect($brands);
    }

    private function seedCategories()
    {
        $categoryData = [
            ['name' => 'Electronics', 'icon' => 'fa-laptop'],
            ['name' => 'Furniture', 'icon' => 'fa-couch'],
            ['name' => 'Toys', 'icon' => 'fa-gamepad'],
            ['name' => 'Clothing', 'icon' => 'fa-tshirt'],
            ['name' => 'Sports & Outdoors', 'icon' => 'fa-running'],
            ['name' => 'Home & Kitchen', 'icon' => 'fa-home'],
        ];

        $categories = [];
        foreach ($categoryData as $data) {
            $categories[] = Category::firstOrCreate(
                ['slug' => Str::slug($data['name'])],
                [
                    'name' => $data['name'],
                    'icon' => $data['icon'],
                    'is_active' => true,
                ]
            );
        }

        return collect($categories);
    }

    private function seedAttributes()
    {
        $attributes = [];

        // Size Attribute
        $size = Attribute::firstOrCreate(
            ['slug' => 'size'],
            [
                'name' => 'Size',
                'type' => 'select',
                'is_variant' => true,
                'is_filterable' => true,
                'is_visible' => true,
            ]
        );
        
        $sizeOptions = ['XS', 'S', 'M', 'L', 'XL', 'XXL'];
        foreach ($sizeOptions as $index => $value) {
            AttributeOption::firstOrCreate(
                ['attribute_id' => $size->id, 'value' => strtolower($value)],
                ['label' => $value, 'sort_order' => $index]
            );
        }
        $attributes[] = $size;

        // Color Attribute
        $color = Attribute::firstOrCreate(
            ['slug' => 'color'],
            [
                'name' => 'Color',
                'type' => 'color',
                'is_variant' => true,
                'is_filterable' => true,
                'is_visible' => true,
            ]
        );
        
        $colors = [
            ['Black', '#000000'],
            ['White', '#FFFFFF'],
            ['Red', '#FF0000'],
            ['Blue', '#0000FF'],
            ['Green', '#00FF00'],
            ['Yellow', '#FFFF00'],
        ];
        foreach ($colors as $index => $colorData) {
            AttributeOption::firstOrCreate(
                ['attribute_id' => $color->id, 'value' => strtolower($colorData[0])],
                [
                    'label' => $colorData[0],
                    'color_code' => $colorData[1],
                    'sort_order' => $index,
                ]
            );
        }
        $attributes[] = $color;

        // Material Attribute
        $material = Attribute::firstOrCreate(
            ['slug' => 'material'],
            [
                'name' => 'Material',
                'type' => 'select',
                'is_variant' => false,
                'is_filterable' => true,
                'is_visible' => true,
            ]
        );
        
        foreach (['Wood', 'Metal', 'Plastic', 'Fabric', 'Leather', 'Glass'] as $index => $value) {
            AttributeOption::firstOrCreate(
                ['attribute_id' => $material->id, 'value' => strtolower($value)],
                ['label' => $value, 'sort_order' => $index]
            );
        }
        $attributes[] = $material;

        // Storage Attribute (for electronics)
        $storage = Attribute::firstOrCreate(
            ['slug' => 'storage'],
            [
                'name' => 'Storage',
                'type' => 'select',
                'is_variant' => true,
                'is_filterable' => true,
                'is_visible' => true,
            ]
        );
        
        foreach (['64GB', '128GB', '256GB', '512GB', '1TB'] as $index => $value) {
            AttributeOption::firstOrCreate(
                ['attribute_id' => $storage->id, 'value' => strtolower($value)],
                ['label' => $value, 'sort_order' => $index]
            );
        }
        $attributes[] = $storage;

        return $attributes;
    }

    private function seedProducts($brands, $categories)
    {
        $products = [];
        $productData = $this->getProductData();

        foreach ($productData as $data) {
            $category = $categories->firstWhere('name', $data['category']);
            $brand = $brands->firstWhere('name', $data['brand']);

            if (!$category || !$brand) continue;

            $slug = Str::slug($data['name']);
            
            $product = Product::updateOrCreate(
                ['slug' => $slug],
                [
                    'name' => $data['name'],
                    'category_id' => $category->id,
                    'brand_id' => $brand->id,
                    'short_desc' => $data['short_desc'],
                    'description' => $data['description'],
                    'price' => $data['price'],
                    'cost_price' => $data['price'] * 0.6,
                    'stock' => $data['stock'],
                    'is_featured' => $data['is_featured'] ?? false,
                    'is_active' => true,
                    'has_variants' => false,
                    'deal_enabled' => $data['deal_enabled'] ?? false,
                    'deal_price' => $data['deal_price'] ?? null,
                    'deal_start' => ($data['deal_enabled'] ?? false) ? now()->subDays(rand(1, 5)) : null,
                    'deal_end' => ($data['deal_enabled'] ?? false) ? now()->addDays(rand(5, 30)) : null,
                    'percentage_off' => $data['percentage_off'] ?? null,
                    'is_out_of_stock' => $data['stock'] == 0,
                ]
            );

            // Add specifications
            if (isset($data['specs'])) {
                ProductSpecification::updateOrCreate(
                    ['product_id' => $product->id],
                    [
                        'weight' => $data['specs']['weight'] ?? null,
                        'weight_unit' => 'kg',
                        'length' => $data['specs']['length'] ?? null,
                        'width' => $data['specs']['width'] ?? null,
                        'height' => $data['specs']['height'] ?? null,
                        'dimension_unit' => 'cm',
                        'specs' => $data['specs']['custom'] ?? null,
                    ]
                );
            }

            $products[] = $product;
            
            // Add real images immediately
            $this->addProductImage($product);
        }

        return collect($products);
    }

    private function addProductImage($product)
    {
        $categoryName = $product->category?->name ?? 'product';
        
        // High-quality Unsplash mapping
        $imageUrl = "https://images.unsplash.com/photo-1523275335684-37898b6baf30?q=80&w=800&auto=format&fit=crop"; // Watch (Def)
        
        if (Str::contains(strtolower($categoryName), 'electronics')) {
            $imageUrl = "https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?q=80&w=800&auto=format&fit=crop"; // Phone
            if (Str::contains(strtolower($product->name), 'tv')) $imageUrl = "https://images.unsplash.com/photo-1593359677879-a4bb92f829d1?q=80&w=800&auto=format&fit=crop";
            if (Str::contains(strtolower($product->name), 'laptop')) $imageUrl = "https://images.unsplash.com/photo-1517336714731-489689fd1ca8?q=80&w=800&auto=format&fit=crop";
        } elseif (Str::contains(strtolower($categoryName), 'furniture')) {
            $imageUrl = "https://images.unsplash.com/photo-1524758631624-e2822e304c36?q=80&w=800&auto=format&fit=crop"; // Chair
            if (Str::contains(strtolower($product->name), 'bed')) $imageUrl = "https://images.unsplash.com/photo-1505691723518-36a5ac3be353?q=80&w=800&auto=format&fit=crop";
        } elseif (Str::contains(strtolower($categoryName), 'clothing')) {
            $imageUrl = "https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=800&auto=format&fit=crop"; // Red Shoe
        } elseif (Str::contains(strtolower($categoryName), 'toys')) {
            $imageUrl = "https://images.unsplash.com/photo-1585366119957-e9730b6d0f60?q=80&w=800&auto=format&fit=crop"; // Lego
        } elseif (Str::contains(strtolower($categoryName), 'sports')) {
            $imageUrl = "https://images.unsplash.com/photo-1517836357463-d25dfeac3438?q=80&w=800&auto=format&fit=crop"; // Gym
        }

        \App\Models\Image::updateOrCreate(
            [
                'image_type' => Product::class,
                'image_id' => $product->id,
                'is_primary' => true
            ],
            [
                'orig_path' => $imageUrl,
                'thumb_path' => $imageUrl,
                'description' => $product->name,
                'order' => 0,
            ]
        );
    }

    private function getProductData()
    {
        return [
            // Electronics
            [
                'name' => 'Samsung Galaxy S23 Ultra',
                'category' => 'Electronics',
                'brand' => 'Samsung',
                'short_desc' => 'Latest flagship smartphone with advanced camera',
                'description' => 'Premium smartphone with 200MP camera, S Pen, and powerful performance for professionals and creators.',
                'price' => 1199.99,
                'stock' => 25,
                'is_featured' => true,
                'deal_enabled' => true,
                'deal_price' => 999.99,
                'percentage_off' => 16.67,
                'specs' => ['weight' => 0.234, 'length' => 16.3, 'width' => 7.8, 'height' => 0.89],
            ],
            [
                'name' => 'iPhone 15 Pro Max',
                'category' => 'Electronics',
                'brand' => 'Apple',
                'short_desc' => 'Titanium design with A17 Pro chip',
                'description' => 'Revolutionary iPhone with titanium design, advanced camera system, and the most powerful chip in a smartphone.',
                'price' => 1299.99,
                'stock' => 30,
                'is_featured' => true,
                'deal_enabled' => false,
                'specs' => ['weight' => 0.221, 'length' => 15.9, 'width' => 7.6, 'height' => 0.83],
            ],
            [
                'name' => 'Sony WH-1000XM5 Headphones',
                'category' => 'Electronics',
                'brand' => 'Sony',
                'short_desc' => 'Industry-leading noise cancellation',
                'description' => 'Premium wireless headphones with exceptional sound quality and best-in-class noise cancellation.',
                'price' => 399.99,
                'stock' => 50,
                'deal_enabled' => true,
                'deal_price' => 329.99,
                'percentage_off' => 17.5,
                'specs' => ['weight' => 0.25],
            ],
            [
                'name' => 'LG OLED C3 55 inch TV',
                'category' => 'Electronics',
                'brand' => 'LG',
                'short_desc' => '4K OLED TV with perfect blacks',
                'description' => 'Stunning OLED display with infinite contrast, perfect for movies and gaming.',
                'price' => 1499.99,
                'stock' => 15,
                'is_featured' => true,
                'specs' => ['weight' => 18.5, 'length' => 122.8, 'width' => 70.6, 'height' => 4.6],
            ],
            [
                'name' => 'Samsung 27" 4K Monitor',
                'category' => 'Electronics',
                'brand' => 'Samsung',
                'short_desc' => 'Professional 4K display',
                'description' => 'High-resolution monitor perfect for creative professionals and productivity.',
                'price' => 449.99,
                'stock' => 35,
                'deal_enabled' => true,
                'deal_price' => 379.99,
                'percentage_off' => 15.56,
            ],
            [
                'name' => 'Apple MacBook Air M2',
                'category' => 'Electronics',
                'brand' => 'Apple',
                'short_desc' => 'Thin, light, powerful laptop',
                'description' => 'Ultra-portable laptop with M2 chip delivering incredible performance and all-day battery life.',
                'price' => 1199.99,
                'stock' => 20,
                'is_featured' => true,
            ],
            [
                'name' => 'Sony PlayStation 5',
                'category' => 'Electronics',
                'brand' => 'Sony',
                'short_desc' => 'Next-gen gaming console',
                'description' => 'Immersive gaming experience with ultra-fast SSD and stunning graphics.',
                'price' => 499.99,
                'stock' => 0,
                'is_featured' => true,
                'deal_enabled' => false,
            ],
            [
                'name' => 'Samsung Galaxy Tab S9',
                'category' => 'Electronics',
                'brand' => 'Samsung',
                'short_desc' => 'Premium Android tablet',
                'description' => 'Powerful tablet with S Pen for work and entertainment.',
                'price' => 799.99,
                'stock' => 40,
                'deal_enabled' => true,
                'deal_price' => 699.99,
                'percentage_off' => 12.5,
            ],

            // Furniture
            [
                'name' => 'IKEA MALM Bed Frame',
                'category' => 'Furniture',
                'brand' => 'IKEA',
                'short_desc' => 'Modern bed frame with storage',
                'description' => 'Sleek Scandinavian design bed frame with built-in storage drawers.',
                'price' => 399.99,
                'stock' => 12,
                'specs' => ['weight' => 45, 'length' => 209, 'width' => 166, 'height' => 38],
            ],
            [
                'name' => 'Herman Miller Aeron Chair',
                'category' => 'Furniture',
                'brand' => 'Herman Miller',
                'short_desc' => 'Ergonomic office chair',
                'description' => 'Premium ergonomic chair designed for all-day comfort and support.',
                'price' => 1395.00,
                'stock' => 8,
                'is_featured' => true,
                'deal_enabled' => true,
                'deal_price' => 1195.00,
                'percentage_off' => 14.34,
            ],
            [
                'name' => 'IKEA BILLY Bookcase',
                'category' => 'Furniture',
                'brand' => 'IKEA',
                'short_desc' => 'Versatile modern bookcase',
                'description' => 'Classic bookcase design that adapts to your storage needs.',
                'price' => 89.99,
                'stock' => 50,
                'specs' => ['length' => 80, 'width' => 28, 'height' => 202],
            ],
            [
                'name' => 'Herman Miller Embody Chair',
                'category' => 'Furniture',
                'brand' => 'Herman Miller',
                'short_desc' => 'Advanced ergonomic seating',
                'description' => 'Revolutionary chair designed to promote healthy circulation and focus.',
                'price' => 1695.00,
                'stock' => 5,
                'is_featured' => true,
            ],
            [
                'name' => 'IKEA HEMNES Dresser',
                'category' => 'Furniture',
                'brand' => 'IKEA',
                'short_desc' => '8-drawer dresser in white',
                'description' => 'Traditional style dresser with ample storage space.',
                'price' => 299.99,
                'stock' => 18,
                'deal_enabled' => true,
                'deal_price' => 249.99,
                'percentage_off' => 16.67,
            ],
            [
                'name' => 'IKEA KALLAX Shelving Unit',
                'category' => 'Furniture',
                'brand' => 'IKEA',
                'short_desc' => 'Modular cube storage',
                'description' => 'Flexible storage solution that works as a room divider or shelving.',
                'price' => 149.99,
                'stock' => 30,
            ],

            // Toys
            [
                'name' => 'LEGO Star Wars Millennium Falcon',
                'category' => 'Toys',
                'brand' => 'LEGO',
                'short_desc' => 'Ultimate collector series',
                'description' => 'Massive LEGO set with over 7500 pieces for serious builders.',
                'price' => 849.99,
                'stock' => 10,
                'is_featured' => true,
                'specs' => ['weight' => 15],
            ],
            [
                'name' => 'LEGO City Fire Station',
                'category' => 'Toys',
                'brand' => 'LEGO',
                'short_desc' => 'Interactive building set',
                'description' => 'Fun fire station with vehicles and minifigures for creative play.',
                'price' => 89.99,
                'stock' => 45,
                'deal_enabled' => true,
                'deal_price' => 74.99,
                'percentage_off' => 16.67,
            ],
            [
                'name' => 'Barbie Dreamhouse',
                'category' => 'Toys',
                'brand' => 'Mattel',
                'short_desc' => 'Deluxe dollhouse playset',
                'description' => 'Three-story dreamhouse with elevator, slide and pool for imaginative play.',
                'price' => 199.99,
                'stock' => 22,
                'is_featured' => true,
                'deal_enabled' => true,
                'deal_price' => 159.99,
                'percentage_off' => 20,
            ],
            [
                'name' => 'Hot Wheels Ultimate Garage',
                'category' => 'Toys',
                'brand' => 'Mattel',
                'short_desc' => 'Multi-level car playset',
                'description' => 'Massive garage with parking for over 140 cars and exciting tracks.',
                'price' => 129.99,
                'stock' => 28,
            ],
            [
                'name' => 'Monopoly Ultimate Banking',
                'category' => 'Toys',
                'brand' => 'Hasbro',
                'short_desc' => 'Electronic banking board game',
                'description' => 'Classic board game with electronic banking for modern gameplay.',
                'price' => 29.99,
                'stock' => 60,
                'deal_enabled' => true,
                'deal_price' => 24.99,
                'percentage_off' => 16.67,
            ],
            [
                'name' => 'Transformers Optimus Prime',
                'category' => 'Toys',
                'brand' => 'Hasbro',
                'short_desc' => 'Leader class action figure',
                'description' => 'Highly detailed transforming robot with premium articulation.',
                'price' => 54.99,
                'stock' => 35,
            ],
            [
                'name' => 'Fisher-Price Laugh & Learn Smart Stages',
                'category' => 'Toys',
                'brand' => 'Fisher-Price',
                'short_desc' => 'Educational baby toy',
                'description' => 'Interactive learning toy that grows with your baby.',
                'price' => 39.99,
                'stock' => 50,
            ],
            [
                'name' => 'LEGO Technic Bugatti Chiron',
                'category' => 'Toys',
                'brand' => 'LEGO',
                'short_desc' => 'Advanced building model',
                'description' => 'Intricate model with working 8-speed gearbox and W16 engine.',
                'price' => 379.99,
                'stock' => 0,
                'is_featured' => true,
            ],

            // Clothing
            [
                'name' => 'Nike Air Max 270',
                'category' => 'Clothing',
                'brand' => 'Nike',
                'short_desc' => 'Lifestyle sneakers',
                'description' => 'Comfortable sneakers with visible Air unit for all-day wear.',
                'price' => 150.00,
                'stock' => 75,
                'deal_enabled' => true,
                'deal_price' => 119.99,
                'percentage_off' => 20,
            ],
            [
                'name' => 'Adidas Ultraboost 22',
                'category' => 'Clothing',
                'brand' => 'Adidas',
                'short_desc' => 'Performance running shoes',
                'description' => 'Premium running shoes with responsive Boost cushioning.',
                'price' => 190.00,
                'stock' => 60,
                'is_featured' => true,
            ],
            [
                'name' => 'Nike Dri-FIT T-Shirt',
                'category' => 'Clothing',
                'brand' => 'Nike',
                'short_desc' => 'Moisture-wicking athletic tee',
                'description' => 'Lightweight performance shirt that keeps you dry during workouts.',
                'price' => 35.00,
                'stock' => 100,
                'deal_enabled' => true,
                'deal_price' => 27.99,
                'percentage_off' => 20,
            ],
            [
                'name' => 'Adidas Classic Tracksuit',
                'category' => 'Clothing',
                'brand' => 'Adidas',
                'short_desc' => 'Iconic 3-stripe design',
                'description' => 'Timeless tracksuit with comfort and style for everyday wear.',
                'price' => 85.00,
                'stock' => 40,
            ],
            [
                'name' => 'Zara Slim Fit Jeans',
                'category' => 'Clothing',
                'brand' => 'Zara',
                'short_desc' => 'Modern denim fit',
                'description' => 'Versatile jeans with contemporary slim fit.',
                'price' => 49.90,
                'stock' => 80,
                'deal_enabled' => true,
                'deal_price' => 39.90,
                'percentage_off' => 20.04,
            ],
            [
                'name' => 'H&M Cotton Hoodie',
                'category' => 'Clothing',
                'brand' => 'H&M',
                'short_desc' => 'Comfortable everyday hoodie',
                'description' => 'Soft cotton hoodie perfect for casual wear.',
                'price' => 29.99,
                'stock' => 120,
            ],
            [
                'name' => 'Uniqlo HEATTECH Thermal',
                'category' => 'Clothing',
                'brand' => 'Uniqlo',
                'short_desc' => 'Heat-generating base layer',
                'description' => 'Innovative thermal wear that generates and retains heat.',
                'price' => 19.90,
                'stock' => 150,
                'deal_enabled' => true,
                'deal_price' => 14.90,
                'percentage_off' => 25.13,
            ],
            [
                'name' => 'Zara Leather Jacket',
                'category' => 'Clothing',
                'brand' => 'Zara',
                'short_desc' => 'Premium faux leather',
                'description' => 'Stylish jacket with modern cut and quality finish.',
                'price' => 129.00,
                'stock' => 25,
                'is_featured' => true,
            ],

            // Sports & Outdoors
            [
                'name' => 'Nike Pro Training Mat',
                'category' => 'Sports & Outdoors',
                'brand' => 'Nike',
                'short_desc' => 'Non-slip yoga mat',
                'description' => 'Durable mat with excellent grip for all workout types.',
                'price' => 45.00,
                'stock' => 50,
            ],
            [
                'name' => 'Adidas Performance Soccer Ball',
                'category' => 'Sports & Outdoors',
                'brand' => 'Adidas',
                'short_desc' => 'Official match ball',
                'description' => 'Professional-grade soccer ball with superior flight.',
                'price' => 39.99,
                'stock' => 70,
                'deal_enabled' => true,
                'deal_price' => 32.99,
                'percentage_off' => 17.5,
            ],
            [
                'name' => 'Nike Gym Duffel Bag',
                'category' => 'Sports & Outdoors',
                'brand' => 'Nike',
                'short_desc' => 'Spacious sports bag',
                'description' => 'Large capacity bag with multiple compartments for gym essentials.',
                'price' => 55.00,
                'stock' => 45,
            ],
            [
                'name' => 'Adidas Running Backpack',
                'category' => 'Sports & Outdoors',
                'brand' => 'Adidas',
                'short_desc' => 'Lightweight running pack',
                'description' => 'Ergonomic backpack designed for runners with hydration compatibility.',
                'price' => 65.00,
                'stock' => 30,
                'deal_enabled' => true,
                'deal_price' => 52.00,
                'percentage_off' => 20,
            ],

            // Home & Kitchen
            [
                'name' => 'IKEA STRANDMON Wing Chair',
                'category' => 'Home & Kitchen',
                'brand' => 'IKEA',
                'short_desc' => 'Classic armchair design',
                'description' => 'Timeless chair that provides excellent support and comfort.',
                'price' => 299.00,
                'stock' => 20,
            ],
            [
                'name' => 'IKEA POÄNG Armchair',
                'category' => 'Home & Kitchen',
                'brand' => 'IKEA',
                'short_desc' => 'Bentwood relaxing chair',
                'description' => 'Iconic chair with flexible frame for superior comfort.',
                'price' => 129.00,
                'stock' => 35,
                'deal_enabled' => true,
                'deal_price' => 99.00,
                'percentage_off' => 23.26,
            ],
            [
                'name' => 'Samsung Smart Refrigerator',
                'category' => 'Home & Kitchen',
                'brand' => 'Samsung',
                'short_desc' => 'Family Hub smart fridge',
                'description' => 'Innovative fridge with touchscreen and smart features.',
                'price' => 2999.00,
                'stock' => 5,
                'is_featured' => true,
            ],
            [
                'name' => 'LG Dishwasher',
                'category' => 'Home & Kitchen',
                'brand' => 'LG',
                'short_desc' => 'QuadWash technology',
                'description' => 'Efficient dishwasher with superior cleaning performance.',
                'price' => 799.00,
                'stock' => 12,
                'deal_enabled' => true,
                'deal_price' => 699.00,
                'percentage_off' => 12.52,
            ],
        ];
    }
}
