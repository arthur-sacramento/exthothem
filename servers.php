<!DOCTYPE html>
<html>
<head>
    <title>Check Server Status</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
        }

        form {
            margin-bottom: 20px;
        }

        input[type="text"] {
            padding: 5px;
            width: 300px;
        }

        button {
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
<head>
    <title>Check Server Status</title>
</head>
<body>

<?php
// Function to check if a URL is online
function isUrlOnline($url) {
    $headers = @get_headers($url);
    return $headers && strpos($headers[0], '200') !== false;
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $url = $_POST['url'];

    $specialCharacters = array ('<','>');        

    $url = str_replace($specialCharacters, "", $url); 

    // Add the URL to 'servers.txt'
    file_put_contents('servers.txt', $url . PHP_EOL, FILE_APPEND);
}

// Read the 'servers.txt' file
$servers = file('servers.txt', FILE_IGNORE_NEW_LINES);

// Check if each URL is online
$results = array();
foreach ($servers as $url) {
    $status = isUrlOnline($url);
    $results[$url] = $status ? 'Online' : 'Offline';
}
?>

    <h1>Check Server Status</h1>
    
    <h2>Add a URL</h2>
    <form method="POST">
        <input type="text" name="url" placeholder="Enter URL" required>
        <button type="submit">Add URL</button>
    </form>
    
    <h2>Server Status</h2>
    <table>
        <tr>
            <th>URL</th>
            <th>Status</th>
        </tr>
        <?php foreach ($results as $url => $status): ?>
            <tr>
                <td><?php echo "<a href='$url' target='_blank'>$url</a>"; ?></td>
                <td><?php echo $status; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>