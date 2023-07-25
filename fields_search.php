<!DOCTYPE html>
<html>
<head>
    <title>Search Files in 'contents' Folder</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
        }

        h1 {
            text-align: center;
        }

        form {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"] {
            padding: 5px;
            font-size: 16px;
        }

        input[type="submit"] {
            padding: 5px 10px;
            font-size: 16px;
            cursor: pointer;
        }

        p {
            margin-bottom: 5px;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Search Files in 'contents' Folder</h1>
        <form method="post" action="fields_search.php">
            <label for="search_term">Enter search term:</label>
            <input type="text" name="search_term" id="search_term" required>
            <input type="submit" value="Search">
        </form>
        <hr>
<?php
    // Function to search for files containing the given search term
    function searchFilesInContents($searchTerm)
    {
        $contentsFolder = 'contents';
        $files = scandir($contentsFolder);
        
        foreach ($files as $file) {
            if ($file === '.' || $file === '..') {
                continue;
            }

            $filePath = $contentsFolder . '/' . $file;
            if (is_file($filePath) && strpos(file_get_contents($filePath), $searchTerm) !== false) {
                echo "<a href='$filePath' target='_blank'>$file</a></p>";
            }
        }
    }

    if (isset($_POST['search_term'])) {
        $searchTerm = $_POST['search_term'];
        searchFilesInContents($searchTerm);
    }
    ?>
    </div>
    <br>
    <div align='center'><a href='index.php'>Home</a></div>
</body>
</html>
