<?php
$folderPath = 'categories/files/';

// Search for files
if (isset($_POST['search'])) {
    $searchTerm = $_POST['searchTerm'];
    $searchResults = searchFiles($folderPath, $searchTerm);
}

// Delete a file
if (isset($_GET['delete'])) {
    $fileToDelete = $_GET['delete'];
    deleteFile($folderPath, $fileToDelete);
}

// Function to search for files
function searchFiles($folderPath, $searchTerm) {
    $results = array();

    if ($handle = opendir($folderPath)) {
        while (false !== ($entry = readdir($handle))) {
            if ($entry != "." && $entry != ".." && is_file($folderPath . $entry)) {
                if (strpos($entry, $searchTerm) !== false) {
                    $results[] = $entry;
                }
            }
        }
        closedir($handle);
    }

    return $results;
}

// Function to delete a file
function deleteFile($folderPath, $fileName) {
    $filePath = $folderPath . $fileName;

    if (file_exists($filePath)) {
        if (unlink($filePath)) {
            return "File '$fileName' deleted successfully.";
        } else {
            return "Error deleting file '$fileName'.";
        }
    } else {
        return "File '$fileName' does not exist.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>File Search and Delete</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1, h2 {
            color: #333;
        }

        form {
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="submit"] {
            padding: 10px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        li {
            margin-bottom: 5px;
        }

        .success {
            color: green;
        }

        .error {
            color: red;
        }

        .delete-link {
            color: #FF0000;
            margin-left: 10px;
            text-decoration: none;
        }

        .delete-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>File Search and Delete</h1>

    <h2>Search Files</h2>
    <form method="post" action="">
        <input type="text" name="searchTerm" placeholder="Enter search term">
        <input type="submit" name="search" value="Search">
    </form>

    <?php
    if (isset($searchResults)) {
        if (count($searchResults) > 0) {
            echo "<h3>Search Results:</h3>";
            echo "<ul>";
            foreach ($searchResults as $result) {
                echo "<li>$result <a class='delete-link' href='?delete=$result'>Delete</a></li>";
            }
            echo "</ul>";
        } else {
            echo "<p class='error'>No results found.</p>";
        }
    }
    ?>

</body>
</html>
