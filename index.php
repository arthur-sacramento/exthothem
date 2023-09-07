<?php 
  error_reporting(0);
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Flat Database</title>
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
            <a href="index.php">Home</a>
        </div>
        <div class="main-content">
<?php

$database = $_POST['database'];
$title = $_POST['title'];
$link = $_POST['link'];
$description = $_POST['description'];
$user = $_POST['user'];

$database = strtolower($database);

$avoid_js_insertion = array ('<','>');        

$database = str_replace($avoid_js_insertion, "", $database); 
$title  = str_replace($avoid_js_insertion, "", $title ); 
$link = str_replace($avoid_js_insertion, "", $link); 
$description = str_replace($avoid_js_insertion, "", $description); 

$empty_check = $title . $link . $description;

$date = date('Y-m-d');

$dir = "categories/contents"; 

if (isset($_POST['submit']) && $empty_check != "") {

  mkdir("$dir", 0755, true);

  if(file_exists("$dir/$database.html")){

    $fp = fopen("$dir/$database.html", "a");
    fwrite($fp, "<tr><td>$title</td><td><a href='$link' target='_blank'>$link</a></td><td>$date</td><td>$description</td><td><i>$user</i></td></tr>");
    fclose($fp);
  } else {
    $fp = fopen("$dir/$database.html", "a");
    fwrite($fp, "<link rel='stylesheet' type='text/css' href='../../tables.css'><table class='main_table'><tr class='table_fields'><td>Name</td><td>Link</td><td>Date</td><td>Description</td><td>User</td></tr><tr><td>$title</td><td><a href='$link' target='_blank'>$link</a></td><td>$date</td><td>$description</td><td><i>$user</i></td></tr>");
    fclose($fp);
 }

  echo "Database '<i>$database</i>'</br>";  

  include("$dir/$database.html");

} else {

  if (isset($_POST['submit']) && $database != "") {

    if(file_exists("$dir/$database.html")){

      echo "Database '<i>$database</i>'</br>";  
      include("$dir/$database.html");

    } else {

      echo "This table do not exists.";
  
    }  

  } else {

    echo "<h1>eXthothem</h1>Our system uses simple HTML tables to store data. This allows users to easily access, save, and copy data in a straightforward manner, eliminating the need for complex databases or data exchange formats.";

    echo " <a href='menu_contents.php'>More options.</a>";
    echo "<hr><br><h1>Sourcecode</h1><a href='https://github.com/arthur-sacramento/exthothem' target='_blank'>Github</a>     <a href='https://sourceforge.net/projects/exthothem/' target='_blank'>Sourceforge</a>";
 
  }

}

?>
       </div>
    </div>
  </body>
</html>
