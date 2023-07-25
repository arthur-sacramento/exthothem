<!DOCTYPE html>
<html>
<head>
    <title>List Files in Folder</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            margin-bottom: 10px;
        }
        form {
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
        input[type="text"] {
            padding: 5px;
        }
        button {
            padding: 5px 10px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            padding: 5px;
            background-color: #f5f5f5;
            margin-bottom: 5px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h1>List Files in Folder</h1>

    <form method="post">
        <label for="folder_name">Enter folder name:</label>
        <input type="text" name="folder_name" id="folder_name" required>
        <button type="submit">List Files</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Sanitize user input to prevent directory traversal
        $folder_name = basename($_POST["folder_name"]);

        // Check if the folder exists
        $folder_path = "categories/$folder_name";
        if (!is_dir($folder_path)) {
            echo "<p>Folder not found. Please enter a valid folder name.</p>";
        } else {
            echo "<h2>Files in $folder_name:</h2>";
            echo "<ul>";

            // Open the folder and read its contents
            $files = scandir($folder_path);
            foreach ($files as $file) {
                // Skip current and parent directory entries
                if ($file === "." || $file === "..") continue;
                echo "<li><a href='$folder_path/$file' target='_blank'>$file</a></li>";
            }

            echo "</ul>";
        }
    }
    ?>
</body>
</html>
