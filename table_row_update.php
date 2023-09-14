﻿<?php
$allow = 1;

// Function to replace matching <td> elements
function replaceMatchingCells($doc, $selector, $replacementText)
{
    $xpath = new DOMXPath($doc);
    $tdElements = $xpath->query("//table//tr[td[1][contains(text(), '$selector')]]/td[1]");

    foreach ($tdElements as $element) {
        $element->textContent = $replacementText;
    }
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST" && $allow == 1) {
    // Get user input
    $selector = $_POST["selector"];
    $replacementText = $_POST["replacementText"];
    
    // Load the HTML file
    $htmlFile = 'categories/contents/123.html'; // Change this to your input HTML file path
    $htmlContent = file_get_contents($htmlFile);

    // Create a new DOMDocument and load the HTML content
    $doc = new DOMDocument();
    $doc->loadHTML($htmlContent);

    // Replace matching <td> elements
    replaceMatchingCells($doc, $selector, $replacementText);

    // Get the content within the <body> tag
    $bodyContent = '';
    $bodyElements = $doc->getElementsByTagName('body')->item(0)->childNodes;
    foreach ($bodyElements as $element) {
        $bodyContent .= $doc->saveHTML($element);
    }

    // Save the modified HTML to a directory
    $outputDirectory = 'categories/contents'; // Change this to your desired directory
    if (!file_exists($outputDirectory)) {
        mkdir($outputDirectory, 0777, true); // Create the directory if it doesn't exist
    }

    $bodyContent = str_replace('</table>', '', $bodyContent);
    
    $modifiedHtmlFile = $outputDirectory . '/123.html';
    file_put_contents($modifiedHtmlFile, $bodyContent);

    echo "Modified HTML file saved as '$modifiedHtmlFile'\n";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Replace Table Cells</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        h1 {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form {
            text-align: center;
        }

        label {
            font-weight: bold;
        }

        input[type="text"] {
            padding: 8px;
            width: 100%;
            margin: 10px 0;
        }

        button[type="submit"] {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #555;
        }

    </style>
</head>
<body>
    <h1>Replace Table Cells</h1>
    <div class="container">
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="selector">Enter Text to Match (in the first td):</label>
            <input type="text" id="selector" name="selector" required>
            <br>
            <label for="replacementText">Enter Replacement Text:</label>
            <input type="text" id="replacementText" name="replacementText" required>
            <br>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
