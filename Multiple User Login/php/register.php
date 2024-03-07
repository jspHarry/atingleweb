<?php


session_start();
include 'db.php';

$fullname = $_POST['fullname'];
$email = $_POST['email'];
$password = $_POST['password'];
$Role = 'user';
$verification_status = 'Pending';

if(!empty($fullname) && !empty($email) && !empty($password)){
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        $qry = mysqli_query($conn, "SELECT email FROM users WHERE email = '{$email}'");
        if(mysqli_num_rows($qry) > 0){
            echo "$email ~ Already Exists!";
        } else{
            $unique_id = rand(time(), 100000000);
            $otp = mt_rand(1111, 9999);
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
                        $body = $otp;
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
        
    }
    else{
        echo "$email ~ This is not valid Email";
    }
    
}
else {
    echo "ALL Fields are Required";
}

?>