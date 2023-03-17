<?php

include('../connection.php');

// obter os dados enviados a partir do formulario
$user = isset($_POST['user']) ? $_POST['user'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

// sanitize/validate
$user = trim(strip_tags(filter_var($user, FILTER_SANITIZE_ADD_SLASHES)));
$email = trim(strip_tags(filter_var($email, FILTER_SANITIZE_EMAIL)));
$password = trim(strip_tags(filter_var($password, FILTER_SANITIZE_ADD_SLASHES)));

$errors = array_filter([
    'user' => !strlen($user),
    'password' => !strlen($password),
    'email' => !filter_var($email, FILTER_VALIDATE_EMAIL),
]);

if (!empty($errors)) {
    header('Location: /register?errors=' . implode(',', array_keys(array_filter($errors))));
    exit();
}

$result = mysqli_query($dbc, "SELECT id FROM user WHERE email = '$email'");

if ($result && $result->num_rows > 0) {
    // abortar/redirectionar
    exit('sorry, user already exists');
}

// criar registo na base dados
$password = password_hash($password, PASSWORD_BCRYPT);
$result = mysqli_query($dbc, "INSERT INTO user(user, email, password) VALUES('$user', '$email', '$password')");

if ($result === true) {
    // redirecionar para homepage
    header('Location: /login');
} else {
    exit('unable to create user');
}
