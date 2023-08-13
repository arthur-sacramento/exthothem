<!DOCTYPE html>
<html>
<head>
    <title>Image Filters and Effects</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f0f0f0;
        }
        h2 {
            color: #333;
        }
        form {
            margin-top: 20px;
        }
        input[type="file"] {
            margin-bottom: 10px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 8px 16px;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        img {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
        }
        .image-container {
            display: flex;
            flex-wrap: wrap;
        }
        .image-preview {
            width: calc(33.33% - 20px);
            margin: 10px;
            border: 1px solid #ddd;
            padding: 10px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
    </style>
</head>
<body>

<h2>Upload an Image and Apply Filters/Effects</h2>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
    $uploadDir = "categories/img";
    $uploadedFile = $uploadDir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($uploadedFile, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        $allowedFormats = ["jpg", "jpeg", "png"];
        if (in_array($imageFileType, $allowedFormats)) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $uploadedFile)) {
                $image = imagecreatefromstring(file_get_contents($uploadedFile));

                // Apply a dozen different filter/effects

                // Grayscale
                imagefilter($image, IMG_FILTER_GRAYSCALE);
                imagepng($image, $uploadDir . "gray_" . uniqid() . ".png");

                // Sepia
                imagefilter($image, IMG_FILTER_COLORIZE, 90, 60, 30);
                imagepng($image, $uploadDir . "sepia_" . uniqid() . ".png");

                // Invert Colors
                imagefilter($image, IMG_FILTER_NEGATE);
                imagepng($image, $uploadDir . "invert_" . uniqid() . ".png");

                // Brightness Adjustment
                imagefilter($image, IMG_FILTER_BRIGHTNESS, -50);
                imagepng($image, $uploadDir . "brightness_" . uniqid() . ".png");

                // Blur
                imagefilter($image, IMG_FILTER_GAUSSIAN_BLUR);
                imagepng($image, $uploadDir . "blur_" . uniqid() . ".png");

                // Pixelate
                imagefilter($image, IMG_FILTER_PIXELATE, 10, true);
                imagepng($image, $uploadDir . "pixelate_" . uniqid() . ".png");

                // Edge Detection
                imagefilter($image, IMG_FILTER_EDGEDETECT);
                imagepng($image, $uploadDir . "edge_" . uniqid() . ".png");

                // Emboss
                imagefilter($image, IMG_FILTER_EMBOSS);
                imagepng($image, $uploadDir . "emboss_" . uniqid() . ".png");

                // Mean Removal
                imagefilter($image, IMG_FILTER_MEAN_REMOVAL);
                imagepng($image, $uploadDir . "mean_" . uniqid() . ".png");

                // Selective Color
                imagefilter($image, IMG_FILTER_CONTRAST, -50);
                imagefilter($image, IMG_FILTER_COLORIZE, 255, 0, 0);
                imagepng($image, $uploadDir . "color_" . uniqid() . ".png");

                // Contrast
                imagefilter($image, IMG_FILTER_CONTRAST, -30);
                imagepng($image, $uploadDir . "contrast_" . uniqid() . ".png");

                // Smooth
                imagefilter($image, IMG_FILTER_SMOOTH, 5);
                imagepng($image, $uploadDir . "smooth_" . uniqid() . ".png");

                echo '<p>Original Image:</p>';
                echo '<img src="' . $uploadedFile . '" alt="Original Image"><br><br>';

                }}}}

?>

<form method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="image" id="image">
    <br>
    <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html>
