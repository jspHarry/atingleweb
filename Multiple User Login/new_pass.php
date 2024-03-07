<?php 

$token = $_GET['token'];
if(empty($token)){
    header("Location: forgot.php");
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="form">
        
        <h2>Change Password</h2>

        <form action="" autocomplete="off">
            <div class="error-text"></div>
            <div class="success-text"></div>
            <div class="input">
                <input type="hidden" name="token" value="<?php echo $token ?>">
                <input type="password" name="new_pass" placeholder="New Password" required>
                <label for="">New Password</label>
                <span></span>
            </div>
            <div class="input">
                <input type="password" name="c_pass" placeholder="Confirm Password" required>
                <label for="">Confirm Password</label>
                <span></span>
            </div>
            <div class="submit">
                <input type="submit" value="Change Password" class="button">
            </div>
        </form>
    </div>
    <script src="js/reset.js"></script>
</body>
</html>