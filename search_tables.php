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

 .container {
            display: flex;
            justify-content: space-between;
            margin: 20px;
            border: 1px solid #ccc;
            padding: 10px;
        }

        /* Style for the left column */
        .left-column {
            flex: 1;
            padding: 10px;
        }

        /* Style for the right column */
        .right-column {
            flex: 1;
            padding: 10px;
        }

        /* Style for thumbnail image */
        .thumbnail {
            max-width: 100%;
            height: auto;
        }

        /* Style for title */
        .title {
            font-size: 1.2rem;
            font-weight: bold;
            margin: 10px 0;
        }

        /* Style for date and user */
        .date, .user {
            font-size: 0.8rem;
            color: #888;
        }

        /* Style for short description */
        .short-description {
            margin-top: 10px;
            font-size: 0.9rem;
        }

        /* Style for full description */
        .description {
            margin-top: 10px;
            font-size: 1rem;
        }

        /* Style for full description */
        .next-page {
            visibility: hidden;
        }
    </style>   
</head>
<body>
    <header>
        <h1>HTML Search</h1>
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
        $files = glob($directory . '/*.html');

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

$htmlFilePath = $_SERVER['DOCUMENT_ROOT'] . "/$directory/$searchText.html";

    if(file_exists("$directory/$searchText.html")){

      include("$directory/$searchText.html");
      
    }



if(file_exists("categories/contents/$searchText" . "_2" . ".html")){echo "<div align='right'><a href='index.php?table=$searchText&num=2'><h1>Next</h1></div>";}  
    ?>

&nbsp;&nbsp;<a href='index.php'>back</a>

<br><iframe src='https://filevenda.netlify.app/categories/ads.html' width='100%' style='border: 0px;'></iframe>
<script>

// change the path of all images to display correctly.

// Select all image elements on the page
const images = document.querySelectorAll('img');

// Loop through each image and modify the src attribute
images.forEach((image) => {
    // Get the current src attribute value
    let currentSrc = image.getAttribute('src');
    
    // Add "../../" to the beginning of the src attribute
    currentSrc = `categories/contents/${currentSrc}`;
    
    // Set the modified src attribute value
    image.setAttribute('src', currentSrc);
});
</script>
</body>
</html>
