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

  #modal-container {
    display: none;
    position: fixed;
    z-index: 9999;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
  }

  #modal-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff;
    padding: 20px;
  }

  #close-modal {
    margin-top: 10px;
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

$start = $_GET['start'];  
	
if (!$start){$start = 0;}

$search = $_POST['search'];

if ($search == ""){$search = $_GET['search'];}	

// Avoid accessing the above directories
//$search = str_replace('.', "", $search);

$specialCharacters = array ('<','>');        

$search = str_replace($specialCharacters, "", $search); 

if ($search == ""){
    $search = '.';
}
                        
$c = 0;
$limit = 100;
$ini = $start *  $limit;
$end = $ini + $limit;

$entry = 0;

$collum = 0;

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
        file_put_contents($folder_html_img, $fileContent);
    }
}

echo "$result <div align='center'><table width='95%'>";

if ($search != "" ){

    $dir = 'categories';

    // Open the directory
    if ($handle = opendir($dir)) {

        // Loop through each subdirectory
        while (false !== ($subdir = readdir($handle))) {

            if ($subdir != "." && $subdir != ".." && is_dir($dir.'/'.$subdir)) {

                // Open the subdirectory
                if ($subhandle = opendir($dir.'/'.$subdir)) {

                    // Loop through each file in the subdirectory
                    while (false !== ($file = readdir($subhandle))) { 
                        
                        $filename_written = $file;  

                        // Find the occurrence in lower or uppercase                     
                        $file_l = strtolower($file);
                        $subdir_l = strtolower($subdir);  
                        
                        // Check if the filename contains the string 
                        // If there is a category with the searched name all the files within that category will be displayed
                        if (strpos($file_l, $search) !== false || $subdir_l == $search) {

                            // Pagination
                            if($entry > $ini && $entry < $end){
                                
                                if ($file == "." || $file == ".."){
                                    continue;
                                }                                

                                $file_path = $dir.'/'.$subdir.'/'.$file;

                                // Get size of the file
                                $filesize = filesize($file_path);

                                $contents = $file_path;

                                // For get the last dot in the filename
                                $lastDotIndex = strrpos($contents, ".");
                                
                                if ($lastDotIndex) {

                                    $filetype = substr($contents, $lastDotIndex + 1);  

                                    $filetype = strtolower($filetype);

                                    // Don't show characters or variables after the file extension
                                    $filetype = substr($filetype, 0, 3);       
                                
                                } else {

                                    $filetype = "none";
                                }                               

                                $display_name = $filename_written;

                                $name_len = strlen($filename_written);

                                // Cut string if name is long
                                if ($name_len > 20){
                                    $display_name = substr($display_name, 0, 20) . "...";
                                }           

                                $img = "";

                                $download_link = "&nbsp;<a href='categories/$subdir/$filename_written' target='blank'>download</a>";

                                // Show case be a picture extension
                                if($filetype == "png" || $filetype == "jpg" || $filetype == "jpeg" || $filetype == "gif"){

                                    $img = "<td width='33%' valign='top'><a href='$contents' target='_blank'><img id='$display_name' src='$contents' width='100%'></a><br><h1>$display_name</h1><a href='comment.php?hash=$file' target='_blank'>comment</a>$download_link<td>";  
                                 
                                }                     

                                // Show a thumbnail case exists
                                if(file_exists('thumbs/' . $filename_written . '.jpg')){

                                   $img = "<td width='33%' valign='top'><a href='categories/$subdir/$filename_written' target='_blank'><img id='$display_name' src='thumbs/$filename_written.jpg' height='200px'></a><br><h1>$display_name</h1><a href='comment.php?hash=$file' target='_blank'>comment</a>$download_link<td>";  
  
                                }

                                if(file_exists('description/' .  '/' . $filename_written . '.html')){

                                    $description = file_get_contents('description/' . '/' . $filename_written . '.html');  
                 
                                } //echo $search_break;

                                // Toggle table colors                                
                                // Show in the end the contents that don't are pictures (for don't break the pictures flow the 'continue' is used)
                                if ($img == ""){

                                    $toggle++; $td_color = $toggle % 2 == 0 ? '#FFF' : '#EEE'; $text_result = $text_result . "<tr style='background-color: $td_color;'><td>&nbsp; <a href='$contents' target='_blank'>$filename_written</a></td><td>$subdir</td><td>$filetype</td><td><a href='comment.php?hash=$file' target='_blank'>comment</a></td></tr>";$search_break++; 

                                } else {
      
                                    //Align and format content in columns
                                    if($collum == 0){echo "<tr>";}

                                    echo $img;                                                                         

                                    $collum++;  

                                    if($collum == 3){echo "</tr>"; $collum = 0;}     

                                }             
                            
                                $search_break++;                         
                                
                            }

                            $entry++;
                        
                            // Skip the files of the directory when reached the total results
                            if($search_break == $end){break;}
                        }
                   
                    }

                    if($search_break == $end){break;}
          
                    // Close the subdirectory
                    closedir($subhandle); 
                }
            
            }

        }

        // Close the directory
        closedir($handle);
    }

    if ($search_break == 0){
        echo "<br>Not found.";
    }

} 

echo "</table><br><table width='95%'>$text_result</table><br><br></div>";

?>  

<!-- The top bar -->
<div class="top">
  <table width='100%'>
  <tr>
    <td width='50%'>
      <form action="files_pagination.php" method="POST">
        &nbsp; <a href='index.php'>Home</a>             
        <input type="text" class="search" placeholder="Name or category" name="search">
        <input type="submit" class="buttonGreen" value="Search">                 
        <span id="itemName2"></span>
      </form>
    </td>
    <td align='right' width='50%'>
      <a href='files_pagination.php?search=mp4'>Videos</a>
      <a href='files_pagination.php?search=img'>Pictures</a>
      <a href='files_pagination.php?search=mp3'>Music</a>
      <a href='files_pagination.php?search=zip'>Zip</a>
      <a href='files_pagination.php?search=pdf'>PDF</a>
<?php $start++; echo "<a style='color:#7FFF00; text-decoration: underline;' href='files.php?start=$start&search=$search'>NEXT</a>"; ?>
&nbsp;&nbsp;

      </td>
    </tr>
  </table>
</div>
 
</body>
</html>
