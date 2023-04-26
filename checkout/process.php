<?php

require('../connection.php');

session_start();

$cart = $_SESSION['cart'] ?? null;
$cartLines = $cart['lines'] ?? [];

if (empty($cartLines)) {
    header('Location: /');
    exit();
}

// obter os dados enviados a partir do formulario
$name = isset($_POST['name']) ? $_POST['name'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$phone_number = isset($_POST['phone_number']) ? $_POST['phone_number'] : '';
$address = isset($_POST['address']) ? $_POST['address'] : '';
$address_zip = isset($_POST['address_zip']) ? $_POST['address_zip'] : '';
$payment_method = isset($_POST['payment_method']) ? $_POST['payment_method'] : '';

// sanitize/validate
$name = trim(strip_tags(filter_var($name, FILTER_SANITIZE_ADD_SLASHES)));
$email = trim(strip_tags(filter_var($email, FILTER_SANITIZE_EMAIL)));
$phone_number = trim(strip_tags(filter_var($phone_number, FILTER_SANITIZE_ADD_SLASHES)));
$address = trim(strip_tags(filter_var($address, FILTER_SANITIZE_ADD_SLASHES)));

$_SESSION['checkout_form_values'] = compact('name', 'email', 'phone_number', 'address', 'address_zip', 'payment_method');

$errors = [
    'name' => strlen($name) < 10,
    'email' => !filter_var($email, FILTER_VALIDATE_EMAIL),
    'phone_number' => strlen($phone_number) !== 9 || !is_numeric($phone_number),
    'address' => strlen($address) < 10,
    'payment_method' => !in_array($payment_method, ['at_delivery']),
];

$address_zip_parts = explode('-', $address_zip);

$errors['address_zip'] = count($address_zip_parts) !== 2 || !is_numeric($address_zip_parts[0]) || !is_numeric($address_zip_parts[1]) || strlen($address_zip_parts[0]) !== 4 || strlen($address_zip_parts[1]) !== 3;

$errors = array_filter($errors);

$_SESSION['checkout_errors'] = array_keys($errors);

if (!empty($errors)) {
    header('Location: /checkout');
    exit();
}

$cartLines = json_encode($cartLines);

$productIds = array_map(function ($line) {
    return $line['product_id'];
}, $cart['lines'] ?? []);

$productIds = implode(", ", $productIds);
$result = mysqli_query($dbc, "SELECT * FROM catalog WHERE id IN ($productIds)");
$products = [];

while ($row = mysqli_fetch_assoc($result)) {
    $products[$row['id']] = $row;
}

$cartTotal = 0;
foreach ($cart['lines'] as $line) {
    $id = $line['product_id'];
    $cartTotal += ((float) $products[$id]['price']) * ((int) $line['quantity']);
}

$userId = $_SESSION['user_id'] ?? 'NULL';

$query = "INSERT INTO `order`(`user_id`, `name`, `email`, `phone_number`, `address`, `address_zip`, `payment_method`, `lines`, `total`) VALUES ($userId, '$name', '$email', '$phone_number', '$address', '$address_zip', '$payment_method', '$cartLines', '$cartTotal')";

// var_dump($query);exit();
$result = mysqli_query($dbc, $query);

if ($result) {
	$_SESSION['cart'] = null;
    header('Location: /');
} else {
    exit('unable to create order');
}
