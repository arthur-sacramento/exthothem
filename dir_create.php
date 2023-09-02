<?php

mkdir("background", 0755, true);
mkdir("categories", 0755, true);
mkdir("comments", 0755, true);
mkdir("icons", 0755, true);
mkdir("thumbs", 0755, true);
mkdir("categories/contents", 0755, true);
mkdir("categories/upload", 0755, true);
mkdir("categories/random", 0755, true);

$sourceFile = "1.jpg";
$destinationFolder = "background/";

if (file_exists($sourceFile)) {
    if (copy($sourceFile, $destinationFolder . $sourceFile)) {
        //echo "File copied successfully!";
    } else {
        //echo "Error copying file.";
    }
} else {
    //echo "Source file not found.";
}

?>