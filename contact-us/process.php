<?php

require '../connection.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: /contact-us');
    exit();
}

//processing form
$user_name = isset($_POST['user_name']) ? $_POST['user_name'] : '';
$user_email = isset($_POST['user_email']) ? $_POST['user_email'] : '';
$user_gender = isset($_POST['user_gender']) ? $_POST['user_gender'] : '';
$user_age = isset($_POST['user_age']) ? $_POST['user_age'] : '';
$user_message = isset($_POST['user_message']) ? $_POST['user_message'] : '';

// sanitize/validate
$user_name = trim(strip_tags(filter_var($user_name, FILTER_SANITIZE_ADD_SLASHES)));
$user_email = trim(strip_tags(filter_var($user_email, FILTER_SANITIZE_EMAIL)));
$user_gender = trim(strip_tags(filter_var($user_gender, FILTER_SANITIZE_ADD_SLASHES)));
$user_age = trim(strip_tags(filter_var($user_age, FILTER_SANITIZE_ADD_SLASHES)));
$user_message = trim(strip_tags(filter_var($user_message, FILTER_SANITIZE_ADD_SLASHES)));

$errors = array_filter([
    'user_name' => !strlen($user_name),
    'user_email' => !filter_var($user_email, FILTER_VALIDATE_EMAIL),
    'user_gender' => !in_array($user_gender, ['M', 'F', 'NB']),
    'user_age' => !in_array($user_age, ['0-29', '30-60', '60+']),
    'user_message' => !strlen($user_message),
]);

$errors = array_filter($errors);


if (!empty($errors)) {

    $_SESSION['contact_us_form_errors'] = array_keys($errors);
    $_SESSION['contact_us_form_values'] = compact('user_name', 'user_email', 'user_gender', 'user_age', 'user_message');

    header('Location: /contact-us');
    exit();
}

$result = mysqli_query($dbc, "INSERT INTO form(name, email, gender, age, message) VALUES('$user_name', '$user_email', '$user_gender', '$user_age', '$user_message') ");

if ($result === true) {
    $_SESSION['contact_us_form_success'] = true;
}

header('Location: /contact-us');
