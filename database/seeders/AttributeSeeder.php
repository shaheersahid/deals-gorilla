<?php

namespace Database\Seeders;

use App\Models\Attribute;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Size - for Fashion/Clothing
        $size = Attribute::create([
            'name' => 'Size',
            'slug' => 'size',
            'type' => 'select',
            'is_variant' => true,
            'is_filterable' => true,
            'is_visible' => true,
            'sort_order' => 1,
        ]);
        $size->options()->createMany([
            ['value' => 'XS', 'label' => 'Extra Small', 'sort_order' => 1],
            ['value' => 'S', 'label' => 'Small', 'sort_order' => 2],
            ['value' => 'M', 'label' => 'Medium', 'sort_order' => 3],
            ['value' => 'L', 'label' => 'Large', 'sort_order' => 4],
            ['value' => 'XL', 'label' => 'Extra Large', 'sort_order' => 5],
            ['value' => 'XXL', 'label' => '2XL', 'sort_order' => 6],
        ]);

        // Color - Universal
        $color = Attribute::create([
            'name' => 'Color',
            'slug' => 'color',
            'type' => 'color',
            'is_variant' => true,
            'is_filterable' => true,
            'is_visible' => true,
            'sort_order' => 2,
        ]);
        $color->options()->createMany([
            ['value' => 'Black', 'label' => 'Black', 'color_code' => '#000000', 'sort_order' => 1],
            ['value' => 'White', 'label' => 'White', 'color_code' => '#FFFFFF', 'sort_order' => 2],
            ['value' => 'Red', 'label' => 'Red', 'color_code' => '#FF0000', 'sort_order' => 3],
            ['value' => 'Blue', 'label' => 'Blue', 'color_code' => '#0000FF', 'sort_order' => 4],
            ['value' => 'Green', 'label' => 'Green', 'color_code' => '#00FF00', 'sort_order' => 5],
            ['value' => 'Yellow', 'label' => 'Yellow', 'color_code' => '#FFFF00', 'sort_order' => 6],
            ['value' => 'Pink', 'label' => 'Pink', 'color_code' => '#FFC0CB', 'sort_order' => 7],
            ['value' => 'Navy', 'label' => 'Navy', 'color_code' => '#000080', 'sort_order' => 8],
            ['value' => 'Gray', 'label' => 'Gray', 'color_code' => '#808080', 'sort_order' => 9],
            ['value' => 'Brown', 'label' => 'Brown', 'color_code' => '#8B4513', 'sort_order' => 10],
        ]);

        // Material - Fashion
        $material = Attribute::create([
            'name' => 'Material',
            'slug' => 'material',
            'type' => 'select',
            'is_variant' => false,
            'is_filterable' => true,
            'is_visible' => true,
            'sort_order' => 3,
        ]);
        $material->options()->createMany([
            ['value' => 'Cotton', 'sort_order' => 1],
            ['value' => 'Polyester', 'sort_order' => 2],
            ['value' => 'Wool', 'sort_order' => 3],
            ['value' => 'Silk', 'sort_order' => 4],
            ['value' => 'Leather', 'sort_order' => 5],
            ['value' => 'Denim', 'sort_order' => 6],
            ['value' => 'Linen', 'sort_order' => 7],
            ['value' => 'Velvet', 'sort_order' => 8],
        ]);

        // Storage - Electronics
        $storage = Attribute::create([
            'name' => 'Storage',
            'slug' => 'storage',
            'type' => 'select',
            'is_variant' => true,
            'is_filterable' => true,
            'is_visible' => true,
            'sort_order' => 4,
        ]);
        $storage->options()->createMany([
            ['value' => '32GB', 'sort_order' => 1],
            ['value' => '64GB', 'sort_order' => 2],
            ['value' => '128GB', 'sort_order' => 3],
            ['value' => '256GB', 'sort_order' => 4],
            ['value' => '512GB', 'sort_order' => 5],
            ['value' => '1TB', 'sort_order' => 6],
        ]);

        // RAM - Electronics
        $ram = Attribute::create([
            'name' => 'RAM',
            'slug' => 'ram',
            'type' => 'select',
            'is_variant' => true,
            'is_filterable' => true,
            'is_visible' => true,
            'sort_order' => 5,
        ]);
        $ram->options()->createMany([
            ['value' => '4GB', 'sort_order' => 1],
            ['value' => '6GB', 'sort_order' => 2],
            ['value' => '8GB', 'sort_order' => 3],
            ['value' => '12GB', 'sort_order' => 4],
            ['value' => '16GB', 'sort_order' => 5],
            ['value' => '32GB', 'sort_order' => 6],
        ]);

        // Shade - Cosmetics/Makeup
        $shade = Attribute::create([
            'name' => 'Shade',
            'slug' => 'shade',
            'type' => 'color',
            'is_variant' => true,
            'is_filterable' => true,
            'is_visible' => true,
            'sort_order' => 6,
        ]);
        $shade->options()->createMany([
            ['value' => 'Fair', 'color_code' => '#FDEBD3', 'sort_order' => 1],
            ['value' => 'Light', 'color_code' => '#E8C39E', 'sort_order' => 2],
            ['value' => 'Medium', 'color_code' => '#C68642', 'sort_order' => 3],
            ['value' => 'Tan', 'color_code' => '#8D5524', 'sort_order' => 4],
            ['value' => 'Deep', 'color_code' => '#5C3317', 'sort_order' => 5],
        ]);

        // Finish - Cosmetics
        $finish = Attribute::create([
            'name' => 'Finish',
            'slug' => 'finish',
            'type' => 'select',
            'is_variant' => false,
            'is_filterable' => true,
            'is_visible' => true,
            'sort_order' => 7,
        ]);
        $finish->options()->createMany([
            ['value' => 'Matte', 'sort_order' => 1],
            ['value' => 'Glossy', 'sort_order' => 2],
            ['value' => 'Satin', 'sort_order' => 3],
            ['value' => 'Shimmer', 'sort_order' => 4],
            ['value' => 'Metallic', 'sort_order' => 5],
        ]);
    }
}
