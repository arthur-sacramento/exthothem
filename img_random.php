<?php
// Create a new image
$width = 800;
$height = 600;
$outputImage = imagecreatetruecolor($width, $height);

// Generate a random background color
$bgColor = imagecolorallocate($outputImage, rand(0, 255), rand(0, 255), rand(0, 255));
imagefill($outputImage, 0, 0, $bgColor);

// Generate random lines
$lineColor = imagecolorallocate($outputImage, rand(0, 255), rand(0, 255), rand(0, 255));
$numLines = rand(5, 15);

// Calculate the starting point of the first line
$startX = rand(0, $width);
$startY = rand(0, $height);

for ($i = 0; $i < $numLines; $i++) {
    // Calculate the ending point of the current line
    $endX = rand(0, $width);
    $endY = rand(0, $height);

    // Draw the line
    imageline($outputImage, $startX, $startY, $endX, $endY, $lineColor);

    // Update the starting point for the next line
    $startX = $endX;
    $startY = $endY;
}

// Save the generated image
$outputDirectory = 'categories/random/';
if (!is_dir($outputDirectory)) {
    mkdir($outputDirectory, 0777, true);
}

$outputFilename = $outputDirectory . time() .'.jpg';
imagejpeg($outputImage, $outputFilename);

// Clean up
imagedestroy($outputImage);

echo "Image generated and saved as: <a href='$outputFilename'>$outputFilename</a><br><img src='$outputFilename'>";
?>
