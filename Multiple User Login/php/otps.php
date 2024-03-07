<?php 

session_start();
include 'db.php';

$unique_id = $_SESSION['u_id'];
$otp = mt_rand(1111,9999);
$_SESSION['otp'] = $otp;
$qry = mysqli_query($conn, "UPDATE users SET `otp` = {$otp} WHERE unique_id = '{$unique_id}'");
if($qry){
    $qry2 = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = '{$unique_id}'");
    if(mysqli_num_rows($qry2) > 0){
        $row = mysqli_fetch_assoc($qry2);
        $email = $row['email'];
        $sender_name = "Atingle";
        $sender_email = "donotreply.atingle@gmail.com";
        $recipient_email = $email;

        $subject = "OTP VERIFICATION CODE";
        $body = $otp;

        mail($recipient_email, $subject, $body, "From: $sender_name<$sender_email>");
        
    }
    else{
        echo "Something went wrong";
    }
}




?>