<form method="post" enctype="multipart/form-data" action="save.php" id="form-product-update">
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
</form>

<form method="post" action="/admin/products/delete.php" id="form-product-delete" onsubmit="return confirm('Are you sure you want to delete this product?')">
	<input type="hidden" name="id" value="<?php echo $product['id'] ?>" />
</form>

<div class="submit-btns">
	<input type="submit" form="form-product-update" value="<?php echo isset($product['id']) ? 'Save' : 'Create' ?>" />  
	<input type="submit" form="form-product-delete" value="Delete" />
</div>
