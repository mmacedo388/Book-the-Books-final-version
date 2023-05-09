<?php

require '../connection.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
//processing form

$user_name = $_POST['user_name'];
$user_email = $_POST['user_email'];
$user_gender = $_POST['user_gender'];
$user_age = $_POST['user_age'];
$user_message = $_POST['user_message'];

    if(!empty($user_name) && !empty($user_email) && !empty($user_gender) && !empty($user_age) && !empty( $user_message)){
        
        mysqli_query($dbc, "INSERT INTO form(name, email, gender, age, message) VALUES('$user_name', '$user_email', '$user_gender', '$user_age', '$user_message') ");

        $registered = mysqli_affected_rows($dbc);

        die($registered." row is affected, everything works fine!");
    }
    if(!empty($user_name) or !empty($user_email) or !empty($user_gender) or !empty($user_age) or !empty( $user_message)){
        die("Please fill all values of the form!"); 
}else{
    die("No form has been submitted!");
}
}
?>