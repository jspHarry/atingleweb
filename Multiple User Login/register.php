<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="form">
        
        <h2>Signup</h2>

        <form action="" autocomplete="off">
            <div class="error-text"></div>
            <div class="success-text">green</div>
            <div class="input">
                <input type="text" name="fullname" placeholder="Full Name" required>
                <label for="">Full Name</label>
                <span></span>
            </div>
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
            <div class="submit">
                <input type="submit" value="Signup Now" class="button">
            </div>
        </form>
        <div class="link">Already signed up? <a href="login.php">Login</a></div>
    </div>

    <script src="js/register.js"></script>
</body>
</html>