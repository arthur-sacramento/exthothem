<!DOCTYPE html>
<html>
<head>
    <title>List of Categories</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        li {
            margin-bottom: 5px;
        }

        .categories-list {
            width: 300px;
            border: 1px solid #ccc;
            padding: 10px;
        }

        .categories-list h2 {
            margin: 0;
            padding-bottom: 10px;
            border-bottom: 1px solid #ccc;
        }

        .categories-list ul {
            padding-left: 20px;
        }

        .categories-list li:before {
            content: "\2022"; /* Bullet point */
            color: #666;
            display: inline-block;
            width: 10px;
            margin-left: -20px;
        }
    </style>
</head>
<body>
    <div class="categories-list">
        <h2>List of Categories</h2>
        <ul>
            <?php
            $categoriesDir = 'categories';

            if (!is_dir($categoriesDir)) {
                die("The '{$categoriesDir}' directory does not exist.");
            }

            $folders = scandir($categoriesDir);
            $folders = array_diff($folders, array('.', '..'));

            foreach ($folders as $folder) {
                if (is_dir($categoriesDir . '/' . $folder)) {
                    echo "<li><a href='files_simple.php?search=$folder'>$folder</a></li>";
                }
            }
            ?>
        </ul>
    </div>
</body>
</html>