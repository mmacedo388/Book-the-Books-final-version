<?php

require 'common.php';

$result = mysqli_query($dbc, "SELECT id, user, email FROM `user`");

if (!$result) {
    exit('query error');
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Users</title>
<?php include '../header.php' ?>
<body>
<?php include '../header-wrapper_admin.php' ?>

<div id="product-list">
	<h1>Users</h1>

	<table class="list-table">
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Email</th>
			</tr>
		</thead>
		<tbody>
			<?php while ($row = mysqli_fetch_assoc($result)): ?>
			<tr>
				<td><?php echo $row['id'] ?></td>
				<td><?php echo $row['user'] ?></td>
				<td><?php echo $row['email'] ?></td>
			</tr>
			<?php endwhile ?>
		</tbody>
	</table>
</div>

<?php include '../footer.php' ?>
<script src="/js/banner.js"></script>
<script src="/js/cart.js"></script>
</body>
</html>