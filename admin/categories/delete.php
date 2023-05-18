<?php

require '../common.php';

$id = isset($_POST['id']) ? $_POST['id'] : '';

$result = mysqli_query($dbc, "SELECT id FROM `category` WHERE id = '$id'");

if (!$result || $result->num_rows === 0) {
    header('Location: /admin/categories');
    exit();
}

$query = "DELETE FROM `category` WHERE id = '$id'";

$result = mysqli_query($dbc, $query);

if ($result === true) {
    header('Location: /admin/categories');
} else {
    exit('unable to delete category');
}
