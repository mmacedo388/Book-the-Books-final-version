<?php

require '../common.php';

$id = isset($_POST['id']) ? $_POST['id'] : '';

$result = mysqli_query($dbc, "SELECT id FROM `catalog` WHERE id = '$id'");

if (!$result || $result->num_rows === 0) {
    header('Location: /admin/products');
    exit();
}

$query = "DELETE FROM `catalog` WHERE id = '$id'";

$result = mysqli_query($dbc, $query);

if ($result === true) {
    header('Location: /admin/products');
} else {
    exit('unable to delete product');
}
