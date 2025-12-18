<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Attribute;
use App\Models\AttributeOption;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Image;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class VariantProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Seeding variant products and images...');

        // Get attributes
        $sizeAttr = Attribute::where('slug', 'size')->first();
        $colorAttr = Attribute::where('slug', 'color')->first();
        $storageAttr = Attribute::where('slug', 'storage')->first();

        // Get categories and brands
        $electronics = Category::where('slug', 'electronics')->first();
        $clothing = Category::where('slug', 'clothing')->first();
        $samsung = Brand::where('slug', 'samsung')->first();
        $apple = Brand::where('slug', 'apple')->first();
        $nike = Brand::where('slug', 'nike')->first();
        $zara = Brand::where('slug', 'zara')->first();

        $variantProducts = [];

        // 1. iPhone 14 with Storage Variants
        if ($apple && $electronics && $storageAttr) {
            $product = Product::updateOrCreate(
                ['slug' => 'iphone-14-pro'],
                [
                    'name' => 'iPhone 14 Pro',
                    'category_id' => $electronics->id,
                    'brand_id' => $apple->id,
                    'short_desc' => 'Professional camera system and Dynamic Island',
                    'description' => 'The iPhone 14 Pro features a 48MP Main camera, Dynamic Island, and Always-On display with ProMotion technology.',
                    'price' => 999.00, // Base price (will show min variant price)
                    'cost_price' => 650.00,
                    'stock' => 0,
                    'is_featured' => true,
                    'is_active' => true,
                    'has_variants' => true,
                    'deal_enabled' => false,
                ]
            );

            $this->addProductImage($product, 'iphone-14-pro.jpg', true);

            $storageOptions = [
                ['128gb', 999.00, 45],
                ['256gb', 1099.00, 30],
                ['512gb', 1299.00, 15],
            ];

            foreach ($storageOptions as $index => [$storage, $price, $stock]) {
                $option = AttributeOption::where('attribute_id', $storageAttr->id)
                    ->where('value', $storage)->first();
                
                if ($option) {
                    $variant = ProductVariant::updateOrCreate(
                        [
                            'product_id' => $product->id,
                            'sku' => 'IPHONE14P-' . strtoupper($storage)
                        ],
                        [
                            'price' => $price,
                            'stock' => $stock,
                            'is_active' => true,
                            'sort_order' => $index,
                        ]
                    );

                    $variant->attributeValues()->delete();
                    $variant->attributeValues()->create([
                        'attribute_id' => $storageAttr->id,
                        'attribute_option_id' => $option->id,
                    ]);

                    // Add variant image
                    $placeholderUrl = 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?q=80&w=400&auto=format&fit=crop';
                    $variant->update(['image' => $placeholderUrl]);
                }
            }

            $product->syncPriceFromVariants();
            $product->syncStockFromVariants();
            $variantProducts[] = $product;
        }

        // 2. Samsung Galaxy S23 with Storage Variants
        if ($samsung && $electronics && $storageAttr) {
            $product = Product::updateOrCreate(
                ['slug' => 'samsung-galaxy-s23-ultra-variant'],
                [
                    'name' => 'Samsung Galaxy S23 Ultra (Variant)',
                    'category_id' => $electronics->id,
                    'brand_id' => $samsung->id,
                    'short_desc' => 'Professional-grade camera with 200MP sensor',
                    'description' => 'Galaxy S23 Ultra with integrated S Pen, advanced AI processing, and all-day battery life.',
                    'price' => 1199.00,
                    'cost_price' => 750.00,
                    'stock' => 0,
                    'is_featured' => true,
                    'is_active' => true,
                    'has_variants' => true,
                    'deal_enabled' => true,
                    'deal_price' => 999.00,
                    'percentage_off' => 16.68,
                    'deal_start' => now()->subDays(3),
                    'deal_end' => now()->addDays(15),
                ]
            );

            $this->addProductImage($product, 'galaxy-s23.jpg', true);

            $storageOptions = [
                ['256gb', 1199.00, 25],
                ['512gb', 1399.00, 18],
                ['1tb', 1599.00, 8],
            ];

            foreach ($storageOptions as $index => [$storage, $price, $stock]) {
                $option = AttributeOption::where('attribute_id', $storageAttr->id)
                    ->where('value', $storage)->first();
                
                if ($option) {
                    $variant = ProductVariant::updateOrCreate(
                        [
                            'product_id' => $product->id,
                            'sku' => 'S23U-' . strtoupper($storage)
                        ],
                        [
                            'price' => $price,
                            'stock' => $stock,
                            'is_active' => true,
                            'sort_order' => $index,
                        ]
                    );

                    $variant->attributeValues()->delete();
                    $variant->attributeValues()->create([
                        'attribute_id' => $storageAttr->id,
                        'attribute_option_id' => $option->id,
                    ]);

                    // Add variant image
                    $placeholderUrl = 'https://images.unsplash.com/photo-1610945265064-0e34e5519bbf?q=80&w=400&auto=format&fit=crop';
                    $variant->update(['image' => $placeholderUrl]);
                }
            }

            $product->syncPriceFromVariants();
            $product->syncStockFromVariants();
            $variantProducts[] = $product;
        }

        // 3. Nike Running Shoes with Size & Color Variants
        if ($nike && $clothing && $sizeAttr && $colorAttr) {
            $product = Product::updateOrCreate(
                ['slug' => 'nike-pegasus-40'],
                [
                    'name' => 'Nike Air Zoom Pegasus 40',
                    'category_id' => $clothing->id,
                    'brand_id' => $nike->id,
                    'short_desc' => 'Responsive cushioning for everyday running',
                    'description' => 'Updated with React foam and Zoom Air units for a springy, responsive ride that helps you run faster.',
                    'price' => 130.00,
                    'cost_price' => 70.00,
                    'stock' => 0,
                    'is_featured' => true,
                    'is_active' => true,
                    'has_variants' => true,
                    'deal_enabled' => true,
                    'deal_price' => 99.00,
                    'percentage_off' => 23.85,
                    'deal_start' => now()->subDays(1),
                    'deal_end' => now()->addDays(30),
                ]
            );

            $this->addProductImage($product, 'nike-pegasus.jpg', true);

            $sizes = ['s', 'm', 'l', 'xl'];
            $colors = ['black', 'white', 'blue'];

            $variantIndex = 0;
            foreach ($colors as $colorValue) {
                foreach ($sizes as $sizeValue) {
                    $sizeOption = AttributeOption::where('attribute_id', $sizeAttr->id)
                        ->where('value', $sizeValue)->first();
                    $colorOption = AttributeOption::where('attribute_id', $colorAttr->id)
                        ->where('value', $colorValue)->first();

                    if ($sizeOption && $colorOption) {
                        $stock = rand(5, 25);
                        $variant = ProductVariant::updateOrCreate(
                            [
                                'product_id' => $product->id,
                                'sku' => 'PEGASUS-' . strtoupper($colorValue) . '-' . strtoupper($sizeValue)
                            ],
                            [
                                'price' => 130.00,
                                'stock' => $stock,
                                'is_active' => true,
                                'sort_order' => $variantIndex++,
                            ]
                        );

                        $variant->attributeValues()->delete();
                        $variant->attributeValues()->create([
                            'attribute_id' => $sizeAttr->id,
                            'attribute_option_id' => $sizeOption->id,
                        ]);
                        $variant->attributeValues()->create([
                            'attribute_id' => $colorAttr->id,
                            'attribute_option_id' => $colorOption->id,
                        ]);

                        // Add variant image based on color
                        $colorHex = ltrim($colorOption->color_code, '#');
                        $placeholderUrl = "https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=400&auto=format&fit=crop"; // Red Nike
                        if ($colorValue == 'white') $placeholderUrl = "https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=400&auto=format&fit=crop";
                        if ($colorValue == 'black') $placeholderUrl = "https://images.unsplash.com/photo-1524532787116-e70228437bbe?q=80&w=400&auto=format&fit=crop";
                        
                        $variant->update(['image' => $placeholderUrl]);
                    }
                }
            }

            $product->syncPriceFromVariants();
            $product->syncStockFromVariants();
            $variantProducts[] = $product;
        }

        // 4. Zara T-Shirt with Size & Color Variants
        if ($zara && $clothing && $sizeAttr && $colorAttr) {
            $product = Product::updateOrCreate(
                ['slug' => 'zara-basic-tee'],
                [
                    'name' => 'Zara Basic Cotton T-Shirt',
                    'category_id' => $clothing->id,
                    'brand_id' => $zara->id,
                    'short_desc' => 'Essential wardrobe staple',
                    'description' => 'Premium cotton t-shirt with a comfortable regular fit. Perfect for everyday wear.',
                    'price' => 19.90,
                    'cost_price' => 8.00,
                    'stock' => 0,
                    'is_featured' => false,
                    'is_active' => true,
                    'has_variants' => true,
                    'deal_enabled' => false,
                ]
            );

            $this->addProductImage($product, 'zara-tshirt.jpg', true);

            $sizes = ['xs', 's', 'm', 'l', 'xl'];
            $colors = ['black', 'white', 'red', 'blue'];

            $variantIndex = 0;
            foreach ($colors as $colorValue) {
                $colorOption = AttributeOption::where('attribute_id', $colorAttr->id)
                    ->where('value', $colorValue)->first();
                
                $placeholderUrl = "https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?q=80&w=400&auto=format&fit=crop"; // Basic Tee
                if ($colorValue == 'black') $placeholderUrl = "https://images.unsplash.com/photo-1503342217505-b0a15ec3261c?q=80&w=400&auto=format&fit=crop";
                if ($colorValue == 'red') $placeholderUrl = "https://images.unsplash.com/photo-1583743814966-8936f5b721fa?q=80&w=400&auto=format&fit=crop";
                if ($colorValue == 'blue') $placeholderUrl = "https://images.unsplash.com/photo-1489987707025-afc232f7ea0f?q=80&w=400&auto=format&fit=crop";

                foreach ($sizes as $sizeValue) {
                    $sizeOption = AttributeOption::where('attribute_id', $sizeAttr->id)
                        ->where('value', $sizeValue)->first();

                    if ($sizeOption && $colorOption) {
                        $stock = rand(10, 50);
                        $variant = ProductVariant::updateOrCreate(
                            [
                                'product_id' => $product->id,
                                'sku' => 'ZARA-TEE-' . strtoupper($colorValue) . '-' . strtoupper($sizeValue)
                            ],
                            [
                                'price' => 19.90,
                                'stock' => $stock,
                                'is_active' => true,
                                'sort_order' => $variantIndex++,
                                'image' => $placeholderUrl
                            ]
                        );

                        $variant->attributeValues()->delete();
                        $variant->attributeValues()->create([
                            'attribute_id' => $sizeAttr->id,
                            'attribute_option_id' => $sizeOption->id,
                        ]);
                        $variant->attributeValues()->create([
                            'attribute_id' => $colorAttr->id,
                            'attribute_option_id' => $colorOption->id,
                        ]);
                    }
                }
            }

            $product->syncPriceFromVariants();
            $product->syncStockFromVariants();
            $variantProducts[] = $product;
        }

        $this->command->info('✓ Created ' . count($variantProducts) . ' variant products with pricing');
        
        // Add images to existing simple products
        $this->addImagesToExistingProducts();
        
        $this->command->info('Variant products and images seeding completed!');
    }

    private function addProductImage($product, $filename, $isPrimary = false)
    {
        $categoryName = $product->category?->name ?? 'product';
        $keywords = Str::slug($categoryName . ' ' . $product->brand?->name);
        
        // Use high-quality Unsplash images based on category/brand
        $imageUrl = "https://images.unsplash.com/photo-1523275335684-37898b6baf30?q=80&w=800&auto=format&fit=crop"; // Default Watch
        
        if (Str::contains(strtolower($categoryName), 'electronics')) {
            $imageUrl = "https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?q=80&w=800&auto=format&fit=crop"; // Phone
            if (Str::contains(strtolower($product->name), 'macbook')) $imageUrl = "https://images.unsplash.com/photo-1517336714731-489689fd1ca8?q=80&w=800&auto=format&fit=crop";
        } elseif (Str::contains(strtolower($categoryName), 'furniture')) {
            $imageUrl = "https://images.unsplash.com/photo-1524758631624-e2822e304c36?q=80&w=800&auto=format&fit=crop"; // Chair
        } elseif (Str::contains(strtolower($categoryName), 'clothing')) {
            $imageUrl = "https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=800&auto=format&fit=crop"; // Red Shoe (Nike style)
        } elseif (Str::contains(strtolower($categoryName), 'toys')) {
            $imageUrl = "https://images.unsplash.com/photo-1585366119957-e9730b6d0f60?q=80&w=800&auto=format&fit=crop"; // LEGO style
        }

        Image::updateOrCreate(
            [
                'image_type' => Product::class,
                'image_id' => $product->id,
                'is_primary' => $isPrimary
            ],
            [
                'orig_path' => $imageUrl,
                'thumb_path' => $imageUrl,
                'description' => $product->name,
                'order' => $isPrimary ? 0 : 1,
            ]
        );
    }

    private function addImagesToExistingProducts()
    {
        $products = Product::whereDoesntHave('images')->get();
        
        foreach ($products as $product) {
            $this->addProductImage($product, Str::slug($product->name) . '.jpg', true);
        }
        
        $this->command->info('✓ Added real images to ' . $products->count() . ' products');
    }
}
