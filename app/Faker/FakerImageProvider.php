<?php

namespace App\Faker;

use Faker\Provider\Base;

class FakerImageProvider extends Base
{
    public function imageUrl($width = 640, $height = 480)
    {
        $random = rand(1, 100000);
        return sprintf('https://picsum.photos/%d/%d?random=%d', $width, $height, $random);
    }

}
