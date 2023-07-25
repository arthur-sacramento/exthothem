<?php 
error_reporting(0);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Folder and File Listing</title>
<style>
    body {
        font-family: Verdana, sans-serif;
    }

    .folder {
        font-weight: bold;
        background-color: lightgray;
        padding: 5px;
        margin-top: 10px;
        cursor: pointer;
    }

    .folder:hover {
        background-color: darkgray;
        color: white;
    }

    .file {
        margin-left: 20px;
    }

    .pagination {
        margin-top: 20px;
        text-align: center;
    }

    .pagination a {
        display: inline-block;
        padding: 5px 10px;
        background-color: #f1f1f1;
        border: 1px solid #ccc;
        text-decoration: none;
        margin-right: 5px;
    }

    .pagination a.active {
        background-color: #4CAF50;
        color: white;
    }
</style>
</head>
<body>
    <?php
    $folderPath = 'categories/';
    $foldersPerPage = 5;
    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($currentPage - 1) * $foldersPerPage;

    $folders = array_slice(scandir($folderPath), 2);
    $totalFolders = count($folders);
    $totalPages = ceil($totalFolders / $foldersPerPage);

    $foldersToShow = array_slice($folders, $offset, $foldersPerPage);

    foreach ($foldersToShow as $folder) {
        echo '<div class="folder">' . $folder . '</div>';

        $files = scandir($folderPath . $folder);
        foreach ($files as $file) {
            if ($file === '.' || $file === '..') {
                continue;
            }

            echo '<div class="file">' . "<a href='categories/$folder/$file' target='_blank'>$file</a>" . '</div>';
        }
    }

    echo '<div class="pagination">';
    for ($i = 1; $i <= $totalPages; $i++) {
        $activeClass = ($i == $currentPage) ? 'active' : '';
        echo '<a class="' . $activeClass . '" href="?page=' . $i . '">' . $i . '</a>';
    }
    echo "<br><br> <a href='index.php'>Home</a></div>";
    ?>
</body>
</html>
