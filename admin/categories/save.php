<?php

require '../common.php';

// obter os dados enviados a partir do formulario
$id = isset($_POST['id']) ? $_POST['id'] : '';

if ($id) {
    $result = mysqli_query($dbc, "SELECT id FROM `category` WHERE id = '$id'");

    if (!$result || $result->num_rows === 0) {
        header('Location: /admin/categories');
        exit();
    }
}

$name = isset($_POST['name']) ? $_POST['name'] : '';

// sanitize/validate
$name = trim(strip_tags(filter_var($name, FILTER_SANITIZE_ADD_SLASHES)));

$errors = array_filter([
    'name' => !strlen($name),
]);

$errors = array_filter($errors);

$sessionKeyPrefix = $id ? "category_{$id}_form" : 'create_category_form';
$_SESSION[$sessionKeyPrefix.'_errors'] = array_keys($errors);
$_SESSION[$sessionKeyPrefix.'_values'] = compact('name');

if (!empty($errors)) {
    $page = addslashes($_POST['page'] ?? '');

    if (substr($page, 0, 1) === '/') {
        header("Location: $page");
    } else {
        header('Location: /admin/categories/edit.php?id=' . $id);
    }

    exit();
}

if ($id) {
    $values = "`name` = '$name'";
    $query = "UPDATE category SET $values WHERE id = '$id'";
} else {
    $query = "INSERT INTO category (`name`) VALUES ('$name')";
}

$result = mysqli_query($dbc, $query);

if ($result === true) {
    header('Location: /admin/categories');
} else {
    exit('unable to save category');
}
