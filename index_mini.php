<!DOCTYPE html>
<html>
<head>
    <title>Hello</title>
    <style>

        body {
            font-family: verdana;
            color: #333;
        }

        p {
           padding-left: 25px;
        
        }

        .color-box {
            width: 50px;
            height: 50px;
            display: inline-block;
            margin: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>

    </div>
    <?php
    // Define an array of colors
    $colors = array("#FF5733", "#FFC300", "#36D7B7", "#3498DB", "#9B59B6");
    
    // Generate color boxes
    foreach ($colors as $color) {
        echo "<div class='color-box' style='background-color: $color' onclick='changeColor(\"$color\")'></div>";
    }

    ?>

    <script>
        function changeColor(color) {
            document.body.style.backgroundColor = color;
        }
    </script>
    <br><br><br><br>
    
    <div align='center'>Exthothem offers search and insertion without using MySQL or any database. And more.</div>

    <br><br><hr>

    &nbsp; It's a simple system that uses folders to categorize and "search" files. Useful for database slowdown or unavailability.

    <br><br><hr>

    &nbsp; The script automatically creates the categories based in the words presents in a link, URL or manually entered by the user.

    You can search by the file name, content or category (folder).

    <br><br><hr>
 
    Others products and services
    <br><br>
    <table width='100%'>
      <tr>
        <td width='33%'>
        Contents generation using Chat-GPT
        <ul>
        <li> Text creation</li>
        <li> Translations</li>
        <li> Preparation of books or courses</li>
        <li> Content moderation</li>
        <li> Any task for text creation</li>
        </ul>
        </td>
        </td>
        <td width='33%'>
        PHP remote Freelance
        <ul>
        <li> 1 USD$ per day</li>
        <li> PHP, HTML, CSS, MySQL and JS</li>
        <li> or basic of Java</li>
        <li> Payment via PayPal, Bitcoin or Pix</li>
        </ul>
        </td>
        <td width='33%' valign='top'>
        A.I. hot pictures
        <br><br>
        Get a constantly updated and exclusive adult image pack for just one dollar a year.
        </td>
      </tr>
    </table>
 
    <br>

<div align='left'>
Contact: &nbsp;  
      <a href='https://www.linkedin.com/in/arthur-sacramento-a55003230/' target=_'blank'>linkedin</a> | &nbsp;
      <a href='http://wa.me/5591983608861' target=_'blank'>wa.me</a> | &nbsp; 
      <a href='https://chat.whatsapp.com/LvWpR495NDZ2wLvjs6KqyO' target=_'blank'>whatsapp</a> | &nbsp;
      <a href='#' onclick="alert('exthothem@gmail.com');" target=_'blank'>e-mail</a>

</div>
    <div align='right'><a href='index.php'>Enter the site</a></a> &nbsp;

</body>
</html>