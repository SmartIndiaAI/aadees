<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class GenerateFavicon extends Command
{
    protected $signature = 'generate:favicon';
    protected $description = 'Generate a center-cropped square favicon from the logo.jpeg';

    public function handle()
    {
        $logoPath = base_path('logo.jpeg');

        if (!file_exists($logoPath)) {
            $this->error('logo.jpeg not found in the root directory.');
            return 1;
        }

        $manager = new ImageManager(new Driver());
        $image = $manager->read($logoPath);

        // Get dimensions
        $width = $image->width();
        $height = $image->height();
        $size = min($width, $height);

        // Center crop to square
        $image->cover($size, $size, 'center');

        // Resize for favicon standard
        $image->resize(32, 32);

        // Save
        $image->save(public_path('favicon.ico'));

        $this->info('Favicon generated successfully at public/favicon.ico');
        return 0;
    }
}
