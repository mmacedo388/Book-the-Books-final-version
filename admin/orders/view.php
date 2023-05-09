<?php

require '../common.php';

$id = mysqli_real_escape_string($dbc, $_GET['id'] ?? '');
if (!$id) {
    header('Location: /admin/orders');
    exit();
}

$result = mysqli_query($dbc, "SELECT * FROM `order` WHERE id = '$id'");

if (!$result || $result->num_rows === 0) {
    header('Location: /admin/orders');
    exit();
}

$order = mysqli_fetch_assoc($result);

$order['lines'] = json_decode($order['lines'], true);

$productIds = array_map(function ($line) {
    return $line['product_id'];
}, $order['lines'] ?? []);

$productIds = implode(", ", $productIds);
$result = mysqli_query($dbc, "SELECT * FROM catalog WHERE id IN ($productIds)");

$products = [];

while ($row = mysqli_fetch_assoc($result)) {
    $products[$row['id']] = $row;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Order #<?php echo $order['id'] ?></title>
<?php include '../../_head.php' ?>
<body>
<?php include '../_header.php'; ?>

<div id="orders">
	<h1>Order #<?php echo $order['id'] ?></h1>

	<a href="/admin/orders">Order List</a>

	<table class="list-table">
		<tbody>
			<tr>
				<th>Name</th>
				<td><?php echo $order['name'] ?></td>
			</tr>
			<tr>
				<th>Email</th>
				<td><?php echo $order['email'] ?></td>
			</tr>
			<tr>
				<th>Phone Number</th>
				<td><?php echo $order['phone_number'] ?></td>
			</tr>
			<tr>
				<th>Address</th>
				<td><?php echo $order['address'] ?></td>
			</tr>
			<tr>
				<th>Address Zip</th>
				<td><?php echo $order['address_zip'] ?></td>
			</tr>
			<tr>
				<th colspan="2">Products</th>
			</tr>
		<?php
            foreach ($order['lines'] as $line):
                $productId = $line['product_id'];
                ?>
			<tr class="line">
				<td colspan="2">
					<table class="line-table">
						<tr>
							<td>
								<img src="/images/<?php echo $products[$productId]['img'] ?>" class="img-fluid img-thumbnail" alt="<?php echo $products[$productId]['name'] ?>" />
							</td>
							<td><?php echo $products[$productId]['name'] ?></td>
							<td><?php echo $line['quantity'] ?>x</td>
							<td><?php echo $products[$productId]['price'] ?>&euro;</td>
						</tr>
					</table>
				</td>
			</tr>
		<?php endforeach ?>
			<tr>
				<th>Total</th>
				<td><?php echo $order['total'] ?>&euro;</td>
			</tr>
			<tr>
				<th>Payment Method</th>
				<td><?php echo $order['payment_method'] ?></td>
			</tr>
			<tr>
				<th>Created</th>
				<td><?php echo $order['created_at'] ?></td>
			</tr>
		</tbody>
	</table>
</div>


<?php include '../../footer.php' ?>
<script src="/js/banner.js"></script>
<script src="/js/cart.js"></script>
</body>
</html>