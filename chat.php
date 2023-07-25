<!DOCTYPE html>
<html>
<head>
    <title>Chat Room</title>
    <style>
        #chat-container {
            width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
            border: 1px solid #ccc;
        }

        #message-container {
            height: 300px;
            overflow-y: scroll;
            margin-bottom: 10px;
            padding: 10px;
            background-color: #fff;
            border: 1px solid #ccc;
        }

        #chat-form input[type="text"] {
            width: 80%;
            padding: 5px;
            margin-bottom: 10px;
        }

        #chat-form button {
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        #chat-form button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div id="chat-container">
        <div id="message-container">
            <?php
            // Read and display chat messages from 'chat.txt'
            $file = 'chat.txt';
            if (file_exists($file)) {
                $messages = file_get_contents($file);
                echo $messages;
            }
            ?>
        </div>
        <form id="chat-form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="text" name="username" placeholder="Username" required>
            <input type="text" name="message" placeholder="Message" required>
            <button type="submit">Send</button>
        </form>
    </div>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $specialCharacters = array ('<','>');        

        $username = $_POST['username'];
        $message = $_POST['message'];

        $username = str_replace($specialCharacters, "", $username); 
        $message = str_replace($specialCharacters, "", $message); 

        // Save the message to a file (or database)
        $fp = fopen($file, 'a');
        fwrite($fp, "<p><strong>$username:</strong> $message</p>");
        fclose($fp);

        // Redirect to the current page to display the updated chat messages
        header("Location: "."chat.php");
        exit();
    }
    ?>
</body>
</html>