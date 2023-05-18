<?php

require '../common.php';

// obter os dados enviados a partir do formulario
$id = isset($_POST['id']) ? $_POST['id'] : '';

if ($id) {
    $result = mysqli_query($dbc, "SELECT id FROM `sub_category` WHERE id = '$id'");

    if (!$result || $result->num_rows === 0) {
        header('Location: /admin/sub-categories');
        exit();
    }
}

$name = isset($_POST['name']) ? $_POST['name'] : '';
$category_id = isset($_POST['category_id']) ? $_POST['category_id'] : '';

// sanitize/validate
$name = trim(strip_tags(filter_var($name, FILTER_SANITIZE_ADD_SLASHES)));
$category_id = trim(strip_tags(filter_var($category_id, FILTER_SANITIZE_ADD_SLASHES)));

$errors = array_filter([
    'name' => !strlen($name),
    'category_id' => !is_numeric($category_id),
]);

$errors = array_filter($errors);

$sessionKeyPrefix = $id ? "sub_category_{$id}_form" : 'create_sub_category_form';
$_SESSION[$sessionKeyPrefix.'_errors'] = array_keys($errors);
$_SESSION[$sessionKeyPrefix.'_values'] = compact('name');

if (!empty($errors)) {
    $page = addslashes($_POST['page'] ?? '');

    if (substr($page, 0, 1) === '/') {
        header("Location: $page");
    } else {
        header('Location: /admin/sub-categories/edit.php?id=' . $id);
    }

    exit();
}

$_SESSION[$sessionKeyPrefix.'_errors'] = [];
$_SESSION[$sessionKeyPrefix.'_values'] = [];

if ($id) {
    $values = "`name` = '$name', `category_id` = '$category_id'";
    $query = "UPDATE sub_category SET $values WHERE id = '$id'";
} else {
    $query = "INSERT INTO sub_category (`name`, `category_id`) VALUES ('$name', '$category_id')";
}

$result = mysqli_query($dbc, $query);

if ($result === true) {
    header('Location: /admin/sub-categories');
} else {
    exit('unable to save sub category');
}
