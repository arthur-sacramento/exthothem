<!DOCTYPE html>
<html>
<head>
    <title>Image Upload and Description</title>
</head>
<body>

<?php
$uploadDir = 'categories/img/';
$descriptionDir = 'categories/contents';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $description = $_POST['description'];
    
    if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageTempPath = $_FILES['image']['tmp_name'];
        $imageFileName = basename($_FILES['image']['name']);
        $imagePath = $uploadDir . $imageFileName;
        
        if (move_uploaded_file($imageTempPath, $imagePath)) {
            file_put_contents($descriptionDir . $imageFileName . '.html', $description);
            echo 'Image uploaded successfully.';
        } else {
            echo 'Error uploading image.';
        }
    } else {
        echo 'Error: ' . $_FILES['image']['error'];
    }
}
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
    <label for="image">Upload Image:</label>
    <input type="file" name="image" id="image" accept="image/*" required><br>
    
    <label for="description">Image Description:</label><br>
    <textarea name="description" id="description" rows="4" cols="50" required></textarea><br>
    
    <input type="submit" value="Upload">
</form>

<?php
if (isset($imagePath)) {
    echo '<br><img src="' . $imagePath . '" alt="Uploaded Image">';
}
?>

</body>
</html>
