<?php

require '../common.php';

$id = mysqli_real_escape_string($dbc, $_GET['id'] ?? '');
if (!$id) {
    header('Location: /admin/products');
    exit();
}

$result = mysqli_query($dbc, "SELECT * FROM `catalog` WHERE id = '$id'");

if (!$result || $result->num_rows === 0) {
    header('Location: /admin/products.php');
    exit();
}

$product = mysqli_fetch_assoc($result);

$values = $_SESSION["product_{$id}_form_values"] ?? [];
$errors = $_SESSION["product_{$id}_form_errors"] ?? [];

$_SESSION["product_{$id}_form_values"] = [];
$_SESSION["product_{$id}_form_errors"]= [];
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Products</title>
<?php include '../../_head.php' ?>
<body>
<?php include '../_header.php' ?>

<div id="product-list">
	<h1><?php echo $product['name'] ?></h1>

	<?php include '_form.php' ?>
</div>

<?php include '../../footer.php' ?>
<script src="/js/banner.js"></script>
<script src="/js/cart.js"></script>
</body>
</html>