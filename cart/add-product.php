<?php

require('../connection.php');

session_start();

$id = $_POST['id'] ?? '';
$quantity = $_POST['quantity'] ?? '';

if (!$id || !$quantity || !is_numeric($id) || !is_numeric($quantity)) {
    header('Location: /');
    exit();
}

$id = (int) $id;
$quantity = (int) $quantity;

// check if product exists
$result = mysqli_query($dbc, "SELECT id FROM catalog WHERE id = '$id'");

if (!$result->num_rows) {
    header('Location: /');
    exit();
}

// $_SESSION['cart'] = null;

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [
    'lines' => [],
];

$lineFound = false;

foreach ($cart['lines'] as & $line) {
    if ($line['product_id'] === $id) {
        $lineFound = true;

        $line['quantity'] += $quantity;
        break;
    }
}

if (!$lineFound) {
    $cart['lines'][] = [
        'product_id' => (int) $id,
        'quantity' => $quantity,
    ];
}

$_SESSION['cart'] = $cart;

header("Location: /cart");
