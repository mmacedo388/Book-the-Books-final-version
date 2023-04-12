<?php
require('../connection.php');

$cart = $_SESSION['cart'] ?? null;

$productIds = array_map(function ($line) {
    return $line['product_id'];
}, $cart['lines']);

$productIds = implode(", ", $productIds);
$result = mysqli_query($dbc, "SELECT * FROM catalog WHERE id IN ($productIds)");
$products = [];

while ($row = mysqli_fetch_assoc($result)) {
    $products[$row['id']] = $row;
}

if ($cart):
    foreach ($cart['lines'] as $line):
        ?>
        <div class="p-name"><?php echo $products[$line['product_id']]['name'] ?></div>
        <div class="p-price"><?php echo $products[$line['product_id']]['price'] ?>&euro;</div>
        <div class="p-desc"><?php echo $products[$line['product_id']]['description'] ?></div>
        <input type="number" name="quantity" value="<?php echo $line['quantity'] ?>">
<?php
    endforeach;
endif;
?>



