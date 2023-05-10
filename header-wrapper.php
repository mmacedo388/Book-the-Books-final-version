<?php
if (!isset($_SESSION)) {
	session_start();
}

if (isset($_SESSION['user_id'])) {
	$user_admin = $_SESSION['user_admin'];
	$user_name = $_SESSION['user_name'];
} else {
	$user_name = "";
	$user_admin = "";
}
?>
<div id="header-wrapper">
	<a href="/" id="logo">
		<img src="/images/logo.png" />
	</a>
	<div id="menu">
		<a href="/catalog" title="Catalog">
			Catalog
		</a>
		<a href="/about-us" title="About Us">
			About Us
		</a>
		<a href="/contact-us" title="Contact Us">
			Contact Us
		</a>

		<?php if ($_SERVER['SCRIPT_NAME'] === '/catalog/index.php') : ?>
			<form id="search" action="/catalog" method="get">
				<input type="search" class="form-control" name="q" value="<?php echo strip_tags(addslashes($_GET['q'] ?? '')) ?>" />
				<button type="submit" id="search-btn" class="btn btn-primary"><i class="bi bi-search"></i></button>
			</form>
		<?php endif ?>

		<?php if ($user_admin == "1") { ?>

			<a href="/admin" title="Admin">
				Admin
			</a>

		<?php } ?>

	</div>
	<div id="user-menu">
		<?php if (!$user_name) { ?>
			<a href="/register"><i class="bi bi-r-circle-fill"></i>
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