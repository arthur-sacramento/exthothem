<?php

// Generate a random image size
$width = 300;
$height = 200;

// Create a blank image with a random background color
$image = imagecreatetruecolor($width, $height);
$randBgColor = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
imagefill($image, 0, 0, $randBgColor);

// Generate random lines
$lineColor = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
for ($i = 0; $i < 10; $i++) {
    imageline($image, rand(0, $width), rand(0, $height), rand(0, $width), rand(0, $height), $lineColor);
}

// Generate random rectangles
$rectColor = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
for ($i = 0; $i < 5; $i++) {
    $x1 = rand(0, $width - 50);
    $y1 = rand(0, $height - 50);
    $x2 = $x1 + rand(10, 50);
    $y2 = $y1 + rand(10, 50);
    imagefilledrectangle($image, $x1, $y1, $x2, $y2, $rectColor);
}

// Save the generated image
$savePath = 'categories/random/';
$imageFileName = 'random_image_' . time() . '.png';
$fullImagePath = $savePath . $imageFileName;

if (!is_dir($savePath)) {
    mkdir($savePath, 0755, true);
}

imagepng($image, $fullImagePath);

// Free up memory
imagedestroy($image);

echo "Random image generated and saved as <a href='$fullImagePath'>$fullImagePath</a> <br> <img src='$fullImagePath'>";
?>
