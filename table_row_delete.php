<!DOCTYPE html>
<html>
<head>
    <title>Remove Table Rows</title>
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

<body>
    <h1>Remove Table Rows</h1>
    <div class="container">
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="userInput">Enter Text to Match:</label>
            <input type="text" id="userInput" name="userInput" required>
            <br>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
