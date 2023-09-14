<?php

    $fileName = $_POST["fileName"];
    $updatedHtml = $_POST["updatedHtml"];

    // Write the updated HTML content back to the file
    if (file_put_contents($fileName, $updatedHtml) !== false) {
        echo "success"; // Return success if the file was updated successfully
    } else {
        echo "error"; // Return an error if there was an issue updating the file
    }
} 
?>
