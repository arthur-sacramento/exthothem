<?php
// Load the source image
$sourceImage = imagecreatefromjpeg('image.jpg');

// Get the dimensions of the source image
$width = imagesx($sourceImage);
$height = imagesy($sourceImage);

// Create a new image with reduced quality
$targetImage = imagecreatetruecolor($width, $height);
imagecopy($targetImage, $sourceImage, 0, 0, 0, 0, $width, $height);

// Save the target image with reduced quality (adjust the second argument to control the quality)
imagejpeg($targetImage, 'output_image.jpg', 10); // Here, 50 is the quality value (0-100)

// Clean up resources
imagedestroy($sourceImage);
imagedestroy($targetImage);
?>
