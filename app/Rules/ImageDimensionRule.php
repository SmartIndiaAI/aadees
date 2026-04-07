<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Http\UploadedFile;

class ImageDimensionRule implements ValidationRule
{
    protected $width;
    protected $height;
    protected $type;

    /**
     * Create a new rule instance.
     */
    public function __construct($width, $height, $type = 'Image')
    {
        $this->width = $width;
        $this->height = $height;
        $this->type = $type;
    }

    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$value instanceof UploadedFile) {
            return;
        }

        $dimensions = getimagesize($value->getRealPath());
        $width = $dimensions[0];
        $height = $dimensions[1];

        if ($width !== $this->width || $height !== $this->height) {
            $fail("The {$this->type} must be exactly {$this->width}x{$this->height} pixels. Current: {$width}x{$height}.");
        }
    }
}
