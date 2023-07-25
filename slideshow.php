<!DOCTYPE html>
<html>
<head>
    <title>Image Slideshow</title>
    <style>
        #imageContainer {
            display: none;
        }
        img {
            max-width: 800px;
            max-height: 800px;
        }
    </style>
</head>
<body>
    <div id="imageContainer">
        <img id="image" src="" alt="Slideshow Image">
    </div>

    <script>
        function loadImages() {
            var imageContainer = document.getElementById('imageContainer');
            var image = document.getElementById('image');
            var images = <?php echo json_encode(glob('categories/pictures_files/*')); ?>;
            var currentIndex = 0;

            function changeImage() {
                var randomIndex = Math.floor(Math.random() * images.length);
                image.src = images[randomIndex];
                currentIndex = randomIndex;
            }

            function nextImage() {
                currentIndex = (currentIndex + 1) % images.length;
                image.src = images[currentIndex];
            }

            setInterval(function() {
                fadeOut(imageContainer, 1000, function() {
                    nextImage();
                    fadeIn(imageContainer, 1000);
                });
            }, 5000);

            function fadeOut(element, duration, callback) {
                var fadeEffect = setInterval(function() {
                    if (!element.style.opacity) {
                        element.style.opacity = 1;
                    }
                    if (element.style.opacity > 0) {
                        element.style.opacity -= 0.1;
                    } else {
                        clearInterval(fadeEffect);
                        if (callback) {
                            callback();
                        }
                    }
                }, duration / 10);
            }

            function fadeIn(element, duration, callback) {
                var fadeEffect = setInterval(function() {
                    if (!element.style.opacity) {
                        element.style.opacity = 0;
                    }
                    if (element.style.opacity < 1) {
                        element.style.opacity = parseFloat(element.style.opacity) + 0.1;
                    } else {
                        clearInterval(fadeEffect);
                        if (callback) {
                            callback();
                        }
                    }
                }, duration / 10);
            }

            if (images.length > 0) {
                image.src = images[currentIndex];
                imageContainer.style.display = 'block';
            }
        }

        window.addEventListener('DOMContentLoaded', loadImages);
    </script>
</body>
</html>
