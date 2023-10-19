<?php
// Directory containing the files
$directory = 'files/';

// Get the list of files in the directory
$files = scandir($directory);

// Variable to store the increment value
$x = 34;

// Iterate through the files and rename them
foreach ($files as $file) {
    // Exclude current directory and parent directory entries
    if ($file != "." && $file != "..") {
        // Get the file extension
        $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
        
        // New file name with incremented value and original extension
        $newFileName = $x . '.' . $fileExtension;
        
        // Rename the file
        rename($directory . $file, $directory . $newFileName);

        // Increment the variable 'x' for the next file
        $x++;
    }
}
?>