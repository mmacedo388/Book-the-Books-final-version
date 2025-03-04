<?php

require '../common.php';

$result = mysqli_query($dbc, "SELECT catalog.*, category.name AS category, sub_category.name AS sub_category FROM `catalog` 
 JOIN category ON category.id = catalog.category_id
 JOIN sub_category ON sub_category.id = catalog.sub_category_id");

if (!$result) {
    exit('query error');
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Products</title>
<?php include '../../_head.php' ?>
<body>
<?php include '../_header.php' ?>

<div class="admin-list">
	<h1>Products</h1>

	<a href="/admin/products/create.php">Create</a>

	<table class="list-table">
		<thead>
			<tr>
				<th>ID</th>
				<th>Image</th>
				<th>Name</th>
				<th>Category</th>
				<th>Sub-Category</th>
				<th>Price</th>
				<th>Description</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while ($row = mysqli_fetch_assoc($result)): ?>
			<tr>
				<td class="col-id"><?php echo $row['id'] ?></td>
				<td>
					<img src="/images/<?php echo $row['img'] ?>" class="img-fluid img-thumbnail" alt="<?php echo $row['name'] ?>" />
				</td>
				<td><?php echo $row['name'] ?></td>
				<td><?php echo $row['category'] ?></td>
				<td><?php echo $row['sub_category'] ?></td>
				<td><?php echo $row['price'] ?>&euro;</td>
				<td><?php echo $row['description'] ?></td>
				<td>
					<a href="/admin/products/edit.php?id=<?php echo $row['id'] ?>">Edit</a>
				</td>
			</tr>
			<?php endwhile ?>
		</tbody>
	</table>
</div>

<?php include '../../footer.php' ?>
<script src="/js/banner.js"></script>
<script src="/js/cart.js"></script>
</body>
</html>