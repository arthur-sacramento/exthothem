<html>
   <body> 
   <form action='flat_insert_link.php' method='POST'>
     URL<br>
     <input type='text' name='search'>
     <input type='submit' name='submit'>
   </form>

<?php

if (isset($_POST['submit'])) {

  // Create the project folders
  include ("dir_create.php");

  $search = $_POST['search'];
  if ($search == ""){$search = $_GET['search'];}	

  $result = preg_replace('/\W+/', '_', $search);

  $dir = "categories/contents";

  // Explode the search string by underscores
  $parts = explode('_', $result);

  // Create a folder for each part in the 'categories' directory
  foreach ($parts as $part) {

    $fileName = $part . ".txt";

    // Check if the folder already exists

    $fp = fopen("$dir/$fileName", "a");
    fwrite($fp, "$search \n");
    fclose($fp); 

  }

  echo '</br>';
  echo 'success!';
}
?>