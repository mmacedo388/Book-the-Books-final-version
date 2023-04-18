<?php

session_start();

$id = $_POST['id'] ?? '';
$id = (int) $id;

$cart = $_SESSION['cart'] ?? ['lines' => []];

foreach ($cart['lines'] as $index => $line) {
    if ($line['product_id'] === $id) {
        unset($cart['lines'][$index]);
        break;
    }
}

$_SESSION['cart'] = $cart;

$page = addslashes($_POST['page'] ?? '');

if (substr($page, 0, 1) === '/') {
    header("Location: $page");
} else {
    header("Location: /");
}
