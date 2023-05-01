<?php

require 'common.php';

$id = mysqli_real_escape_string($dbc, $_GET['id'] ?? '');
if (!$id) {
    header('Location: /admin/products.php');
    exit();
}

$result = mysqli_query($dbc, "SELECT * FROM `catalog` WHERE id = '$id'");

if (!$result || $result->num_rows === 0) {
    header('Location: /admin/products.php');
    exit();
}

$product = mysqli_fetch_assoc($result);

$values = $_SESSION["product_{$id}_form_values"] ?? [];
$errors = $_SESSION["product_{$id}_errors"] ?? [];

$_SESSION["product_{$id}_form_values"] = [];
$_SESSION["product_{$id}_errors"]= [];
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Products</title>
<?php include '../header.php' ?>
<body>
<?php include '../header-wrapper_admin.php' ?>

<div id="product-list">
	<h1><?php echo $product['name'] ?></h1>

	<form method="post" enctype="multipart/form-data" action="product-save.php?id=<?php echo $product['id'] ?>">
		<div class="form-row">
			<label for="product-image">Image</label>

			<div>
				<img src="/images/<?php echo $product['img'] ?>" class="img-fluid img-thumbnail" alt="<?php echo $product['name'] ?>" />
			</div>

			<input type="file" name="image" />
		</div>

		<div class="form-row">
			<label for="product-name">Name</label>
			<input name="name" id="product-name" type="text" value="<?php echo $values['name'] ?? $product['name'] ?>" placeholder="Please insert a book name" />

			<?php if (in_array('name', $errors)): ?>
			<div class="error-msg">Invalid Name</div>
			<?php endif ?>
		</div>

		<div class="form-row">
			<label for="product-category">Category</label>
			<input name="category" id="product-category" type="text" value="<?php echo $values['category'] ?? $product['category'] ?>" placeholder="Please insert a book category" />

			<?php if (in_array('category', $errors)): ?>
			<div class="error-msg">Invalid Category</div>
			<?php endif ?>
		</div>

		<div class="form-row">
			<label for="product-sub_category">Sub-Category</label>
			<input name="sub_category" id="product-sub_category" type="text" value="<?php echo $values['sub_category'] ?? $product['sub_category'] ?>" placeholder="Please insert a book sub category" />

			<?php if (in_array('sub_category', $errors)): ?>
			<div class="error-msg">Invalid Sub Category</div>
			<?php endif ?>
		</div>

		<div class="form-row">
			<label for="product-price">Price</label>
			<input name="price" id="product-price" type="number" step="0.01" value="<?php echo $values['price'] ?? $product['price'] ?>" placeholder="Please insert a book price" />

			<?php if (in_array('price', $errors)): ?>
			<div class="error-msg">Invalid Price</div>
			<?php endif ?>
		</div>

		<div class="form-row">
			<label for="product-description">Description</label>
			<input name="description" id="product-description" type="text" value="<?php echo $values['description'] ?? $product['description'] ?>" placeholder="Please insert a book description" />

			<?php if (in_array('description', $errors)): ?>
			<div class="error-msg">Invalid Description</div>
			<?php endif ?>
		</div>
		
		<input type="submit" value="Save" />  
	</form>
</div>

<?php include '../footer.php' ?>
<script src="/js/banner.js"></script>
<script src="/js/cart.js"></script>
</body>
</html>