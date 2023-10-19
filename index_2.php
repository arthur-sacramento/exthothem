<?php 
  error_reporting(0);
?>

<!DOCTYPE html>
<html>
  <head>
    <title>HTML Database</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        .container {
            display: flex;
            justify-content: space-between;
            background-color: #fff;
            border: 1px solid #ccc;
            margin: 20px;
            padding: 20px;
        }

        .sidebar {
            width: 20%;
            padding-right: 20px;
        }

        .main-content {
            width: 75%;
        }

        .main_table {
            width: 100%;
        }

        td {
            border: 1px solid #ccc;
            padding: 10px;
        }

        .table_fields {
            background-color: #DDD;
        }

        .form-container {
            margin-top: 10px;
        }

        form {
            margin-bottom: 20px;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }

        hr {
            border: 0;
            border-top: 1px solid #ccc;
            margin: 10px 0;
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
        .date {
            font-size: 0.8rem;
            color: #888;
        }

        .user {
            font-family: arial;
            font-size: 0.8rem;
            color: #999;
            text-decoration: italic;
        }

        /* Style for short description */
        .url {
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

div.others-links a {
letter-spacing: 2px;
font-size: 12px;

}

.others-links {
letter-spacing: 2px;
font-size: 12px;
}
    </style>
  </head>

  <body>
    <div class="container">
        <div class="sidebar">
            <form action="search_tables.php" method="POST">
                <input type="text" name="search">
                <input type="submit" value="Search">
            </form>
            <hr>
            <form action="index.php" method="POST" class="form-container">
                Database name or category</br>
                <input type="text" name="database">
                </br>Title</br>
                <input type="text" name="title">
                </br>Link or URL</br>
                <input type="text" name="link">
                </br>Description</br>
                <textarea name="description"></textarea>
                </br>User or source</br>
                <input type="text" name="user">
                <br><input type="submit" name="submit" value="Submit">
            </form>
            <a href="create.php"><u>+ Create contents</u></a>
        </div>
        <div class="main-content">
<?php

$table = $_GET['table'];
$table_number = $_GET['num'];

$database = $_POST['database'];
$title = $_POST['title'];
$link = $_POST['link'];
$description = $_POST['description'];
$user = $_POST['user'];

$database = strtolower($database);
$database = str_replace(" ", "_", $database); 

$avoid_js_insertion = array ('<','>');        

$database = str_replace($avoid_js_insertion, "", $database); 
$title  = str_replace($avoid_js_insertion, "", $title ); 
$link = str_replace($avoid_js_insertion, "", $link); 
$description = str_replace($avoid_js_insertion, "", $description); 

$empty_check = $title . $link . $description;

$date = date('Y-m-d');

$dir = "categories/contents"; 

// Script to show a table related to the user input.
include("redirect.php");

if ($table != "" && $table_number != ""){$database = $table . "_" . $table_number;}

if (isset($_POST['submit']) && $empty_check != "") {

  mkdir("$dir", 0755, true);
  
  $max_table_size = 15000;

  $x = 1;

  while(true){

    $table_count = "_" . $x;

    if ($x == 1){$table_count = "";}

    $current_table = $database . $table_count . ".html";
    
    $next_table_count = "_" . ($x + 1);

    $next_table = $database . $next_table_count . ".html";

    $file_size = filesize("$dir/$current_table");

    if($file_size < $max_table_size){

      if(file_exists("$dir/$current_table")){
        $fp = fopen("$dir/$current_table", "a");     
        fwrite($fp, "<tr><td>$title</td><td><a href='$link' target='_blank'>$link</a></td><td>$date</td><td>$description</td><td><i>$user</i></td></tr>");
      } else {
        $fp = fopen("$dir/$current_table", "a");
        fwrite($fp, "<link rel='stylesheet' type='text/css' href='../../tables.css'><div class='next-page'><a href='$next_table'>next</a></a></div><table class='main_table'><tr class='table_fields'><td>Name</td><td>Link</td><td>Date</td><td>Description</td><td>User</td></tr><tr><td>$title</td><td><a href='$link' target='_blank'>$link</a></td><td>$date</td><td>$description</td><td><i>$user</i></td></tr>");
       
      }

      fclose($fp);
      break;
    }
  $x++;
  }
  
  fclose($fp);

  echo "Database '<i>$database</i>'</br>";  

  include("$dir/$database.html");
 
} else {

  if ($database != "") {

    if(file_exists("$dir/$database.html")){

      echo "Database '<i>$database</i>'</br>";  
      include("$dir/$database.html");
      
    } else {

      echo "This table do not exists.";
  
    }  

  } else {

    echo "<div align='right'><a href='exthothem1.0.3.zip' target='_blank'><u>Download sourcecode</u></a></div>";

    echo "<h1>eXthothem</h1><br>Store data in simple HTML tables and access it easily and quickly without a complex database or data exchange format. ";
    echo "<br><a href='menu_contents.php'>More options.</a>";

    echo "<br><br><hr><h1>Quick menu</h1>";

    echo "<li><a href='index.html'>JS search</a></li>";

    echo "<li><a href='create.php'>Content creation</a></li>";

    echo "<li><a href='zip_gallery.php'>Create a gallery</a></li>";
 
    echo "<li><a href='quick_guide.html'>Quick guide</a></li>";

    echo "<br><br><br><hr><table width='100%'><tr><td><div class='others-links'>PHP Freelance<br><a href='https://www.fiverr.com/arthursacrament' target='_blank'>Fivver / </a>";
  
    echo "<a href='https://www.fiverr.com/arthursacrament' target='_blank'>Upwork / </a> ";

    echo "<a href='https://www.linkedin.com/in/arthur-sacramento-a55003230/' target='_blank'>Linkedin / </a>";

    echo "<a href='http://wa.me/5591983608861' target='_blank'>Whatsapp / </a>"; 
   
    echo "<a href='#' onclick=\"alert('exthothem@gmail.com');\">Email</a>";

    echo "<br><br>Donations</br><a href='https://www.paypal.com/donate/?hosted_button_id=MA7KAL6PP4Y7Q' target='_blank'>Pay Pal / </a>";

    echo "<a href='#' onclick=\"alert('exthothem@gmail.com');\">Pix / </a> ";
    
    echo "<a href='#' onclick=\"alert('1CX6rNZnBexgTW8HW8VRhBoKAG3TsNc9Em');\">BTC</a>";

    echo "<br><br> Web<br><a href='https://sourceforge.net/projects/exthothem/' target='_blank'>Sourceforge / </a> ";

    echo "<a href='https://sourceforge.net/projects/exthothem/' target='_blank'>Github / </a> ";

    echo "<a href='http://exthothem.000webhostapp.com/' target='_blank'>Website / </a> ";

    echo "<a href='https://exthothemdb.blogspot.com/' target='_blank'>Blog /</a> ";

    echo "<a href='https://twitter.com/exthothem' target='_blank'>Twitter</a>";

    echo "<br><br> Download (v.1.0.3)<br><a href='#' target='_blank'>Mega / </a> ";

    echo "<a href='#' target='_blank'>4Shared / </a> ";

    echo "<a href='#' target='_blank'>Mediafire / </a> ";

    echo "<a href='#' target='_blank'>Google Drive /</a> ";

    echo "</div></td><td>Other services</br><br>";

    echo "<a href='aai.html' target='_blank'>Adult AI magazine</a><br>";

    echo "<a href='lander.html' target='_blank' onclick=\"alert('Have access to exclusive updates, support and commercial use.');\">Enterprise version</a><br>";

    echo "<a href='lander.html' target='_blank'>Advertise or sponsoor</a><br>";

    echo "<a href='lander.html' target='_blank'>Text translations<br>";

    echo "<a href='lander.html' target='_blank'>Content creation with AI<br>";

    echo "<a href='lander.html' target='_blank'>Content moderation<br>";

    echo "<a href='lander.html' target='_blank'>WordPress<br>";

    echo "<a href='lander.html' target='_blank'>Earn and invest<br>";

    echo "</td></tr></table>";

    //echo "<br><br><hr><i>Tip: You can open a table filling only the field 'Database name or category'</i>";
 
  }

}

if ($table_number == "" || $table_number == 0){$table_number = 1;}

$next_table = $table_number + 1;

if ($table == ""){$table = $database;}

if(file_exists("$dir/$table" . "_" . $next_table . ".html")){echo "<div align='right'><a href='index.php?table=$table&num=$next_table'><h1>Next</h1></div>";}  
?>
<br><br><iframe src='https://filevenda.netlify.app/categories/ads.html' width='100%' style='border: 0px;'></iframe>
       </div>
    </div>
<?php 

if (!isset($_POST['submit']) && $empty_check == "" && $table == "") {echo "<div align='center'>eXthothem - 2023</div>"; 
  //include ("mirrors.php");
}

?>
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
