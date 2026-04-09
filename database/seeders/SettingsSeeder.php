<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Branding
            'site_name' => 'Aadees Marketplace',
            'site_logo' => 'logo.jpeg',
            
            // Contact Info
            'contact_email' => 'support@aadees.com',
            'contact_phone' => '+91 98765 43210',
            'contact_address' => '123 Artisan Lane, Creative District, India',
            
            // Social Links
            'social_instagram' => 'https://instagram.com/aadees',
            'social_facebook' => 'https://facebook.com/aadees',
            'social_twitter' => 'https://twitter.com/aadees',
            'social_pinterest' => 'https://pinterest.com/aadees',
            
            // Content Pages
            'about_us_content' => 'Premium multi-vendor marketplace curated for quality, style, and performance. Crafted for the discerning collector.',
            'privacy_policy_content' => 'We value your privacy...',
            'terms_of_service_content' => 'By using our service...',
            'shipping_info_content' => 'We ship globally...',
            'return_policy_content' => 'We accept returns within 30 days...',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
