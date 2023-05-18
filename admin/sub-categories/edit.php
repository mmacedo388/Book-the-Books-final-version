<?php

require '../common.php';

$id = mysqli_real_escape_string($dbc, $_GET['id'] ?? '');
if (!$id) {
    header('Location: /admin/sub-categories');
    exit();
}

$result = mysqli_query($dbc, "SELECT * FROM `sub_category` WHERE id = '$id'");

if (!$result || $result->num_rows === 0) {
    header('Location: /admin/sub-categories.php');
    exit();
}

$sub_category = mysqli_fetch_assoc($result);

$values = $_SESSION["sub_category_{$id}_form_values"] ?? [];
$errors = $_SESSION["sub_category_{$id}_form_errors"] ?? [];

$_SESSION["sub_category_{$id}_form_values"] = [];
$_SESSION["sub_category_{$id}_form_errors"]= [];
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Sub Categories</title>
<?php include '../../_head.php' ?>
<body>
<?php include '../_header.php' ?>

<div class="admin-list">
	<h1><?php echo $sub_category['name'] ?></h1>

	<?php include '_form.php' ?>
</div>

<?php include '../../footer.php' ?>
<script src="/js/banner.js"></script>
<script src="/js/cart.js"></script>
</body>
</html>