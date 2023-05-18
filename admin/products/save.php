<?php

require '../common.php';

// obter os dados enviados a partir do formulario
$id = isset($_POST['id']) ? $_POST['id'] : '';

if ($id) {
    $result = mysqli_query($dbc, "SELECT id FROM `catalog` WHERE id = '$id'");

    if (!$result || $result->num_rows === 0) {
        header('Location: /admin/products');
        exit();
    }
}

$name = isset($_POST['name']) ? $_POST['name'] : '';
$sub_category_id = isset($_POST['sub_category_id']) ? $_POST['sub_category_id'] : '';
$price = isset($_POST['price']) ? $_POST['price'] : '';
$description = isset($_POST['description']) ? $_POST['description'] : '';

// sanitize/validate
$name = trim(strip_tags(filter_var($name, FILTER_SANITIZE_ADD_SLASHES)));
$sub_category_id = trim(strip_tags(filter_var($sub_category_id, FILTER_SANITIZE_ADD_SLASHES)));
$price = trim(strip_tags(filter_var($price, FILTER_SANITIZE_ADD_SLASHES)));
$description = trim(strip_tags(filter_var($description, FILTER_SANITIZE_ADD_SLASHES)));

$categoryResult = $sub_category_id ? mysqli_query($dbc, "SELECT category_id FROM sub_category WHERE id = '$sub_category_id'") : false;

$errors = array_filter([
    'name' => !strlen($name),
    'sub_category_id' => !$sub_category_id || !is_numeric($sub_category_id) || !$categoryResult || $categoryResult->num_rows === 0,
    'price' => !strlen($price) || !is_numeric($price) || !$price,
    'description' => !strlen($description),
]);

$errors = array_filter($errors);

$sessionKeyPrefix = $id ? "product_{$id}_form" : 'create_product_form';
$_SESSION[$sessionKeyPrefix.'_errors'] = array_keys($errors);
$_SESSION[$sessionKeyPrefix.'_values'] = compact('name', 'sub_category_id', 'price', 'description');

if (!empty($errors)) {
    $page = addslashes($_POST['page'] ?? '');

    if (substr($page, 0, 1) === '/') {
        header("Location: $page");
    } else {
        header('Location: /admin/products/edit.php?id=' . $id);
    }

    exit();
}

$_SESSION[$sessionKeyPrefix.'_errors'] = [];
$_SESSION[$sessionKeyPrefix.'_values'] = [];

//upload start
if ($_FILES['image']['name'] ?? '') {
    $ext = strtolower(substr($_FILES['image']['name'], -4)); //Pegando extensão do arquivo
    $imageFileName = date("Y.m.d-H.i.s").$ext; //Definindo um novo nome para o arquivo
    $dir = dirname(__DIR__) .'/../images/'; //Diretório para uploads

    if (!move_uploaded_file($_FILES['image']['tmp_name'], $dir.$imageFileName)) { //Fazer upload do arquivo
        $imageFileName = null;
    }
}

$categoryRow = mysqli_fetch_assoc($categoryResult);
$category_id = $categoryRow['category_id'] ?? null;

if ($id) {

    $values = '';
    $values .= "`name` = '$name',";
    $values .= "`category_id` = '$category_id',";
    $values .= "`sub_category_id` = '$sub_category_id',";
    $values .= "`price` = '$price',";
    $values .= "`description` = '$description'";

    if (isset($imageFileName)) {
        $values .= ", `img` = '$imageFileName'";
    }

    $query = "UPDATE catalog SET $values WHERE id = '$id'";

} else {
    $imageFileName = $imageFileName ?? 'NULL';

    $query = "INSERT INTO catalog (`name`, `category_id`, `sub_category_id`, `price`, `description`, `img`) VALUES ('$name', '$category_id', '$sub_category_id', '$price', '$description', '$imageFileName')";
}

$result = mysqli_query($dbc, $query);

if ($result === true) {
    header('Location: /admin/products');
} else {
    exit('unable to save product');
}
