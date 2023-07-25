<?php 
error_reporting(0);
?>

<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
  }

  .container {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  .form-group {
    margin-bottom: 10px;
  }

  .form-group input[type="text"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 14px;
  }

  .form-group input[type="submit"] {
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    background-color: #4CAF50;
    color: #fff;
    font-size: 14px;
    cursor: pointer;
  }

  .comments {
    margin-top: 20px;
    padding-top: 20px;
    border-top: 1px solid #ccc;
  }

  .comments a {
    color: #0066cc;
    text-decoration: none;
  }
</style>
<body>
  <div class="container">
    <div align='center'>
      <form method='post' action=''>
        <div class="form-group">
          <input type='text' name='name' placeholder='Name'>
        </div>
        <div class="form-group">
          <input type='text' name='message' placeholder='Message'>
        </div>
        <div class="form-group">
          <input type='submit' name='submit' value='Submit'>
        </div>
      </form>
    </div>
    <hr>
<?php

$a = sha1($_GET['hash']);

if (isset($_POST['submit'])) {
  $n = $_POST['name'];
  $m = $_POST['message'];
  $d = array ('>','<');
  $n = str_replace($d, "", $n); 
  $m = str_replace($d, "", $m);
  $s = sha1("$n $m");
  $l = "<a href='comment.php?hash=$s' target='_blank'>[comment]</a> $n : $m <br>";
  file_put_contents("comments/$a", $l, FILE_APPEND);
}

$m = file_get_contents("comments/$a");
echo "<table>$m</table>";

?>
