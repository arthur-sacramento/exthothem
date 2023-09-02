<?php error_reporting(0); ?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="icon" href="icons/folder.png">
    <title>file backup and sharing easy</title>
    <style>

      body {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
        margin: 0;
        padding: 0;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        height: 100vh;
        margin: 0;
        background-image: url("background/art.jpg");
      }

      form {
        display: flex;
        flex-direction: column;
        align-items: center;
      }

      input {
        width: 400px;
        height: 40px;
        font-size: 18px;
        margin-top: 10px;
      }

      .search-button {
        background-color: #111;
        color: white;
        cursor: pointer;
      }

      .button-container {
        display: flex;
        flex-direction: row;
      }
     
      a {
        font-family: verdana;
        letter-spacing: 6px;
        font-size: 16px;    
        color: #333;
        text-decoration: none;
      }

      a:hover {
        color: #666;
      }

      .panel {
        border: 1px solid #999;
        padding: 4px 12px 4px 12px;
        background-color: #fff;
        boder: 1px solid #CCC;
        opacity: 0.8;           
      }

      .presents  {
        font-family: verdana;
        letter-spacing: 6px;
        color: #333;
        opacity: 0.9;
        padding-left: 20px;
        padding-right: 20px;
      }

      .small-font  {
        font-size: 10px;
        letter-spacing: 0px;
      }

      .top {
        position: fixed; /* Set position to fixed */
        top: 0; /* Position at the bottom of the page */
        left: 0;
        width: 100%; /* Set width to full */
        color: white;
        background-color: #000; /* Set background color */
        border-top: 1px solid #333;
        font-family: verdana;
        letter-spacing: 2px;
      }

    </style>
  </head>

<div class="top">
  <table width='100%'>
  <tr>
    <td width='10%'>
        &nbsp; <a href="exthothem1.0.1.zip"><img src='icons/download.png' alt='Sourcecode'></a>

    </td>
    <td align='right' width='90%'>
      <a href="upload.php"><img src='icons/netvibes.png' alt='Upload a file (select)'></>    
      <a href="upload_drop.php"><img src='icons/package_add.png' alt='Upload a file (drop)'></a>
      <a href="fields.php"><img src='icons/document_copies.png' alt='Paste contents (multiple fields)'></a>
      <a href="paste.php"><img src='icons/document_empty.png' alt='Paste contents (one field)'></a>
      <a href="write_get.php"><img src='icons/attach.png' alt='Send text via GET contents'></a>  
      <a href="folders.php"><img src='icons/document_green.png' alt='Folders'></a>  
      <a href="files_full.php"><img src='icons/understanding.png' alt='Full search'></a>
      <a href="files.php"><img src='icons/folder_explorer.png' alt='Category search'></a>
      <a href="fields_search.php"><img src='icons/application_form_magnify.png' alt='Paste search'></a>
      <a href="chat.php"><img src='icons/comment.png' alt='Chat'></a>
      <a href="servers.php"><img src='icons/globe_australia.png' alt='Check servers'></a>        
      <a href="all_files_simple.php"><img src='icons/list.png' alt='Show all files (simple)'></a>
      <a href="all_files.php"><img src='icons/list_box.png' alt='Show all files'></a>      
      <a href="menu.html"><img src='icons/controlbar.png' alt='Menu'></a>
      <a href="README.txt"><img src='icons/information.png' alt='README'></a>     
      <a href='about.html'><img src='icons/help.png' alt='Options'></a>
    </tr>
  </table>
</div>

  <body>
    <br><br>
    <br><br><br>
    <br><br><br>
    <div class='panel'>      
      <form method="POST" action="files.php">        
        <input type="text" name="search" style="width: 392px;" placeholder="Insert a link, URL or category">
          <div class="button-container">        
            <input type="submit" name="submit" value="Send" class='search-button'>
          </div>        
        </form>
        </br>
    </div>  
    <br><br>
    <div class='presents'>Exthothem is a NoSQL project<br>
                          for share and backup files easily.<br>
    <br><br> <br> <br> <br> <br> <br> <br> <br>

    <iframe src='https://filevenda.netlify.app/categories/ads.html' width='100%' style='border: 0px;'></iframe>
    <br>
    <div align='center'>
        <a href='#'>exthothem - 2023</a>   
    </div>
  </body>
</html>

<?php

  // Create the project folders
  include ("dir_create.php");

?>