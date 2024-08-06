<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page 202200216 Harshvir singh</title>
    <link rel="stylesheet" href="css.css">
    <script>
        function redirectToHomepage(event) {
            event.preventDefault();
            window.location.href = 'main page.php';
        }
    </script>
</head>
<body>
    <div class="video-background">
        <video autoplay muted loop id="bg-video">
            <source src="images/video.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>
    <div class="login-container">
        <form class="login-form" onsubmit="redirectToHomepage(event)">
            <h2>Login</h2>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
           
            <div class="input-group">
                <a href="#" class="forgot-password">Forgot Password?</a>
            </div>
           
            <button type="submit" class="btn">Login</button>
        </form>
    </div>
</body>
</html>
