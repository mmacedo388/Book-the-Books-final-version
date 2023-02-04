<?php
include ('connection.php');
session_start();
if($_SESSION){
$user_id = $_SESSION['user_id'];
}
else{
	$user_id = "";
}
$name = $_POST['name'];
$price = $_POST['price'];
$desc = $_POST['desc'];
$img = $_POST['img'];
$quantity = $_POST['quantity'];

if($user_id && $name && $price && $desc && $img && $quantity){
mysqli_query( $dbc, "INSERT INTO cart (`id_user`, `name`, `price`, `desc`, `img`, `quantity`) VALUES ('$user_id','$name','$price','$desc','$img', '$quantity');");
header("Location: catalog.php");
}
else{
    header("Location: login.php");
}

?>