<?php
$allow = 0;

// Function to remove matching <tr> elements
function removeMatchingRows($doc, $userInput)
{
    $xpath = new DOMXPath($doc);
    $tdElements = $xpath->query("//table//tr[td[1][contains(text(), '$userInput')]]");

    foreach ($tdElements as $element) {
        $element->parentNode->removeChild($element);
    }
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST" && $allow == 1) {
    // Get user input
    $userInput = $_POST["userInput"];
    
    // Load the HTML file
    $htmlFile = 'categories/contents/123.html'; // Change this to your input HTML file path
    $htmlContent = file_get_contents($htmlFile);

    // Create a new DOMDocument and load the HTML content
    $doc = new DOMDocument();
    $doc->loadHTML($htmlContent);

    // Remove matching <tr> elements
    removeMatchingRows($doc, $userInput);

    // Get the content within the <body> tag
    $bodyContent = '';
    $bodyElements = $doc->getElementsByTagName('body')->item(0)->childNodes;
    foreach ($bodyElements as $element) {
        $bodyContent .= $doc->saveHTML($element);
    }

    // Remove the "</table>" from the beginning of the content
    $bodyContent = str_replace('</table>', '', $bodyContent);

    // Save the modified HTML to a directory
    $outputDirectory = 'categories/contents'; // Change this to your desired directory
    if (!file_exists($outputDirectory)) {
        mkdir($outputDirectory, 0777, true); // Create the directory if it doesn't exist
    }
    
    $modifiedHtmlFile = $outputDirectory . '/123.html';
    file_put_contents($modifiedHtmlFile, $bodyContent);

    echo "Modified HTML file saved as '$modifiedHtmlFile'\n";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Remove Table Rows</title>
</head>
<body>
    <h1>Remove Table Rows</h1>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="userInput">Enter Text to Match:</label>
        <input type="text" id="userInput" name="userInput" required>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
