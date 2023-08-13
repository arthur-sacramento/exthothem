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

// Loop through each file and check its content on each host
foreach ($files as $file) {
    echo "Checking file: $file<br>";

    // Read the local file content
    $localFilePath = $folderPath . $file;
    $localContent = file_get_contents($localFilePath);

    foreach ($hosts as $host) {
        $fileUrl = "http://$host/$folderPath$file";
        $remoteContent = @file_get_contents($fileUrl);

        if ($remoteContent !== false) {
            if ($localContent === $remoteContent) {
                echo "Content of $file on $host is equal to local content<br>";
            } else {
                echo "Content of $file on $host is NOT equal to local content<br>";
            }
        } else {
            echo "$file does not exist on $host<br>";
        }
    }

    echo "<br>";
}
?>
