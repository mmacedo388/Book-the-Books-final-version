<?php
	$categories = mysqli_query($dbc, "SELECT * FROM `category`");
?>
<form method="post" enctype="multipart/form-data" action="/admin/sub-categories/save.php" id="form-sub-category-update">
	<input type="hidden" name="page" value="<?php echo $_SERVER['REQUEST_URI'] ?>" />

	<?php if (isset($sub_category['id'])): ?>
	<input type="hidden" name="id" value="<?php echo $sub_category['id'] ?>" />
	<?php endif ?>

	<div class="form-row">
		<label for="sub-category-category-id">Category</label>
		<select name="category_id" id="sub-category-category-id">
		<?php while($category = mysqli_fetch_assoc($categories)): ?>
			<option value="<?php echo $category['id'] ?>" <?php echo $category['id'] === $sub_category['category_id'] ? 'selected' : '' ?>><?php echo $category['name'] ?></option>
		<?php endwhile ?>
		</select>

		<?php if (in_array('category_id', $errors)): ?>
		<div class="error-msg">Invalid Category</div>
		<?php endif ?>
	</div>

	<div class="form-row">
		<label for="sub-category-name">Name</label>
		<input name="name" id="sub-category-name" type="text" value="<?php echo $values['name'] ?? $sub_category['name'] ?>" placeholder="Please insert a sub category name" />

		<?php if (in_array('name', $errors)): ?>
		<div class="error-msg">Invalid Name</div>
		<?php endif ?>
	</div>
</form>

<?php if (isset($sub_category['id'])): ?>
<form method="post" action="/admin/sub-categories/delete.php" id="form-sub-category-delete" onsubmit="return confirm('Are you sure you want to delete this sub category?')">
	<input type="hidden" name="id" value="<?php echo $sub_category['id'] ?>" />
</form>
<?php endif ?>

<div class="submit-btns">
	<input type="submit" form="form-sub-category-update" value="<?php echo isset($sub_category['id']) ? 'Save' : 'Create' ?>" />  

	<?php if (isset($sub_category['id'])): ?>
	<input type="submit" form="form-sub-category-delete" value="Delete" />
	<?php endif ?>
</div>
