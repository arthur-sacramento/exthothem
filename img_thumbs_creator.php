<!DOCTYPE html>
<html>
<head>
    <title>Cropped Images</title>
</head>
<body>
    <h1>Cropped Images</h1>

    <div class="image-list">
        <?php
        $thumbFolder = 'thumbs';
        $croppedFolder = 'cropped';
        $cropSize = 250;

        if (!is_dir($croppedFolder)) {
            mkdir($croppedFolder);
        }

        $images = scandir($thumbFolder);

        foreach ($images as $image) {
            if ($image !== '.' && $image !== '..') {
                $imagePath = $thumbFolder . '/' . $image;
                $croppedPath = $croppedFolder . '/c_' . $image;

                // Get original image dimensions
                list($width, $height) = getimagesize($imagePath);

                // Calculate cropping position
                $cropX = max(0, ($width - $cropSize) / 2);
                $cropY = max(0, ($height - $cropSize) / 2);

                // Create a new image from the original
                $originalImage = imagecreatefromjpeg($imagePath);
                $croppedImage = imagecreatetruecolor($cropSize, $cropSize);

                // Crop and resize the image
                imagecopyresampled($croppedImage, $originalImage, 0, 0, $cropX, $cropY, $cropSize, $cropSize, $cropSize, $cropSize);

                // Save the cropped image
                imagejpeg($croppedImage, $croppedPath, 90);

                // Display the cropped image
                echo '<div class="image-item">';
                echo '<img src="' . $croppedPath . '" alt="Cropped Image">';
                echo '</div>';

                // Free up memory
                imagedestroy($originalImage);
                imagedestroy($croppedImage);
            }
        }
        ?>
    </div>
</body>
</html>