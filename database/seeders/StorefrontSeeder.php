<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\Vendor;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StorefrontSeeder extends Seeder
{
    public function run(): void
    {
        // 0. Establish Settings
        $settings = [
            'theme_color_primary' => '#291030',
            'theme_color_secondary' => '#fcd777',
            'theme_color_accent' => '#8e46a5',
            'razorpay_key' => 'rzp_test_placeholder',
            'razorpay_secret' => 'secret_placeholder',
            'smtp_host' => '127.0.0.1',
            'smtp_port' => '1025',
        ];

        foreach ($settings as $key => $value) {
            \App\Models\Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        // 0.1 Establish Attributes
        $colorAttr = \App\Models\Attribute::updateOrCreate(['name' => 'Color']);
        $sizeAttr = \App\Models\Attribute::updateOrCreate(['name' => 'Size']);

        // 1. Establish Users
        Admin::updateOrCreate(
            ['email' => 'admin@aadees.com'],
            [
                'name' => 'Aadees Admin',
                'password' => Hash::make('password123'),
            ]
        );

        $vendor = Vendor::updateOrCreate(
            ['email' => 'artisan@aadees.com'],
            [
                'name' => 'Artisan Global',
                'password' => Hash::make('password123'),
                'business_name' => 'The Global Artisan',
                'razorpay_account_id' => 'acc_Nf9FvS8K2J6L4A',
                'razorpay_account_status' => 'active',
            ]
        );

        User::updateOrCreate(
            ['email' => 'customer@aadees.com'],
            [
                'name' => 'Elite Customer',
                'password' => Hash::make('password123'),
            ]
        );

        // 2. Establish Categories
        $categories = [
            ['slug' => 'jewelry', 'name' => 'Jewelry', 'image' => 'https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?auto=format&fit=crop&q=80&w=600'],
            ['slug' => 'apparel', 'name' => 'Apparel', 'image' => 'https://images.unsplash.com/photo-1523381210434-271e8be1f52b?auto=format&fit=crop&q=80&w=600'],
            ['slug' => 'art-decor', 'name' => 'Art & Decor', 'image' => 'https://images.unsplash.com/photo-1541701494587-cb58502866ab?auto=format&fit=crop&q=80&w=600'],
            ['slug' => 'electronics', 'name' => 'Electronics', 'image' => 'https://images.unsplash.com/photo-1498049794561-7780e7231661?auto=format&fit=crop&q=80&w=600'],
            ['slug' => 'kids', 'name' => 'Kids & Toys', 'image' => 'https://images.unsplash.com/photo-1515488764276-beab7607c1e6?auto=format&fit=crop&q=80&w=600'],
        ];

        foreach ($categories as $catData) {
            Category::updateOrCreate(['slug' => $catData['slug']], $catData);
        }

        $jewelry = Category::where('slug', 'jewelry')->first();
        $apparel = Category::where('slug', 'apparel')->first();
        $art = Category::where('slug', 'art-decor')->first();

        // 3. Establish Products
        Product::updateOrCreate(
            ['sku' => 'AA-EY-2024-001'],
            [
                'vendor_id' => $vendor->id,
                'category_id' => $jewelry->id,
                'name' => 'Eternal Emerald Necklace',
                'slug' => 'eternal-emerald-necklace',
                'description' => 'A masterfully crafted 18k gold necklace adorned with rare, deep emeralds.',
                'price' => 299000.00,
                'discount_price' => 249000.00, // Reduced price
                'thumbnail' => 'https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?auto=format&fit=crop&q=80&w=800',
                'status' => 1,
                'stock' => 5,
                'is_featured' => true
            ]
        )->attributeValues()->updateOrCreate(['attribute_id' => $colorAttr->id], ['value' => 'Gold']);

        Product::updateOrCreate(
            ['sku' => 'AA-AP-2024-042'],
            [
                'vendor_id' => $vendor->id,
                'category_id' => $apparel->id,
                'name' => 'Organic Linen Overshirt',
                'slug' => 'organic-linen-overshirt',
                'description' => 'Sustainable, premium organic linen overshirt in cloud white.',
                'price' => 15000.00,
                'discount_price' => 12500.00,
                'thumbnail' => 'https://images.unsplash.com/photo-1523381210434-271e8be1f52b?auto=format&fit=crop&q=80&w=800',
                'status' => 1,
                'stock' => 10,
                'is_featured' => true
            ]
        )->attributeValues()->createMany([
            ['attribute_id' => $colorAttr->id, 'value' => 'White'],
            ['attribute_id' => $sizeAttr->id, 'value' => 'L']
        ]);

        Product::updateOrCreate(
            ['sku' => 'AA-AR-2024-009'],
            [
                'vendor_id' => $vendor->id,
                'category_id' => $art->id,
                'name' => 'Modernist Ceramic Vessel',
                'slug' => 'modernist-ceramic-vessel',
                'description' => 'A unique, hand-sculpted ceramic vessel in matte beige.',
                'price' => 8400.00,
                'thumbnail' => 'https://images.unsplash.com/photo-1541701494587-cb58502866ab?auto=format&fit=crop&q=80&w=800',
                'status' => 1,
                'stock' => 3,
                'is_featured' => true
            ]
        )->attributeValues()->updateOrCreate(['attribute_id' => $colorAttr->id], ['value' => 'Beige']);
        
        Product::updateOrCreate(
            ['sku' => 'AA-EY-2024-010'],
            [
                'vendor_id' => $vendor->id,
                'category_id' => $jewelry->id,
                'name' => 'Minimalist Gold Ring',
                'slug' => 'minimalist-gold-ring',
                'description' => 'Sleek 22k gold ring for the modern era.',
                'price' => 45000.00,
                'thumbnail' => 'https://images.unsplash.com/photo-1605100804763-247f67b3557e?auto=format&fit=crop&q=80&w=800',
                'status' => 1,
                'stock' => 15,
                'is_featured' => true
            ]
        )->attributeValues()->updateOrCreate(['attribute_id' => $colorAttr->id], ['value' => 'Gold']);
    }
}
