<?php

require '../common.php';

$id = mysqli_real_escape_string($dbc, $_GET['id'] ?? '');
if (!$id) {
    header('Location: /admin/categories');
    exit();
}

$result = mysqli_query($dbc, "SELECT * FROM `category` WHERE id = '$id'");

if (!$result || $result->num_rows === 0) {
    header('Location: /admin/categories.php');
    exit();
}

$category = mysqli_fetch_assoc($result);

$values = $_SESSION["category_{$id}_form_values"] ?? [];
$errors = $_SESSION["category_{$id}_form_errors"] ?? [];

$_SESSION["category_{$id}_form_values"] = [];
$_SESSION["category_{$id}_form_errors"]= [];
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Categories</title>
<?php include '../../_head.php' ?>
<body>
<?php include '../_header.php' ?>

<div class="admin-list">
	<h1><?php echo $category['name'] ?></h1>

	<?php include '_form.php' ?>
</div>

<?php include '../../footer.php' ?>
<script src="/js/banner.js"></script>
<script src="/js/cart.js"></script>
</body>
</html>