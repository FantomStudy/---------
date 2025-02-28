<?php

header("Content-Type: image/png");

$img = imagecreate(120, 70);
$bg = imagecolorallocate($img, 255, 255, 255);
$black = imagecolorallocate($img, 0, 0, 0);

$chars = array_merge(range("0", "9"), range("A", "Z"));
$code = '';
for ($i = 0; $i < 4; $i++) {
    $code .= $chars[array_rand($chars)];
}

$x = 10;
for ($i = 0; $i < 4; $i++) {
    $angle = rand(-30, 30);
    $y = rand(25, 55);

    imagettftext($img, 20, $angle, $x, $y, $black, "Roboto-Regular.ttf", $code[$i]);
    $x += 20;
}

for ($i = 0; $i < 4; $i++) {
    imagesetpixel($img,rand(0, 120), rand(0, 70), $black);
}
for ($i = 0; $i < 4; $i++) {
    imageline($img, rand(0, 120), rand(0, 70), rand(0, 120), rand(0, 70), $black);
}

imagepng($img);
imagedestroy($img);