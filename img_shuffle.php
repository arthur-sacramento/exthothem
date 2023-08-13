<?php
// Load the source image
$sourceImage = imagecreatefromjpeg('image.jpg');

// Get the dimensions of the source image
$width = imagesx($sourceImage);
$height = imagesy($sourceImage);

// Calculate the dimensions of each portion
$portionWidth = $width / 4;
$portionHeight = $height / 2;

// Create a new image for the shuffled portions
$shuffledImage = imagecreatetruecolor($width, $height);

// Create an array to store the portions
$portions = [];

// Extract and store the portions
for ($x = 0; $x < 4; $x++) {
    for ($y = 0; $y < 2; $y++) {
        $portion = imagecreatetruecolor($portionWidth, $portionHeight);
        imagecopy($portion, $sourceImage, 0, 0, $x * $portionWidth, $y * $portionHeight, $portionWidth, $portionHeight);
        $portions[] = $portion;
    }
}

// Shuffle the portions randomly
shuffle($portions);

// Assemble the shuffled portions back into the new image
$portionIndex = 0;
for ($x = 0; $x < 4; $x++) {
    for ($y = 0; $y < 2; $y++) {
        $portion = $portions[$portionIndex];
        imagecopy($shuffledImage, $portion, $x * $portionWidth, $y * $portionHeight, 0, 0, $portionWidth, $portionHeight);
        $portionIndex++;
    }
}

// Save the shuffled image
imagejpeg($shuffledImage, 'shuffled_image.jpg');

// Clean up resources
imagedestroy($sourceImage);
imagedestroy($shuffledImage);
foreach ($portions as $portion) {
    imagedestroy($portion);
}
?>
