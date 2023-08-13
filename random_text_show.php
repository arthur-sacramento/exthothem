<?php

session_start();

// Define the path to the 'words' folder
$mainFolderPath = 'words/';

// Loop to select and display folders and files
while (true) {
    // Get a list of subfolders in the main folder
    $folders = scandir($mainFolderPath);

    // Filter out '.' and '..' directories
    $folders = array_diff($folders, array('.', '..'));

    // If no more folders are available, exit the loop
    if (empty($folders)) {
        echo "No more folders available.\n";
        break;
    }

    if ($_SESSION['prev'] != ""){$randomFolder = $_SESSION['prev'];} else {
   
     // Select a random folder from the list
    $randomIndex = array_rand($folders);
    $randomFolder = $folders[$randomIndex];

    }

    // Display the selected folder name
    echo "$randomFolder ";

    // Get a list of files in the selected folder
    $folderPath = $mainFolderPath . $randomFolder . '/';
    $files = scandir($folderPath);

    // Filter out '.' and '..' directories
    $files = array_diff($files, array('.', '..'));

    // If the folder contains files, select and display a random file
    if (!empty($files)) {
        $randomIndex = array_rand($files);
        $randomFile = $files[$randomIndex];

        // Display the selected file name
        echo "$randomFile";
        $_SESSION['prev'] = $randomFile;
        break; // Exit the loop since we have a file
    } else {
        // Restart the process if the folder has no files
        echo "Selected Folder has no files. Restarting...\n";
    }
}
?>
