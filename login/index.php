<?php
session_start();

if (isset($_SESSION['user_id'])) {
	header('Location: /');
	exit();
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Login</title>
	<?php include('../_head.php') ?>

<body>
	<?php
	include('../header-wrapper.php');
	include('../slideshow.php');
	include('_form.php');
	include('../footer.php');
	?>
	<script src="./js/banner.js"></script>
	<script src="./js/cart.js"></script>
</body>

</html>