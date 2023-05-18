<form method="post" enctype="multipart/form-data" action="/admin/categories/save.php" id="form-category-update">
	<input type="hidden" name="page" value="<?php echo $_SERVER['REQUEST_URI'] ?>" />

	<?php if (isset($category['id'])): ?>
	<input type="hidden" name="id" value="<?php echo $category['id'] ?>" />
	<?php endif ?>

	<div class="form-row">
		<label for="category-name">Name</label>
		<input name="name" id="category-name" type="text" value="<?php echo $values['name'] ?? $category['name'] ?>" placeholder="Please insert a category name" />

		<?php if (in_array('name', $errors)): ?>
		<div class="error-msg">Invalid Name</div>
		<?php endif ?>
	</div>
</form>

<?php if (isset($category['id'])): ?>
<form method="post" action="/admin/categories/delete.php" id="form-category-delete" onsubmit="return confirm('Are you sure you want to delete this category?')">
	<input type="hidden" name="id" value="<?php echo $category['id'] ?>" />
</form>
<?php endif ?>

<div class="submit-btns">
	<input type="submit" form="form-category-update" value="<?php echo isset($category['id']) ? 'Save' : 'Create' ?>" />  

	<?php if (isset($category['id'])): ?>
	<input type="submit" form="form-category-delete" value="Delete" />
	<?php endif ?>
</div>
