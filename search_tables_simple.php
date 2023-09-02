<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table Rows Filter</title>
</head>
<body>
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
            foreach ($files as $file) {
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
        } else {
            echo "No HTML files found in the directory.";
        }
    }
    ?>
</body>
</html>
