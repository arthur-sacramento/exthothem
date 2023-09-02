<!DOCTYPE html>
<html>

<head>
    <title>Insert Link</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        form {
            width: 300px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }

        form input[type="text"] {
            width: 90%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
        }

        form input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }

        form input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <form action="flat_insert_link.php" method="POST">
        URL<br>
        <input type="text" name="search">
        <input type="submit" name="submit" value="Submit">
    </form>
</body>

</html>
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