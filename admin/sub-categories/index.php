<?php

require '../common.php';

$result = mysqli_query($dbc, "SELECT sub_category.id, sub_category.name, category.name AS category_name FROM sub_category JOIN category ON sub_category.category_id = category.id");

if (!$result) {
    exit('query error');
}
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
	<h1>
		<a href="/admin/categories">
		Categories
		</a>

		Sub Categories
	</h1>


	<a href="/admin/sub-categories/create.php">Create</a>
	
	<table class="list-table">
		<thead>
			<tr>
				<th>ID</th>
				<th>Category</th>
				<th>Name</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while ($row = mysqli_fetch_assoc($result)): ?>
			<tr>
				<td><?php echo $row['id'] ?></td>
				<td><?php echo $row['category_name'] ?></td>
				<td><?php echo $row['name'] ?></td>
				<td>
					<a href="/admin/sub-categories/edit.php?id=<?php echo $row['id'] ?>">Edit</a>
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