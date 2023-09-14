<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $linkData = [];

    // Get the links from the textarea
    $linksTextarea = $_POST['links'];

    // Split the textarea content into individual lines
    $linkLines = explode("\n", $linksTextarea);

    // Process each line as a link
    foreach ($linkLines as $line) {
        // Split each line by a comma (assuming CSV-like format)
        $linkInfo = explode(',', $line);

        // Extract 'Name', 'Link', 'Date', 'Description', and 'User' values
        $name = isset($linkInfo[0]) ? trim($linkInfo[0]) : '';
        $link = isset($linkInfo[1]) ? trim($linkInfo[1]) : '';

        // Date: Current date and time
        $date = date('Y-m-d H:i:s');

        // Description and User: Blank
        $description = '';
        $user = '';

        // Add the link data to the array
        $linkData[] = [
            'Name' => $name,
            'Link' => $link,
            'Date' => $date,
            'Description' => $description,
            'User' => $user,
        ];
    }

    // Get the table name from the form
    $tableName = isset($_POST['table_name']) ? $_POST['table_name'] : 'default_table';

    // Define the file path
    $filePath = 'categories/contents/' . $tableName . '.html';

    // Generate an HTML table
    if(!file_exists("$filePath")){

    $html = "<link rel='stylesheet' type='text/css' href='../../tables.css'><table class='main_table'><tr class='table_fields'><td>Name</td><td>Link</td><td>Date</td><td>Description</td><td>User</td></tr>";

 } else {$html = "";}


    foreach ($linkData as $row) {
        $html .= '<tr>';
        $html .= '<td>' . htmlspecialchars($row['Name']) . '</td>';
        $html .= '<td><a href="' . htmlspecialchars($row['Name']) . '">' . htmlspecialchars($row['Name']) . '</a></td>';
        $html .= '<td>' . htmlspecialchars($row['Date']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['Description']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['User']) . '</td>';
        $html .= '</tr>';
    }

    // Open the file for writing
    $file = fopen($filePath, 'a');

    if ($file) {
        // Write the HTML content to the file
        fwrite($file, $html);
        fclose($file);

        echo 'HTML table has been generated and saved as ' . "<a href='$filePath' target='_blank'>$filePath</a>";
    } else {
        echo 'Error: Unable to open file for writing.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Link Submission</title>
<style>
    body {
        font-family: Arial, sans-serif;
    }

    h1 {
        text-align: center;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #f5f5f5;
    }

    a {
        color: #007bff;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }

    textarea {
        width: 100%;
        height: 150px;
    }

    button[type="submit"] {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
    }

    button[type="submit"]:hover {
        background-color: #0056b3;
    }
</style>

</head>
<body>
    <h1>Submit Links</h1>
    <form method="post">
        <label for="links">Enter Links:</label>
        <textarea name="links" rows="5" cols="40" required></textarea>
        <br>
        <label for="table_name">Table Name:</label>
        <input type="text" name="table_name" placeholder="Table Name" required>
        <br>
        <button type="submit">Generate HTML Table</button>
    </form>
</body>
</html>
