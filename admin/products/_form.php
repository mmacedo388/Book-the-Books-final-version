<?php
	$result = mysqli_query($dbc, "SELECT sub_category.id, sub_category.name, category.name AS category_name FROM sub_category JOIN category ON sub_category.category_id = category.id");

	$categories = [];

	while ($row = mysqli_fetch_assoc($result)) {
		$categories[$row['category_name']][$row['id']] = $row['name'];
	}
?>
<form method="post" enctype="multipart/form-data" action="/admin/products/save.php" id="form-product-update">
	<input type="hidden" name="page" value="<?php echo $_SERVER['REQUEST_URI'] ?>" />

	<?php if (isset($product['id'])): ?>
	<input type="hidden" name="id" value="<?php echo $product['id'] ?>" />
	<?php endif ?>

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
		<label for="sub-category-category-id">Category / Sub Category</label>
		<select name="sub_category_id" id="sub-category-category-id">
		<?php foreach ($categories as $categoryName => $subCategories): ?>

			<optgroup label="<?php echo $categoryName ?>">
				<?php foreach ($subCategories as $id => $name): ?>
				<option value="<?php echo $id ?>" <?php echo $id == ($values['sub_category_id'] ?? $product['sub_category_id']) ?'selected' : '' ?>>
					<?php echo $name ?>
				</option>
				<?php endforeach  ?>
			</optgroup>

		<?php endforeach  ?>
		</select>

		<?php if (in_array('sub_category_id', $errors)): ?>
		<div class="error-msg">Invalid Category / Sub Category</div>
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
</form>

<?php if (isset($product['id'])): ?>
<form method="post" action="/admin/products/delete.php" id="form-product-delete" onsubmit="return confirm('Are you sure you want to delete this product?')">
	<input type="hidden" name="id" value="<?php echo $product['id'] ?>" />
</form>
<?php endif ?>

<div class="submit-btns">
	<input type="submit" form="form-product-update" value="<?php echo isset($product['id']) ? 'Save' : 'Create' ?>" />  

	<?php if (isset($product['id'])): ?>
	<input type="submit" form="form-product-delete" value="Delete" />
	<?php endif ?>
</div>
