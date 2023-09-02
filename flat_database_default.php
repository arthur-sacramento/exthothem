<?php 
error_reporting(0);
?>

<html>
  <body>  
  <head>
    <title>flat database</title>
    <style>
    .main_table{
      width: 100%;
      font-family: arial;
    }

    td{
      border: 1px solid #CCC; 
      padding: 5px; 
    }

    .table_fields{
      background-color: #DDD;
    }
    </style>    
  </head>
    <table width='100%'><tr><td width='10%' valign='top'>
      <table>
        <tr>
          <td valign='top'>
            <form action='flat_database.php' method='POST'>
              <input type='text' name='search'> <input type='submit' name='search_submit' value='search'> 
            </form>
            <hr>
            <form action='flat_database.php' method='POST'>
              Database name or category</br>
              <input type='text' name='database'>
              </br>Title</br>
              <input type='text' name='title'>
              </br>Link or URL</br>
              <input type='text' name='link'>
              </br>Description</br>
              <textarea name='description'></textarea>
              </br>User or source</br>
              <input type='text' name='user'> 
              <br><input type='submit' name='submit' value='submit'> 
            </form>
            <a href='index.php'>Home</a>        
          </td>
        </tr>
      </table>
    </td>
    <td valign='top'>

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

$date = date('Y-m-d');

$dir = "categories/contents"; 

if (isset($_POST['submit'])) {

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
}

if (isset($_POST['search_submit'])) {

  $search = $_POST['search'];
  $search = strtolower($search);
  $search = str_replace($avoid_js_insertion, "", $search); 
  
  if(file_exists("$dir/$search.html")){
    echo "Database '<i>$search</i>' found!</br>";
    include("$dir/$search.html");
  } else {  
    echo "This database do not exists.";
  }

}

?>
    </td>
  </tr>
</table>
