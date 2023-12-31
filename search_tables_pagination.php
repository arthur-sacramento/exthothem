﻿<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table Rows Filter</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #007BFF;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        form {
            text-align: center;
            margin: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"] {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 300px;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        h2 {
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }
    </style>
</head>
<body>
    <header>
        <h1>HTML Table Rows Filter</h1>
    </header>
    <form method="post">
        <label for="search">Search:</label>
        <input type="text" name="search" id="search" placeholder="Enter search text">
        <input type="submit" value="Filter">
    </form>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input
    $searchText = isset($_POST["search"]) ? $_POST["search"] : "";

    // Directory containing HTML files
    $directory = 'categories/contents';

    // List all HTML files in the directory
    $files = glob($directory . '/*');

    if (!empty($files)) {
        // Define pagination variables
        $itemsPerPage = 10; // Number of items per page
        $currentPage = isset($_GET["page"]) ? (int)$_GET["page"] : 1; // Current page number

        // Filter files based on search criteria
        $filteredFiles = array_filter($files, function ($file) use ($searchText) {
            $html = file_get_contents($file);
            $dom = new DOMDocument();
            @$dom->loadHTML($html);
            $xpath = new DOMXPath($dom);
            $query = "//tr[contains(translate(td/text(), 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', 'abcdefghijklmnopqrstuvwxyz'), '" . strtolower($searchText) . "')]";
            $filteredRows = $xpath->query($query);
            return $filteredRows->length > 0;
        });

        // Calculate total pages
        $totalPages = ceil(count($filteredFiles) / $itemsPerPage);

        // Slice the filtered files to display on the current page
        $startIndex = ($currentPage - 1) * $itemsPerPage;
        $slicedFiles = array_slice($filteredFiles, $startIndex, $itemsPerPage);

        if (!empty($slicedFiles)) {
            foreach ($slicedFiles as $file) {
                // Load the HTML content of each file
                $html = file_get_contents($file);

                // Create a DOMDocument for parsing
                $dom = new DOMDocument();
                @$dom->loadHTML($html); // Suppress warnings, as HTML may not be perfect

                // Create a DOMXPath object to query the DOM
                $xpath = new DOMXPath($dom);

                // Query the rows that contain the search text
                $query = "//tr[contains(translate(td/text(), 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', 'abcdefghijklmnopqrstuvwxyz'), '" . strtolower($searchText) . "')]";

                $filteredRows = $xpath->query($query);

                // Display the file name and matching rows
                if ($filteredRows->length > 0) {
                    echo '<h2>' . basename($file) . '</h2>';
                    echo '<table>';
                    foreach ($filteredRows as $row) {
                        echo $dom->saveHTML($row);
                    }
                    echo '</table>';
                }
            }

            // Pagination links
            echo '<div class="pagination">';
            for ($page = 1; $page <= $totalPages; $page++) {
                echo '<a href="?page=' . $page . '&search=' . urlencode($searchText) . '">' . $page . '</a>';
            }
            echo '</div>';
        } else {
            echo "No matching results found.";
        }
    } else {
        echo "No HTML files found in the directory.";
    }
}
?>

&nbsp;<a href='flat_database.php'>back</a>
</body>
</html>
