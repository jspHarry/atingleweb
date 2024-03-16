<?php

session_start();
include 'db.php';

function emphasizeOTP($otp) {
    return str_replace(' ', '*', $otp);
}

$fullname = $_POST['fullname'];
$email = $_POST['email'];
$password = $_POST['password'];
$Role = 'user';
$verification_status = 'Pending';

$password_criteria_regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';

if(!empty($fullname) && !empty($email) && !empty($password)){
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        if(preg_match($password_criteria_regex, $password)) {
            $password = md5($password);
            
            $qry = mysqli_query($conn, "SELECT email FROM users WHERE email = '{$email}'");
            if(mysqli_num_rows($qry) > 0){
                echo "$email ~ Already Exists!";
            } else{
                $unique_id = rand(time(), 100000000);
                $otp = mt_rand(1111, 9999);
                $otp_display = emphasizeOTP($otp);
                $qry2 = mysqli_query($conn, "INSERT INTO users(unique_id,full_name,email,password,otp,verification_status,role)
                VALUES({$unique_id}, '{$fullname}', '{$email}', '{$password}', {$otp}, '{$verification_status}','{$Role}')");
                if($qry2){
                    $qry3 = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = '{$unique_id}'");
                    if(mysqli_num_rows($qry3) > 0){
                        $row = mysqli_fetch_assoc($qry3);
                        $_SESSION['u_id'] = $row['unique_id'];
                        $_SESSION['otp'] = $row['otp'];
                        if($row){
                            $email = $row['email'];
                            $sender_name = "Atingle";
                            $sender_email = "donotreply.atingle@gmail.com";
                            $recipient_email = $email;
                            $subject = "OTP VERIFICATION CODE";
                            $body = "Dear {$fullname},\nTo authenticate your account, please use the following One Time Password (OTP):\n\n{$otp_display}\n\nPlease enter this OTP on the verification page to complete your registration.\n\nPlease note that our customer service team will never ask you for your password or OTP.\n\nWe look forward to seeing you again soon.\n\nBest regards,\nThe Atingle Team";

                            if(mail($recipient_email, $subject, $body, "From: $sender_name<$sender_email>")){
                                echo "success";
                            }
                            else{
                                echo "Something went wrong";
                            }
                        }
                    }
                }
            }
        } else {
            echo "Password must contain at least one uppercase letter, one lowercase letter, one number, one special character, and be at least 8 characters long.";
        }
    }
    else{
        echo "$email ~ This is not a valid Email";
    }
    
}
else {
    echo "ALL Fields are Required";
}

?>
