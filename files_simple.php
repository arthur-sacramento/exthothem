<?php 
error_reporting(0);
?>

<!DOCTYPE html>
<html>
<head>

<link rel="icon" href="icons/folder.png">

<style>

  body {
    font-family: Arial;
  }

  /* Style for the top bar */

  .top {
    position: fixed; /* Set position to fixed */
    top: 0; /* Position at the bottom of the page */
    left: 0;
    width: 100%; /* Set width to full */
    color: white;
    background-color: #739AAA; /* Set background color */
    border-top: 1px solid #333;
    font-family: verdana;
    letter-spacing: 2px;
  }

  .top a:link {
    color: #FFF;
    text-decoration: none;
    padding-right: 15px;
  }

  .top a:hover {
    color: #DDD;
  }

  .search {
    padding: 5px;
  }

  .button{
    padding: 20px;
    background-color: #000;
   //border-radius: 15px 15px 15px 15px;
   letter-spacing: 4px;
    font-size: 12px;
    font-family: Verdana;
    color: #FFFFFF;
    text-decoration: none;        
  }

  .button:hover{
    background-color: #666;
  }

  .buttonGreen{
    padding: 5px;
    background-color: #7FFF00;      
    letter-spacing: 4px;
    font-size: 12px;
    font-family: Verdana;
    color: #333;
    text-decoration: none;  
    cursor: pointer;      
  }

  </style>
</head>

<body>

<br><br><br><br>

<table width='100%' id='background-image'>
</table>
  <!-- Your page content -->

<?php

$search = $_POST['search'];

if ($search == ""){$search = $_GET['search'];}	

// Avoid accessing the above directories
//$search = str_replace('.', "", $search);

$specialCharacters = array ('<','>');        

$search = str_replace($specialCharacters, "", $search); 

// Check if there is dot in the user input. If it doesn't exist, it will skip to the search.
$lastDotIndex = strrpos($search, ".");

// Try download the contents if the user insert a link or URL
if($lastDotIndex){
                       
    $filetype = substr($search, $lastDotIndex + 1);

    // Don't show characters or variables after the file extension
    $filetype = substr($filetype, 0, 3);

    if ($filetype === "php") {
        echo "Extension not valid!";
        die;
    }

    // Replaces all non-alphanumeric values with an underscore
    $result = preg_replace('/\W+/', '_', $search);

    $categoriesDir = 'categories';

    // If the link or URL is to an image, try downloading
    $validImageExtensions = ["png", "jpg", "jpeg", "gif"];
    if (in_array($filetype, $validImageExtensions)) {
        $ext = "img";
    } else {
        $ext = $filetype;
    }

    $saveFolder = "categories/$ext/";

    // Create the folder if it doesn't exist
    if (!is_dir($saveFolder)) {
        mkdir($saveFolder, 0755, true);
    }

    // Create the save path

    $filenameFinal = str_replace("_" . $filetype, "." . $filetype, $result);

    $savePath = $saveFolder . $filenameFinal;

    // Download the image and save it
    $fileContents = file_get_contents("$search");

    $fp = fopen($savePath, "w");
    fwrite($fp, $fileContents);
    fclose($fp);

    // Explode the search string by underscores
    $parts = explode('_', $result);

    // Create a folder for each part in the 'categories' directory
    foreach ($parts as $part) {
        $folderName = $categoriesDir . '/' . $part;

        // Check if the folder already exists
        if (!is_dir($folderName)) {
            // Create the folder
            mkdir($folderName);
        }

        if ($ext === "img") {
            $fileContent = "<a href='../img/$filenameFinal'><img src='../img/$filenameFinal'></a>";
        } else {
            $fileContent = "<script>window.location.href = '$search';</script>";
        }

        $folder_html_img = $folderName . '/' . $result . '.html';

        $fp2 = fopen($folder_html_img, "w");
        fwrite($fp2, $fileContent);
        fclose($fp2);
    }
}

echo "$result <div align='center'><table width='95%'><tr><td>";

$directoryName = 'categories/' . $search;

// Show all the files inside of a folder. The folder name is the user input
if ($search) {
    // Check if the directory exists and is a valid directory
    if (is_dir($directoryName)) {
        $files = scandir($directoryName);
        if ($files !== false) {
            echo "<h2>Files in '$search':</h2>";
            foreach ($files as $file) {
                // Ignore current and parent directory entries
                if ($file !== '.' && $file !== '..') {
                    echo "<br><br><a href='categories/$search/$file' target='_blank'>" . basename($file) . "</a>";               
                   
                    $filetype = substr($file, -4);    

                    if($filetype == ".png" || $filetype == ".jpg" || $filetype == "jpeg" || $filetype == ".gif"){
                        echo "<br><img src='categories/$search/$file' width='75%'>";  
                    }   

                    $filetype = substr($file, -8); 

                    if($filetype == "png.html" || $filetype == "jpg.html" || $filetype == "gif.html"){

                        //include("categories/$search/$file");
                        $img_show = file_get_contents("categories/$search/$file");

                        echo "</br>";
                        echo $img_show = str_replace('..', "categories", $img_show);
                    } 

                    echo "<br><a href='comment.php?hash=$file' target='_blank'>comment</a> <a href='categories/$search/$file' target='_blank'>download</a>"; 
                }                         
            }
        } else {
            echo "<p>Error: Unable to read directory contents.</p>";
        }
    } else {
        echo "<li>The specified directory does not exist. Try <a href='files_full.php?search=$search'>full search</a></li>";
    }
}

echo "</td></tr></table>";

?>  

<!-- The top bar -->
<div class="top">
  <table width='100%'>
  <tr>
    <td width='50%'>
      <form action="files_simple.php" method="POST">
        &nbsp; <a href='index.php'>Home</a>             
        <input type="text" class="search" placeholder="Name or category" name="search">
        <input type="submit" class="buttonGreen" value="Search">                 
        <span id="itemName2"></span>
      </form>
    </td>
    <td align='right' width='50%'>
      <a href='files_simple.php?search=mp4'>Videos</a>
      <a href='files_simple.php?search=img'>Pictures</a>
      <a href='files_simple.php?search=mp3'>Music</a>
      <a href='files_simple.php?search=zip'>Zip</a>
      <a href='files_simple.php?search=pdf'>PDF</a>
      </td>
    </tr>
  </table>
</div>
 
</body>
</html>
