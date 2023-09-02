<!DOCTYPE html>
<html>
<head>
    <style>
        /* Basic CSS styles for the list */
        ul {
            list-style-type: none;
        }

        li {
            padding: 5px;
            border: 1px solid #ccc;
            margin: 5px;
            background-color: #f0f0f0;
        }

        /* Style for the folder links */
        a {
            text-decoration: none;
            color: #007bff;
        }
    </style>
</head>
<body>
    <h1>Gallery list</h1>
    <ul>
        <?php
        // Define the directory path
        $directory = 'categories/';

        // Get a list of all items in the directory
        $items = scandir($directory);

        // Loop through the items
        foreach ($items as $item) {
            // Check if it's a directory and contains 'gallery' in its name
            if (is_dir($directory . $item) && strpos($item, 'gallery') !== false) {
                // Generate a link to the folder
                echo "<li><a href='$directory/$item/1.html'>$item </a></li>";
            }
        }
        ?>
    </ul>
</body>
</html>
