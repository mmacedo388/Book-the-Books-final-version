<?php
include ('connection.php');
session_start();
if($_SESSION){
$user_id = $_SESSION['user_id'];
}
else{
	$user_id = "";
}

$id = $_GET['id'];

?>
<?php
if($user_id && $id){
mysqli_query( $dbc, "DELETE FROM `cart` WHERE id = '$id' && id_user = '$user_id'");
header('Location: cart.php');
}
else{
    header('Location: login.php');
}
?>