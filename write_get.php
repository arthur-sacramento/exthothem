<?php
if (isset($_GET['contents'])) {
    $contents = $_GET['contents'];
    $hash = sha1($contents);
    $filename = 'categories/contents/' . $hash . '.txt';

    // Create the 'get' folder if it doesn't exist
    if (!is_dir('categories/contents')) {
        mkdir('categories/contents', 0777, true);
    }

    // Write contents to the file
    if (file_put_contents($filename, $contents) !== false) {
        echo "File saved successfully: " . "<a href='$filename' target='_blank'>$filename</a>";
    } else {
        echo "Error saving file.";
    }
} else {
    echo "Use the GET variable '<i>contents</i>' to insert a text or link (e.g: write_get.php?contents=test)";
}
?>