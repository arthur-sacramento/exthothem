<?php
$thumbFolder = 'thumbs';
$outputImage = 'collage.jpg';

$images = scandir($thumbFolder);
$collageWidth = 800; // Set the width of the collage
$collageHeight = 600; // Set the height of the collage

$collage = imagecreatetruecolor($collageWidth, $collageHeight);
$backgroundColor = imagecolorallocate($collage, 255, 255, 255);
imagefill($collage, 0, 0, $backgroundColor);

$x = 0;
$y = 0;
$imageMargin = 10;

foreach ($images as $image) {
    if ($image !== '.' && $image !== '..') {
        $imagePath = $thumbFolder . '/' . $image;
        $imageInfo = getimagesize($imagePath);

        $imageResource = imagecreatefromjpeg($imagePath);
        imagecopyresampled($collage, $imageResource, $x, $y, 0, 0, $imageInfo[0], $imageInfo[1], $imageInfo[0], $imageInfo[1]);
        
        $x += $imageInfo[0] + $imageMargin;
        
        if ($x >= $collageWidth - $imageInfo[0]) {
            $x = 0;
            $y += $imageInfo[1] + $imageMargin;
        }
        
        imagedestroy($imageResource);
    }
}

imagejpeg($collage, $outputImage, 90);

imagedestroy($collage);

echo "Collage created and saved as $outputImage.";
?>