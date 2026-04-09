<?php

namespace App\Http\View\Composers;

use App\Models\Setting;
use Illuminate\View\View;

class ThemeComposer
{
    public function compose(View $view)
    {
        $settings = Setting::all()->pluck('value', 'key');

        $view->with('themeColors', [
            'primary' => $settings->get('theme_color_primary', '#291030'),
            'secondary' => $settings->get('theme_color_secondary', '#fcd777'),
            'accent' => $settings->get('theme_color_accent', '#8e46a5'),
        ]);

        $logo = $settings->get('site_logo', 'logo.jpeg');
        $view->with('siteLogo', str_starts_with($logo, 'settings/') ? asset('storage/' . $logo) : asset($logo));
        $view->with('siteName', $settings->get('site_name', 'Aadees'));
        
        $view->with('contactInfo', [
            'email' => $settings->get('contact_email'),
            'phone' => $settings->get('contact_phone'),
            'address' => $settings->get('contact_address'),
        ]);

        $view->with('socialLinks', [
            'instagram' => $settings->get('social_instagram'),
            'facebook' => $settings->get('social_facebook'),
            'twitter' => $settings->get('social_twitter'),
            'pinterest' => $settings->get('social_pinterest'),
        ]);
    }
}
