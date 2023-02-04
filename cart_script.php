<?php
include ('connection.php');
if($_SESSION){
	$user_id = $_SESSION['user_id'];
	}
	else{
		$user_id = "";
	}
$cart = mysqli_query($dbc, "SELECT * FROM cart WHERE id_user = '$user_id' LIMIT 1000");
?>
<?php
while($items=mysqli_fetch_array($cart)){
?>
	<div class="p-name"><?php echo $items['name'] ?></div>
	<div class="p-price"><?php echo $items['price'] ?>&euro;</div>
	<div class="p-desc"><?php echo $items['desc'] ?></div>
	<input type="number" name="quantity" value="1">
<?php } ?>



