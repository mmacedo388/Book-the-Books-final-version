<?php

if (!isset($_SESSION)) {
    session_start();
}

if ($_SESSION) {
    $user_name = $_SESSION['user_name'];
} else {
    $user_name = "";
}

?>
<div id="header-wrapper">
	<div id="header" class="container">
		<a href="/" id="logo">
			<img src="/images/logo.png" />
		</a>
		<div id="menu">
			<a href="/admin/products" title="Products">
				Products
			</a>
			<a href="/admin/categories" title="Categories">
				Categories
			</a>
			<a href="/admin/orders" title="Orders">
				Orders
			</a>
			<a href="/admin/users" title="Orders">
				Users
			</a>
		</div>

		<div id="user-menu">
			<?php if (!$user_name) { ?>
			<a href=""><i class="bi bi-r-circle-fill"></i>
				Register
			</a>
			<?php } ?>
			<?php if ($user_name) { ?>
			<span>Welcome, <?php echo $user_name ?> </span>
			<?php } ?>
			<?php if (!$user_name) { ?>
			<a href="/login"><i class="bi bi-person-fill"></i>
				Login
			</a>
			<?php } ?>


			<?php if (isset($_SESSION['cart'])) : ?>
			<button data-bs-toggle="modal" data-bs-target="#cartModal">
				<i class="bi bi-cart-fill"></i>
				Cart
			</button>
			<?php endif ?>


			<?php if ($user_name) { ?>
			<form action="/login/logout.php" method="post" id="logout-form">
				<button type="submit">
					<i class="bi bi-box-arrow-right"></i>
					Logout
				</button>
			</form>
			<?php } ?>
		</div>
	</div>
</div>