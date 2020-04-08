<?php

include 'vendor/gumlet/php-image-resize/lib/ImageResize.php';

use \Gumlet\ImageResize;

$image = new ImageResize('image.jpg');

// Add blure
$image->addFilter(function ($imageDesc) {
    imagefilter($imageDesc, IMG_FILTER_GAUSSIAN_BLUR);
});

$image->save('image_blur.jpg');
// Add banner on bottom left corner
$image18Plus = 'banner.png';  #<-- must have semi-colon
$image->addFilter(function ($imageDesc) use ($image18Plus) {
    $logo = imagecreatefrompng($image18Plus);
    $logo_width = imagesx($logo);
    $logo_height = imagesy($logo);
    $image_width = imagesx($imageDesc);
    $image_height = imagesy($imageDesc);
    $image_x = $image_width - $logo_width - 10;
    $image_y = $image_height - $logo_height - 10;
    imagecopy($imageDesc, $logo, $image_x, $image_y, 0, 0, $logo_width, $logo_height);
});
$image->save('image_filter.jpg');

?>
