<?php
session_start();
if($_SESSION){
$user_name = $_SESSION['user_name'];
}
else{
	$user_name = "";
}

?>
<div id="header-wrapper">
	<div id="header" class="container">
		<div id="menu">
			<ul>
				<a href="./index.php" title="Homepage">
				<li>Homepage</li>
				</a>
				<a href="./products.php" title="Products">
				<li>Products</li>
				</a>
				<a href="./orders.php" title="Orders">
				<li>Orders</li>
				</a>
			</ul>
		</div>
	</div>
	<div id="menu2">
		<ul>
			<?php if( !$user_name ) { ?>
			<a href=""><i class="bi bi-r-circle-fill"></i>
			<li>Register</li>
			</a>
			<?php } ?>
			<?php if( $user_name ) { ?>
			<a>Welcome, <?php echo $user_name ?> </a>
			<?php } ?>
			<?php if( !$user_name ) { ?>
			<a href="./login.php"><i class="bi bi-person-fill" ></i>
			<li>Login</li>
			</a>
			<?php } ?>
			<a href="./cart.php"><i class="bi bi-cart-fill" ></i>
			<li>Cart</li>
			</a>
			<?php if( $user_name ) { ?>
			<a href="./logout.php"><i class="bi bi-box-arrow-right"></i>
			<li>Logout</li>
			</a>
			<?php } ?>
		</ul>
	</div>
		<div id="logo">
			<img src="./images/logo.png" style="width: 225px!important;">
		</div>
	</div>
</div>
