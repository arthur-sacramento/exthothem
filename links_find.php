<?php
// Load the HTML file into a DOMDocument
$html = file_get_contents('links.txt'); // Replace 'your_html_file.html' with your file path

$dom = new DOMDocument();
@$dom->loadHTML($html); // Use @ to suppress warnings if any

// Find all 'a' elements
$links = $dom->getElementsByTagName('a');

// Loop through the 'a' elements and print their 'href' attributes
foreach ($links as $link) {
    $href = $link->getAttribute('href');
    echo "$href<br>";
}
?>
