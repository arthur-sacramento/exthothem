<?php
// Load the source image
$sourceImage = imagecreatefromjpeg('image.jpg');

// Get the dimensions of the source image
$width = imagesx($sourceImage);
$height = imagesy($sourceImage);

// Create a new image for the black and white version
$bwImage = imagecreatetruecolor($width, $height);

// Convert the image to black and white
for ($x = 0; $x < $width; $x++) {
    for ($y = 0; $y < $height; $y++) {
        $rgb = imagecolorat($sourceImage, $x, $y);
        $r = ($rgb >> 16) & 0xFF;
        $g = ($rgb >> 8) & 0xFF;
        $b = $rgb & 0xFF;
        $gray = round(0.299 * $r + 0.587 * $g + 0.114 * $b);
        $grayColor = imagecolorallocate($bwImage, $gray, $gray, $gray);
        imagesetpixel($bwImage, $x, $y, $grayColor);
    }
}

// Save the black and white image
imagejpeg($bwImage, 'bw_image.jpg');

// Clean up resources
imagedestroy($sourceImage);
imagedestroy($bwImage);
?>