<?php

require 'common.php';

$id = isset($_GET['id']) ? $_GET['id'] : '';

$result = mysqli_query($dbc, "SELECT id FROM `catalog` WHERE id = '$id'");

if (!$result || $result->num_rows === 0) {
    header('Location: /admin/products.php');
    exit();
}

// obter os dados enviados a partir do formulario
$name = isset($_POST['name']) ? $_POST['name'] : '';
$category = isset($_POST['category']) ? $_POST['category'] : '';
$sub_category = isset($_POST['sub_category']) ? $_POST['sub_category'] : '';
$price = isset($_POST['price']) ? $_POST['price'] : '';
$description = isset($_POST['description']) ? $_POST['description'] : '';

// sanitize/validate
$name = trim(strip_tags(filter_var($name, FILTER_SANITIZE_ADD_SLASHES)));
$category = trim(strip_tags(filter_var($category, FILTER_SANITIZE_ADD_SLASHES)));
$sub_category = trim(strip_tags(filter_var($sub_category, FILTER_SANITIZE_ADD_SLASHES)));
$price = trim(strip_tags(filter_var($price, FILTER_SANITIZE_ADD_SLASHES)));
$description = trim(strip_tags(filter_var($description, FILTER_SANITIZE_ADD_SLASHES)));

$_SESSION["product_{$id}_form_values"] = compact('name', 'category', 'sub_category', 'price', 'description');

$errors = array_filter([
    'name' => !strlen($name),
    'category' => !strlen($category),
    'sub_category' => !strlen($sub_category),
    'price' => !strlen($price) || !is_numeric($price) || !$price,
    'description' => !strlen($description),
]);

$errors = array_filter($errors);
$_SESSION["product_{$id}_errors"] = array_keys($errors);

if (!empty($errors)) {
    header('Location: /admin/product-edit.php?id=' . $id);
    exit();
}

$has_image = false;

//upload start
if ($_FILES['image']['name'] ?? '') {
    $ext = strtolower(substr($_FILES['image']['name'], -4)); //Pegando extensão do arquivo
    $new_name = date("Y.m.d-H.i.s").$ext; //Definindo um novo nome para o arquivo
    $dir = dirname(__DIR__) .'/images/'; //Diretório para uploads

    if (move_uploaded_file($_FILES['image']['tmp_name'], $dir.$new_name)) { //Fazer upload do arquivo
        $has_image = true;
    }
}

$values = '';
$values .= "`name` = '$name',";
$values .= "`category` = '$category',";
$values .= "`sub_category` = '$sub_category',";
$values .= "`price` = '$price',";
$values .= "`description` = '$description'";

if ($has_image) {
    $values .= ", `img` = '$new_name'";
}

$query = "UPDATE catalog SET $values WHERE id = '$id'";
$result = mysqli_query($dbc, $query);

if ($result === true) {
    header('Location: /admin/products.php');
} else {
    exit('unable to update product');
}
