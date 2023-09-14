<!DOCTYPE html>
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

        button, input[type="submit"] {
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
        foreach ($files as $file) {
            // Load the HTML content of each file
            $html = file_get_contents($file);

            // Create a DOMDocument for parsing
            @$dom = new DOMDocument();
            @$dom->loadHTML($html); // Suppress warnings, as HTML may not be perfect

            // Create a DOMXPath object to query the DOM
            $xpath = new DOMXPath($dom);

            // Query the rows that contain the search text
            $query = "//tr[contains(translate(td/text(), 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', 'abcdefghijklmnopqrstuvwxyz'), '" . strtolower($searchText) . "')]";

            $filteredRows = $xpath->query($query);

            $parts = explode('.', basename($file));
           
            // Get the first part (before the dot)
            $word = $parts[0];

            // Display the file name and matching rows
            if ($filteredRows->length > 0) {
                echo '<h2>' . basename($file) . '</h2>';
                echo '<table>';
                foreach ($filteredRows as $row) {

                    $first_td = $row->getElementsByTagName('td')->item(0);
                    $first_td_text = $first_td ? $first_td->textContent : '';
                     
                    // Add a "delete" button with JavaScript onclick event
                    echo '<tr>';
                    //echo $dom->saveHTML($row);
                    echo $td_show = $dom->saveHTML($row);

                    echo '<td><button onclick="deleteRows( \'' .  $first_td_text . '\', \'' . $file . '\')">Delete</button></td>';
                    echo '</tr>';
                }
                echo '</table>';
            }
        }
    } else {
        echo "No HTML files found in the directory.";
    }
}
?>

<script>
    // JavaScript function to delete rows and replace them with ""
    function deleteRows(button, fileName) {
        var password = prompt("Enter the password to delete these rows:");
        if (password === "12345") {

          var url = "table_row_delete.php?file=" + encodeURIComponent(fileName) + "&tr_contents=" + button;    

         //alert(button);
         //alert(fileName);

         window.location.href = url;

        } else {
            alert("Incorrect password. Rows not deleted.");
        }
    }
</script>


&nbsp;<a href='index.php'>back</a>
</body>
</html>
