<?php

$urls = [
    'http://exthothem.free.nf', 
    'http://exthothem.unaux.com
',
    'http://ext.yzz.me',
    'http://ext.ultihost.net',
    'http://exthothem.byethost3.com
',
    'http://exthothem.vastserve.com

',
    'http://exthothem.atwebpages.com/',
    'http://exthothem.000webhostapp.com/'
];

function isUrlReachableUsingFileGetContents($url)
{
    $contents = @file_get_contents($url);
    return ($contents !== false);
}

// Function to check if a URL is reachable using cURL
function isUrlReachableUsingCurl($url)
{
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_exec($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    return ($httpCode >= 200 && $httpCode < 400);
}

// Iterate through the URLs and check if they are reachable
foreach ($urls as $url) {
    //echo "Checking URL: $url\n";
    
    // Using file_get_contents
    if (isUrlReachableUsingFileGetContents($url)) {
        //echo "$url available. File_get_contents: URL is reachable.<br>";
    } else {
        //echo "File_get_contents: URL is not reachable.\n";
    }

    // Using cURL
    if (isUrlReachableUsingCurl($url)) {
        //echo "cURL: URL is reachable.<br>";
    } else {
        //echo "cURL: URL is not reachable.\n";
    }

}

?>