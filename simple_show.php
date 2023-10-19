<!DOCTYPE html>
<html>
<head>
    <title>HTML File Viewer</title>
</head>
<body>
    <table style="width: 100%;">
        <tr>
            <td style="width: 30%; border-right: 1px solid #ccc; padding-right: 10px;" valign='top'>
                <h2>File List</h2>
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
            <td style="width: 70%; padding-left: 10px;" valign='top'>
                
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
</body>
</html>

