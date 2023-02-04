<?php
if($_SESSION){
    $user_admin = $_SESSION['user_admin'];
    $user_name = $_SESSION['user_name'];
    if($user_admin != "1"){
    header('Location: index.php');
    }
}
else{

	$user_name = "";
	$user_admin = "";
}
?>
