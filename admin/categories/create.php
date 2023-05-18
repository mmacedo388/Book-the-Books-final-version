<?php

require '../common.php';

$values = $_SESSION["create_category_form_values"] ?? [];
$errors = $_SESSION["create_category_form_errors"] ?? [];

$_SESSION["create_category_form_values"] = [];
$_SESSION["create_category_form_errors"]= [];

$category = [
    'name' => '',
];
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Create Category</title>
<?php include '../../_head.php' ?>
<body>
<?php include '../_header.php' ?>

<div class="admin-list">
	<h1>Create Category</h1>

	<?php include '_form.php' ?>
</div>

<?php include '../../footer.php' ?>
<script src="/js/banner.js"></script>
<script src="/js/cart.js"></script>
</body>
</html>