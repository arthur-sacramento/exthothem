<?php
// Array of hosts to check
$hosts = array(
    'host1.example.com',
    'host2.example.com',
    'localhost'
);

// Path to the 'files' folder
$folderPath = 'files/';

// Get the list of files in the folder
$files = scandir($folderPath);

// Remove '.' and '..' from the file list
$files = array_diff($files, array('.', '..'));

// Initialize an array to store file contents for each host
$fileContentsByHost = array();

// Loop through each file and check its content on each host
foreach ($files as $file) {
    $localFilePath = $folderPath . $file;
    $localContent = file_get_contents($localFilePath);

    foreach ($hosts as $host) {
        $fileUrl = "http://$host/$folderPath$file";
        $remoteContent = @file_get_contents($fileUrl);

        if ($remoteContent !== false) {
            $fileContentsByHost[$host][$file] = $remoteContent;
        }
    }
}

// Find hosts where all files have the same content
foreach ($hosts as $host) {
    $hostFiles = $fileContentsByHost[$host] ?? array();
    $uniqueContents = array_unique($hostFiles);

    if (count($uniqueContents) === 1) {
        echo "All files on $host have the same content:<br>";
        foreach ($hostFiles as $file => $content) {
            echo "$file: $content<br>";
        }
        echo "<br>";
    }
}
?>
