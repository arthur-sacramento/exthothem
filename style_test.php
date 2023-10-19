<!DOCTYPE html>
<html>
<head>
    <title>Div Color, Size, and Position Changer</title>
    <style>
        .draggable {
            width: 100px;
            height: 100px;
            background-color: #3498db;
            position: absolute;
        }
    </style>
</head>
<body>
    <h1>Div Color, Size, and Position Changer</h1>
    
    <label for="colorPicker">Choose a color:</label>
    <input type="color" id="colorPicker">
    
    <label for="widthInput">Width:</label>
    <input type="number" id="widthInput" value="100">
    
    <label for="heightInput">Height:</label>
    <input type="number" id="heightInput" value="100">
    
    <button id="createDiv">Create Div</button>
    
    <div id="container" style="position: relative; width: 500px; height: 500px; border: 1px solid #000;"></div>
    
    <script>
        // Create a counter to give each div a unique ID
        let divCount = 1;
        
        document.getElementById("createDiv").addEventListener("click", function() {
            const colorPicker = document.getElementById("colorPicker");
            const widthInput = document.getElementById("widthInput");
            const heightInput = document.getElementById("heightInput");
            const container = document.getElementById("container");
            
            // Create a new div element
            const div = document.createElement("div");
            div.className = "draggable";
            div.id = "div" + divCount;
            
            // Set the initial background color, width, and height
            div.style.backgroundColor = colorPicker.value;
            div.style.width = widthInput.value + "px";
            div.style.height = heightInput.value + "px";
            
            // Add the new div to the container
            container.appendChild(div);
            
            // Make the div draggable and resizable
            makeDraggable(div);
            makeResizable(div);
            
            // Increment the div counter
            divCount++;
        });
        
        // Function to make a div element draggable
        function makeDraggable(element) {
            let isDragging = false;
            let offsetX, offsetY;
            
            element.addEventListener("mousedown", function(e) {
                isDragging = true;
                offsetX = e.clientX - element.getBoundingClientRect().left;
                offsetY = e.clientY - element.getBoundingClientRect().top;
            });
            
            document.addEventListener("mousemove", function(e) {
                if (isDragging) {
                    const x = e.clientX - offsetX;
                    const y = e.clientY - offsetY;
                    
                    element.style.left = x + "px";
                    element.style.top = y + "px";
                }
            });
            
            document.addEventListener("mouseup", function() {
                isDragging = false;
            });
        }
        
        // Function to make a div element resizable
        function makeResizable(element) {
            let isResizing = false;
            let originalWidth, originalHeight;
            
            element.addEventListener("mousedown", function(e) {
                isResizing = true;
                originalWidth = element.offsetWidth;
                originalHeight = element.offsetHeight;
            });
            
            document.addEventListener("mousemove", function(e) {
                if (isResizing) {
                    const newWidth = originalWidth + (e.clientX - element.getBoundingClientRect().left);
                    const newHeight = originalHeight + (e.clientY - element.getBoundingClientRect().top);
                    
                    element.style.width = newWidth + "px";
                    element.style.height = newHeight + "px";
                }
            });
            
            document.addEventListener("mouseup", function() {
                isResizing = false;
            });
        }
        
        // Event listener for changing the color of a div
        document.getElementById("colorPicker").addEventListener("input", function() {
            const selectedDiv = document.querySelector(".draggable");
            
            if (selectedDiv) {
                selectedDiv.style.backgroundColor = this.value;
            }
        });
    </script>
</body>
</html>
