<?php 

session_start();
include 'php/db.php';

$unique_id = $_SESSION['u_id'];
if(empty($unique_id)){
    header("Location: login.php");
}
$qry = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = '{$unique_id}'");
if(mysqli_num_rows($qry) > 0){
    $row = mysqli_fetch_assoc($qry);
    if($row){
        $_SESSION['verification_status'] = $row['verification_status'];
        if($row['verification_status'] == 'Verified'){
            header("Location: index.php");
        }
    }
}




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
    </style>
</head>
<body>
    <div class="form">
        <h2>OTP VERIFICATION</h2>
        <form action="" autocomplete="off">
            <div class="error-text"></div>
            <div class="success-text"></div>
            <div class="fields_input">
                <input type="number" name="otp1" class="otp_field" placeholder="0" min="0" max="9" maxlength="1" required onpaste="return false">
                <input type="number" name="otp2" class="otp_field" placeholder="0" min="0" max="9" maxlength="1" required onpaste="return false">
                <input type="number" name="otp3" class="otp_field" placeholder="0" min="0" max="9" maxlength="1" required onpaste="return false">
                <input type="number" name="otp4" class="otp_field" placeholder="0" min="0" max="9" maxlength="1" required onpaste="return false">
            </div>
            <div class="resend">
                <span id="timer">01:00</span>
                <div id="resend_btn" onclick="resendTimer()">Resend OTP</div>
            </div>
            <div class="submit">
                <input type="submit" value="Verify" class="button">
            </div>
        </form>
    </div>
    <script>
        const otp = document.querySelectorAll('.otp_field');
        otp[0].focus();
        otp.forEach((field, index) =>{
            field.addEventListener('keydown', (e) =>{
                if (e.key >= 0 && e.key <= 9){
                    otp[index].value = '';
                    setTimeout(() => {
                        otp[index + 1].focus();
                    }, 4);
                }
                else if(e.key === 'Backspace'){
                    setTimeout(() => {
                        otp[index - 1].focus();
                    }, 4);
                }
            });
        });

        var resend = document.querySelector('#resend_btn');
        var display = document.querySelector('#timer');

        function startTimer(duration, display){
            var timer = duration, minute, seconds;
            var intervalid = setInterval(function () {

                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? '0' + minutes : minutes;
                seconds = seconds < 10 ? '0' + seconds : seconds;

                display.textContent = minutes + ':' + seconds;

                if(--timer < 0){
                    clearInterval(intervalid);
                    resend.style.display = 'block';
                    display.style.display = 'none';

                }
            }, 1000)
        }
        window.onload = function () {
            var oneMinute = 60;
            startTimer(oneMinute, display);
        }

        function resendTimer(){
            display.style.display = 'block';
            resend.style.display = 'none';

            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'php/otps.php', true);
            xhr.onreadystatechange = function (){
                if(xhr.readyState === XMLHttpRequest.DONE){
                    if(xhr.status === 2000){
                        var oneMinute = 60;
                        startTimer(oneMinute, display);
                    }
                    else {
                        console.error('Error: ' + xhr.status);
                    }
                }
            };
            xhr.send();

            
        }

    </script>
    <script src="js/verify.js"></script>
</body>
</html>