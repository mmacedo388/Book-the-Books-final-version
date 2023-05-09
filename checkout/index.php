<?php
require('../connection.php');

session_start();

$cart = $_SESSION['cart'] ?? null;

if (!$cart) {
    header('Location: /');
    exit();
}

$productIds = array_map(function ($line) {
    return $line['product_id'];
}, $cart['lines'] ?? []);

if (!$productIds) {
    header('Location: /');
    exit();
}

$productIds = implode(", ", $productIds);
$result = mysqli_query($dbc, "SELECT * FROM catalog WHERE id IN ($productIds)");
$products = [];

while ($row = mysqli_fetch_assoc($result)) {
    $products[$row['id']] = $row;
}

$cartTotal = 0;
$productTotalCount = 0;
foreach ($cart['lines'] as $line) {
    $id = $line['product_id'];
    $productTotalCount += $line['quantity'];
    $cartTotal += ((float) $products[$id]['price']) * ((int) $line['quantity']);
}

?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Checkout</title>
	<?php include('../_head.php') ?>

<body>
<?php
include('../header-wrapper.php');
include('../slideshow.php');
include('_form.php');
include('../footer.php');
?>
	<script src="./js/banner.js"></script>
	<script src="./js/cart.js"></script>
</body>
</html>