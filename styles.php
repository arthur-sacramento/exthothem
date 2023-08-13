<!DOCTYPE html>
<html>
<head>
    <title>Color Palette</title>
    <style>
        .color-box {
            width: 50px;
            height: 50px;
            display: inline-block;
            margin: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <?php
    // Define an array of colors
    $colors = array("#FF5733", "#FFC300", "#36D7B7", "#3498DB", "#9B59B6");
    
    // Generate color boxes
    foreach ($colors as $color) {
        echo "<div class='color-box' style='background-color: $color' onclick='changeColor(\"$color\")'></div>";
    }
    ?>

    <script>
        function changeColor(color) {
            document.body.style.backgroundColor = color;
        }
    </script>
</body>
</html>