<?php

require '../common.php';

$values = $_SESSION["create_product_form_values"] ?? [];
$errors = $_SESSION["create_product_form_errors"] ?? [];

$_SESSION["create_product_form_values"] = [];
$_SESSION["create_product_form_errors"]= [];

$product = [
    'id' => '',
    'name' => '',
    'category' => '',
    'sub_category' => '',
    'price' => '',
    'description' => '',
    'img' => '',
];
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Create Product</title>
<?php include '../../header.php' ?>
<body>
<?php include '../../header-wrapper_admin.php' ?>

<div id="product-list">
	<h1>Create Product</h1>

	<?php include '_form.php' ?>
</div>

<?php include '../../footer.php' ?>
<script src="/js/banner.js"></script>
<script src="/js/cart.js"></script>
</body>
</html>