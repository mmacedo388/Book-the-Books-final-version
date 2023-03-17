<?php

include('../connection.php');

if (!isset($_POST['email'], $_POST['password'])) {
    exit('invalid data');
}

//Escapar de caracteres especiais, como aspas, prevenindo SQL injection
$email = mysqli_real_escape_string($dbc, $_POST['email']);
$password = mysqli_real_escape_string($dbc, $_POST['password']);

//Buscar na tabela usuario o usuário que corresponde com os dados digitado no formulário
$result = mysqli_query($dbc, "SELECT * FROM user WHERE email = '$email' LIMIT 1");

if ($result && $result->num_rows === 0) {
    header('Location: /login?error');
    exit();
}

$user = mysqli_fetch_assoc($result);

if (isset($user) && password_verify($password, $user['password']) === true) {
    session_start();

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = $user['user'];
    $_SESSION['user_email'] = $user['email'];
    $_SESSION['user_admin'] = $user['admin'];

    header("Location: /");
} else {
    header('Location: /login?error');
    exit();
}
