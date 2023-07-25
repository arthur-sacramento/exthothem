<?php 
error_reporting(0);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Folder and File Listing</title>
    <style>
        .folder {
            font-weight: bold;
        }

        .file {
            margin-left: 20px;
        }
    </style>
</head>
<body>
    <?php
    $folderPath = 'categories/';
    $folders = scandir($folderPath);

    foreach ($folders as $folder) {
        if ($folder === '.' || $folder === '..') {
            continue;
        }

        echo '<div class="folder">' . $folder . '</div>';

        $files = scandir($folderPath . $folder);
        foreach ($files as $file) {
            if ($file === '.' || $file === '..') {
                continue;
            }

            echo '<div class="file">' . "<a href='categories/$folder/$file' target='_blank'>$file</a>" . '</div>';
        }
    }
    ?>
</body>
</html>