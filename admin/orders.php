<?php


require 'common.php';

$result = mysqli_query($dbc, "SELECT id, name, email, phone_number, total, created_at FROM `order` ORDER BY created_at DESC");

if (!$result) {
    exit('query error');
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Orders</title>
<?php include '../header.php' ?>
<body>
<?php include '../header-wrapper_admin.php' ?>

<div id="order-list">
	<h1>Orders</h1>

	<table class="list-table">
		<thead>
			<tr>
				<th>
					ID
				</th>
				<th>
					Name
				</th>
				<th>
					Email
				</th>
				<th>
					Phone Number
				</th>
				<th>
					Total
				</th>
				<th>
					Created
				</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while ($row = mysqli_fetch_assoc($result)): ?>
			<tr>
				<td><?php echo $row['id'] ?></td>
				<td><?php echo $row['name'] ?></td>
				<td><?php echo $row['email'] ?></td>
				<td><?php echo $row['phone_number'] ?></td>
				<td><?php echo $row['total'] ?>&euro;</td>
				<td><?php echo $row['created_at'] ?></td>
				<td>
					<a href="/admin/order-view.php?id=<?php echo $row['id'] ?>">View</a>
				</td>
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