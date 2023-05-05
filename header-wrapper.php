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
	<div id="header" class="container">
		<div id="menu">
			<ul>
				<a href="./index.php" title="Homepage">
					<li>Homepage</li>
				</a>

				<a href="./catalog.php" title="Catalog">
					<li>Catalog</li>
				</a>
				<a href="./about_us.php" title="About Us">
					<li>About Us</li>
				</a>
				<a href="./contact_us.php" title="Contact Us">
					<li>Contact Us</li>
				</a>

				<form id="search" action="/catalog.php" method="get">
					<input type="search" class="form-control" name="q" value="<?php echo strip_tags(addslashes($_GET['q'] ?? '')) ?>" />
					<button type="submit" id="search-btn" class="btn btn-primary"><i class="bi bi-search"></i></button>
				</form>

				<?php if ($user_admin == "1") { ?>

					<a href="./admin.php" title="Admin">
						<li>Admin</li>
					</a>

				<?php } ?>

			</ul>
		</div>
	</div>
	<div id="menu2">
		<ul>
			<?php if (!$user_name) { ?>
				<a href="/register"><i class="bi bi-r-circle-fill"></i>
					<li>Register</li>
				</a>
			<?php } ?>
			<?php if ($user_name) { ?>
				<span>Welcome, <?php echo $user_name ?> </span>
			<?php } ?>
			<?php if (!$user_name) { ?>
				<a href="/login"><i class="bi bi-person-fill"></i>
					<li>Login</li>
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
		</ul>
	</div>
	<div id="logo">
		<img src="/images/logo.png" style="width: 225px!important" ;">
	</div>
</div>
</div>
<?php include('cart/modal.php') ?>