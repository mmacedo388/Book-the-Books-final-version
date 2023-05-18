<?php

require '../common.php';

$id = isset($_POST['id']) ? $_POST['id'] : '';

$result = mysqli_query($dbc, "SELECT id FROM `sub_category` WHERE id = '$id'");

if (!$result || $result->num_rows === 0) {
    header('Location: /admin/sub-categories');
    exit();
}

$query = "DELETE FROM `sub_category` WHERE id = '$id'";

$result = mysqli_query($dbc, $query);

if ($result === true) {
    header('Location: /admin/sub-categories');
} else {
    exit('unable to delete sub category');
}
