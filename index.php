<?php error_reporting(0); ?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="icon" href="icons/folder.png">
    <title>file backup and sharing</title>
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
        background-image: url("background/1.jpg");
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

      .top-right {
        position: fixed !important;
        top: 0 !important;
        right: 0 !important;
      }

      .top-right:hover  {
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

    </style>
  </head>
  <body>
    <a href='menu.html' class='top-right'><u>menu</u></a>
    <div align='center'>
      <a href='#'>PHP freelance</a><br>
      <a href='https://www.linkedin.com/in/arthur-sacramento-a55003230/' target=_'blank'>linkedin</a> | &nbsp;
      <a href='http://wa.me/5591983608861' target=_'blank'>wa.me</a> | &nbsp; 
      <a href='https://chat.whatsapp.com/LvWpR495NDZ2wLvjs6KqyO' target=_'blank'>whatsapp</a> | &nbsp;
      <a href='#' onclick="alert('exthothem@gmail.com');" target=_'blank'>e-mail</a>
    </div>

    <br>
    <br><br>
    <div class='panel'>
      <a href='fields.php' class='small-font'>insert</a> |
      <a href='paste.php' class='small-font'>paste</a> |
      <a href='files_full.php' class='small-font'>full search</a> |
      <a href='categories_list.php' class='small-font'>categories</a> |
      <a href='https://mega.nz/file/tpwRRRzL#bKjL6wl6AvDdVvIdun2X3IqKLm2FH4N3tPNpIcyfeDE' target='_blank' class='small-font'>sourcecode</a>
      <form method="POST" action="files_simple.php">        
        <input type="text" name="search" style="width: 392px;" placeholder="Insert a link or URL">
          <div class="button-container">        
            <input type="submit" name="submit" value="Send" class='search-button'>
          </div>        
        </form>
        </br>
    </div>  
    </br>
    <div class='presents'>it's easy share and backup with Exthothem</div>
    <br><br> <br> <br> <br> <br> <br> <br> <br> <br> <br> 

    <iframe src='https://filevenda.netlify.app/categories/ads.html' width='100%' style='border: 0px;'></iframe>
   
    <hr>
    <div align='center' style='position:absolute; bottom: 15px'>
      <a href='#'>Donate</a> :  &nbsp;
      <a href='#' onclick="alert('exthothem@gmail.com');">Pix</a> | &nbsp;
      <a href='https://www.paypal.com/donate/?hosted_button_id=MA7KAL6PP4Y7Q' target=_'blank'>PayPal</a> | &nbsp; 
      <a href='#' onclick="alert('1CX6rNZnBexgTW8HW8VRhBoKAG3TsNc9Em');" target=_'blank'>Bitcoin</a>

      &nbsp;&nbsp; <a href='#'>Website</a> :  &nbsp;   
      <a href='https://exthothem.000webhostapp.com/' target='_blank'>1</a> | &nbsp;
      <a href='http://exthothem.atwebpages.com/' target='_blank'>2</a> | &nbsp;
      <a href='http://exthothem.free.nf' target='_blank'>3</a> | &nbsp;

      <a href='http://twitter.com/exthothem' target='_blank'>@exthothem</a>
    
    </div>
  </body>
</html>

<?php

  // Create the project folders
  include ("dir_create.php");

?>