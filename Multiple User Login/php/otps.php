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
        $otp = "<b>" . $otp . "</b>";
        $subject = "OTP VERIFICATION CODE";
        $body = "To authenticate, please use the following One Time Password (OTP):\n\n" . $otp .
        "\n\nDon't share this OTP with anyone. Our customer service team will never ask you for password, OTP or any other info.\n\nWe hope to see you again soon";

        mail($recipient_email, $subject, $body, "From: $sender_name<$sender_email>");
        
    }
    else{
        echo "Something went wrong";
    }
}




?>
