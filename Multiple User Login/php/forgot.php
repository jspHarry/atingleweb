<?php 


include 'db.php';
$email = $_POST['email'];

function generateRandomToken($length = 20){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $token = '';

    for($i = 0; $i < $length; $i++){
        $randomIndex = rand(0, strlen($characters) - 1);
        $token .= $characters[$randomIndex];
    }
    return $token;
}

if(isset($email)){
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        $sql = mysqli_query($conn, "SELECT unique_id FROM users WHERE email = '{$email}'" );
        if(mysqli_num_rows($sql) > 0){
            $time = time() + 3600;
            $token = generateRandomToken();
            $qry = mysqli_query($conn, "UPDATE `users` SET `token` = '{$token}' , `expiration_time` = $time WHERE `email` = '{$email}'");

            $resetLink = "http://localhost/ME/PHP/Multiple%20User%20Login/new_pass.php?token=" . urlencode($token);

            $sender_name = "Atingle";
            $subject = "Password Reset Request";
            $message = "Hi, \n\nYou have requested to reset your password. Click the link below to reset your password:\n\n" . $resetLink . 
            "\n\nIf you did not request this password reset, please ignore this email.\n\n";

            $sender_email = "donotreply.atingle@gmail.com";
            $headers = "From: $sender_name <$sender_email>\r\n";

            $no_reply_email = "donotreply.atingle@gmail.com";
            $headers .= "Reply-To: $no_reply_email\r\n";

            $mailSent = mail($email, $subject, $message, $headers);

            if($mailSent){
                echo "success";
            }
            else{
                echo "Failed to send password reset instruction.";
            }
        }
        else{
            echo "Email doesn't exists!";
        }
    }
    else{
        echo "$email ~ This is not valid Email.";
    }
}
else{
    echo "Enter your Email";
}






?>