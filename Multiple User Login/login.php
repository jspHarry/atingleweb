<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="form">
        
        <h2>Login</h2>

        <form action="" autocomplete="off">
            <div class="error-text"></div>
            <div class="success-text"></div>
            <div class="input">
                <input type="email" name="email" placeholder="Email" required>
                <label for="">Email</label>
                <span></span>
            </div>
            <div class="input">
                <input type="password" name="password" placeholder="Password" required>
                <label for="">Password</label>
                <span></span>
            </div>
            <a href="forgot.php" style="float: right;color: var(--secondary-color);">Forgot Password</a>
            <div class="remember">
                <input type="checkbox" name="remember" id="login_info">
                <label for="login_info">Remember me</label>
            </div>
            <div class="submit">
                <input type="submit" value="Login" class="button">
            </div>
        </form>
        <div class="link">Don't have an Account <a href="register.php">Signed up</a></div>
    </div>
    <script src="js/login.js"></script>
</body>
</html>