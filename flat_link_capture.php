<html>
  <body> 
   <form action='flat_link_capture.php' method='POST'>
     URL<br>
     <input type='text' name='url'></br>
     Table name<br>
     <input type='text' name='name'></br>
     <input type='submit' name='submit'>
   </form>

<?php

if (isset($_POST['submit'])) {

echo $pageUrl = $_POST['url'];

function getAllUrls($url) {
    $html = file_get_contents($url);

    $pattern = '/<a\s+(?:[^>]*?\s+)?href=(["\'])(.*?)\1/';
    preg_match_all($pattern, $html, $matches);

    $urls = $matches[2];

    $filteredUrls = array_filter($urls, function ($url) {
        return strpos($url, 'http') === 0;
    });

    return $filteredUrls;
}

$urls = getAllUrls($pageUrl);

foreach ($urls as $url) {

    echo $url . "<br><br>";

}

}
?>

