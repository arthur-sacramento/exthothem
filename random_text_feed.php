<!DOCTYPE html>
<html>
<head>
    <title>Word Follower</title>
</head>
<body>
    <h1>Word Follower</h1>

    <form method="post">
        <textarea name="input_text" rows="5" cols="50"></textarea>
        <br>
        <input type="submit" name="submit" value="Save and Generate">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $inputText = $_POST['input_text'];
        $words = explode(' ', $inputText);

        if (!is_dir('words')) {
            mkdir('words');
        }

        for ($i = 0; $i < count($words) - 1; $i++) {
            $currentWord = strtolower($words[$i]);
            $nextWord = strtolower($words[$i + 1]);

            $filename = 'words/' . $currentWord . '.txt';
            $fileContent = $nextWord;

            mkdir("words/$currentWord", 0755, true); 
            file_put_contents("words/$currentWord/$fileContent", "");
        }

        echo '<p>Text saved and word followers generated.</p>';
    }
    ?>
</body>
</html>
