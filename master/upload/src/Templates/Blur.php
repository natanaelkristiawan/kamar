<?php

namespace Master\Upload\Templates;

use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\Image;

class Blur implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        $action = config('image.size.sm.action', 'fit');
        $width = 400;
        $height = 258;
        $dataFile =  explode('/', $image->mime());

        $image->fit($width, $height, function ($constraint) {
            $constraint->upsize();
        });

        $image->blur(100);

        return $image;
    }
}
