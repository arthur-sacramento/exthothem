<?php
$zipFileName = 'data.zip';
$sourceDir = ''; // Replace with the path to your source directory

// Check if the zip file already exists
if (!file_exists($zipFileName)) {
    // Create a ZipArchive object
    $zip = new ZipArchive();

    // Create the zip file
    if ($zip->open($zipFileName, ZipArchive::CREATE) === TRUE) {
        // Create a recursive iterator to loop through all files and directories
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($sourceDir));

        foreach ($iterator as $file) {
            // Exclude "." and ".." directories
            if (!$iterator->isDot()) {
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($sourceDir) + 1);

                // Add the file or directory to the zip archive
                if ($file->isDir()) {
                    $zip->addEmptyDir($relativePath);
                } else {
                    $zip->addFile($filePath, $relativePath);
                }
            }
        }

        // Close the zip archive
        $zip->close();
        echo "Contents zipped successfully to $zipFileName.";
    } else {
        echo "Failed to create $zipFileName.";
    }
} else {
    echo "$zipFileName already exists. No action taken.";
}
?>
