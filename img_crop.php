<?php
// Load the source image
$sourceImage = imagecreatefromjpeg('image.jpg');

// Get the dimensions of the source image
$sourceWidth = imagesx($sourceImage);
$sourceHeight = imagesy($sourceImage);

// Calculate the coordinates and dimensions of the crop area
$cropXPercent = 0.20;  // Start at 20% from left
$cropYPercent = 0.20;  // Start at 20% from top
$cropWidthPercent = 0.60;  // Crop 60% of the width
$cropHeightPercent = 0.60; // Crop 60% of the height

$cropX = $cropXPercent * $sourceWidth;
$cropY = $cropYPercent * $sourceHeight;
$cropWidth = $cropWidthPercent * $sourceWidth;
$cropHeight = $cropHeightPercent * $sourceHeight;

// Create a new image with the cropped portion
$croppedImage = imagecreatetruecolor($cropWidth, $cropHeight);
imagecopy($croppedImage, $sourceImage, 0, 0, $cropX, $cropY, $cropWidth, $cropHeight);

// Save the cropped image
imagejpeg($croppedImage, 'cropped_image.jpg');

// Clean up resources
imagedestroy($sourceImage);
imagedestroy($croppedImage);
?>
