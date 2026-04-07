<?php

namespace App\Http\View\Composers;

use App\Models\Setting;
use Illuminate\View\View;

class ThemeComposer
{
    public function compose(View $view)
    {
        $settings = Setting::whereIn('key', [
            'theme_color_primary',
            'theme_color_secondary',
            'theme_color_accent'
        ])->get()->pluck('value', 'key');

        $view->with('themeColors', [
            'primary' => $settings->get('theme_color_primary', '#291030'),
            'secondary' => $settings->get('theme_color_secondary', '#fcd777'),
            'accent' => $settings->get('theme_color_accent', '#8e46a5'),
        ]);
    }
}
