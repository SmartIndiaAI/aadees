<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show($slug)
    {
        $settingKey = str_replace('-', '_', $slug) . '_content';
        $content = Setting::getValue($settingKey);

        if (!$content) {
            abort(404);
        }

        $title = ucwords(str_replace('-', ' ', $slug));

        return view('customer.pages.show', compact('title', 'content'));
    }

    public function contact()
    {
        return view('customer.pages.contact');
    }
}
