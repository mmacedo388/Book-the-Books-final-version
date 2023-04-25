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

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [
    'lines' => [],
];

$lineFound = false;

foreach ($cart['lines'] as & $line) {
    if ($line['product_id'] === $id) {
        $lineFound = true;

        $line['quantity'] = $quantity;
        break;
    }
}

$_SESSION['cart'] = $cart;

if ($lineFound) {
    http_response_code(204);
} else {
    http_response_code(500);
}
