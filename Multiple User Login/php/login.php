<?php

session_start();
include 'db.php';

$email = $_POST['email'];
$password = $_POST['password'];

if (!empty($email) && !empty($password)) {
    $sql = mysqli_query($conn, "SELECT * FROM users where email = '{$email}' AND password = '{$password}' ");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
        if ($row) {
            if (!isset($_SESSION['data_array'])) {
                $_SESSION['data_array'] = array();
            }
            if (isset($_SESSION['u_id']) && in_array($row['unique_id'], $_SESSION['data_array'])) {
                $_SESSION['u_id'] = $row['unique_id'];
                $_SESSION['verification_status'] = $row['verification_status'];
                $_SESSION['otp'] = $row['otp'];
                echo "success";
            } 
            else {
                $dataArray = $_SESSION['data_array'];
                $yourArray = array($row['unique_id']);
                foreach ($yourArray as $item) {
                    $dataArray[] = $item;
                }
                $dataArray = array_values($dataArray);


                $_SESSION['dataArray'] = $dataArray;
                $_SESSION['u_id'] = $row['unique_id'];
                $_SESSION['verification_status'] = $row['verification_status'];
                $_SESSION['otp'] = $row['otp'];

                $jsonData = json_encode($dataArray);
                
                setcookie('data_cookie', $jsonData, time() + (30 * 24 * 60 * 60), '/');

                echo "success";
            }
        }
    } 
    else {
        echo "Email or Password is Incorrect";
    }
} 
else {
    echo "All Fields are Required";
}
