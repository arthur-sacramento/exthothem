<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["fileName"])) {
    $fileName = $_POST["fileName"];

    // Load the HTML content of the file
    $html = file_get_contents($fileName);

    // Create a DOMDocument for parsing
    @$dom = new DOMDocument();
    @$dom->loadHTML($html); // Suppress warnings, as HTML may not be perfect

    // Create a DOMXPath object to query the DOM
    $xpath = new DOMXPath($dom);

    // Query the row to replace
    $query = "//tr"; // Adjust this query as needed to target the specific <tr> element

    $row = $xpath->query($query)->item(0); // Assuming you want to replace the first matching row

    if ($row) {
        // Iterate through the child elements of the row and set their innerHTML to ''
        foreach ($row->childNodes as $childNode) {
            if ($childNode->nodeType === XML_ELEMENT_NODE) {
                // Set the innerHTML of the child element to ''
                $childNode->nodeValue = '';
            }
        }

        // Save the updated HTML content back to the file
        $updatedHtml = $dom->saveHTML();
        file_put_contents($fileName, $updatedHtml);

        echo "success"; // Return success if the elements inside the row were replaced
    } else {
        echo "error"; // Return an error if the row was not found
    }
} else {
    echo "Invalid request.";
}
?>
