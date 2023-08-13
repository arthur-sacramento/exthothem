<?php

// Path to the 'thumbs' folder
$folderPath = 'thumbs/';

// Get a list of all files in the folder
$files = scandir($folderPath);

// Loop through the files
foreach ($files as $file) {
    // Check if the file is a valid image (you can add more image extensions if needed)
    if (in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif'])) {
        // Load the image
        $image = imagecreatefromjpeg($folderPath . $file); // Change to imagecreatefrompng() for PNG images
        
        // Get the dimensions of the image
        $width = imagesx($image);
        $height = imagesy($image);
        
        // Create a new image with reduced quality
        $newImage = imagecreatetruecolor($width, $height);
        
        // Copy the original image to the new image with reduced quality
        imagecopy($newImage, $image, 0, 0, 0, 0, $width, $height);
        
        // Save the new image with reduced quality
        imagejpeg($newImage, $folderPath . 'reduced_' . $file, 10); // Change the quality (0-100)
        
        // Free up memory
        imagedestroy($image);
        imagedestroy($newImage);
    }
}

echo 'Images have been processed and saved with reduced quality while maintaining their original size.';
?>
