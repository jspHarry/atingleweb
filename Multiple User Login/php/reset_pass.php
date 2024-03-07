<?php 

include 'db.php';
$token = $_POST['token'];
$new_pass = $_POST['new_pass'];
$c_pass = $_POST['c_pass'];

if(!empty($new_pass) && !empty($c_pass)){
    $sql = mysqli_query($conn, "SELECT *FROM users WHERE token = '$token'");
    if(mysqli_num_rows($sql) > 0){
        $row = mysqli_fetch_assoc($sql);
        $unique_id = $row['unique_id'];
        $expiration_time = $row['expiration_time'];

        if($row['password'] == $new_pass){
            echo "New password cannot be the same as your old password,";
        }
        else{
            if($new_pass == $c_pass){
                if(time() <= $expiration_time){
                    $new_token = mt_rand(11111111, 99999999);
                    $sql2 = mysqli_query($conn, "UPDATE users SET `password` = '{$new_pass}' , `token` = '{$new_token}', `expiration_time` = 0 WHERE unique_id = '{$unique_id}'");
                    if($sql2){
                        echo "success";
                    }
                    else{
                        echo "Something went wrong";
                    }
                }
                else{
                    echo "Token Expired";
                }
            }
            else{
                echo "Confirm Password Don't Match";
            }
        }
    }
    else{
        echo "Invalid Request";
    }
}
else{
    echo "Both fields are Required";
}



?>