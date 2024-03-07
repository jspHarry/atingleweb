<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="form">
        
        <h2>Forgot Password</h2>

        <form action="" autocomplete="off">
            <div class="error-text"></div>
            <div class="success-text"></div>
            <div class="input">
                <input type="email" name="email" placeholder="Email" required>
                <label for="">Email</label>
                <span></span>
            </div>
            <div class="link" style="float: right;">Back to <a href="login.php">Login</a></div>
            <div class="submit">
                <input type="submit" value="Login" class="button">
            </div>
        </form>
    </div>
    <script src="js/forgot.js"></script>
</body>
</html>