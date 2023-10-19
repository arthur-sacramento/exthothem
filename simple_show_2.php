<!DOCTYPE html>
<html>
<head>
    <title>HTML File Viewer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 10px;
            vertical-align: top;
        }

        td:first-child {
            width: 30%;
            border-right: 1px solid #ccc;
            padding-right: 10px;
        }

        h2 {
            color: #333;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            margin-bottom: 5px;
        }

        a {
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        pre {
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 10px;
            white-space: pre-wrap;
        }

        div[align='center'] {
            text-align: center;
            margin-top: 20px;
            color: #777;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <td>
                <h2>Categories</h2>
                <ul>
                    <?php
                    $folder = 'categories/contents';
                    $files = scandir($folder);

                    foreach ($files as $file) {
                        if (pathinfo($file, PATHINFO_EXTENSION) === 'html') {
                            echo "<li><a href='?file=$file'>$file</a></li>";
                        }
                    }
                    ?>
                </ul>
            </td>
            <td>
                <?php
                if (isset($_GET['file'])) {
                    $selectedFile = $_GET['file'];

                    echo "<h2>$selectedFile</h2><hr>";

                    $filePath = "$folder/$selectedFile";
                    
                    if (file_exists($filePath) && pathinfo($filePath, PATHINFO_EXTENSION) === 'html') {
                        $fileContents = file_get_contents($filePath);
                        echo "<pre>$fileContents</pre>";
                    } else {
                        echo "Invalid file selected.";
                    }
                } else {
                    echo "Select a file from the list on the left.";
                }
                ?>
            </td>
        </tr>
    </table>
    <div align='center'>eXthothem - 2023</div>

<script>
// change the path of all images to display correctly.

// Select all image elements on the page
const images = document.querySelectorAll('img');

// Loop through each image and modify the src attribute
images.forEach((image) => {
    // Get the current src attribute value
    let currentSrc = image.getAttribute('src');    
    let fullIMG = image.getAttribute('src');    
    
    // Get the path of the original image
    fullIMG = "categories/contents/" + (fullIMG.replace(/\/c_/g, "/"));
    
    // Add "categories/contents/" to the beginning of the src attribute
    currentSrc = `categories/contents/${currentSrc}`;
    
    // Set the modified src attribute value
    image.setAttribute('src', currentSrc);

            image.addEventListener('click', function() {
                             
                // Redirect the user to the image URL
                window.location.href = fullIMG;
            });


});
</script>
</body>
</html>
