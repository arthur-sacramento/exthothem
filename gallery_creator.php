<a href='index.php'>back</a>
<form action='gallery_creator.php' method='POST'>
  <input type='text' name='folder'><input type='submit'>
</form>


<?php

/*/

  This script generates HTML pages for the images inside a folder. 

/*/

$x = 1;
$i = 1;

$category = $_POST['folder'];

if (!$category){$category = "test";}

$file_count = 1;

$gallery_html_folder = $category .  '_gallery';

mkdir("categories/$gallery_html_folder", 0755, true);

// Avoid rename files that aren't .jpg
foreach (glob("categories/$category/*") as $file){


  $pathInfo = pathinfo($file);
  $fileExtension = $pathInfo['extension'];
  $fileExtension_l = strtolower($fileExtension);

  if ($fileExtension_l != 'jpg'){echo "error: There are no .jpg files in the folder.";
  die;
} 

}

for($b = 1; $b < 1000; $b++){

  // Run only if the pictures isn't in order
  if(!file_exists("categories/$category/1.jpg")){

    foreach (glob("categories/$category/*") as $file){

      rename("$file", "categories/$category/$file_count.jpg");  
      $file_count++;
    }

  echo 'Images renamed. '; 
  }

  // Exit html creation when there aren't files
  if(!file_exists("categories/$category/$i.jpg")){

    echo 'Gallery pages create. '; 
    break;
    die;
  }

  $page = "";
  $limit = $b * 8;
  $start = ($b * 8) - 8;
  if ($b == 1){$start = 0;}
  $n = 1;

  for($i = $start + 1; $i <= $limit; $i++){

    if ($n == 1){
      $page = $page . "<table width='100%'><tr>";
    }

    if(file_exists("categories/$category/$i.jpg")){
      $page = $page . "<td valign='top' width='25%'><a href='../$category/$i.jpg' target='_blank'><img src='../$category/$i.jpg' width='100%'></a></td>";
      $to_next = 1;
    }else{
      $to_next = 0;
    }

    $p = $i;
    $p++;

    if(!file_exists("categories/$category/$p.jpg")){
      $to_next = 0;
    }

    if ($n == 4){
      $page = $page . "</tr><tr>";
    }

    if ($n == 8){
      $page = $page . "</tr></table>";
    }

    $n++;
  }

  $current_page = $x;
  $x++;
  $next_page = $x;

  if ($to_next == 1){
    $elem_next = "<a href='$next_page.html'>Next</a>";
  }else{
    $elem_next = "";
  }

  $page_bottom = "<table width='100%'>
  <tr>
    <td align='left'>
      <a href='../../index.html'>Home</a>
     </td>
   <td align='right'>
     $elem_next
   </td>
  </tr>
</table>";


  $file_new = fopen("categories/$gallery_html_folder/$current_page.html", "w");
  fwrite($file_new, "$page $page_bottom");
  fclose($file_new);

}

echo "done!<br>";
echo "View <a href='categories/$gallery_html_folder/1.html' target='_blank'>categories/$gallery_html_folder/1.html</a>";
?>