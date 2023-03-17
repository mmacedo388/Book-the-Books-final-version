<?php

global $_SESSION;

if ($_SESSION) {
    $user_name = $_SESSION['user_name'];
}

$errors = $_GET['errors'] ?? '';
$errors = explode(',', $errors);
?>
<form method="post" action="/register/process.php">
    <div class="form-row">
        Name: <input type="text" required name="user" maxlength="50">

        <?php if (in_array('user', $errors)): ?>
        <div class="error-msg">Invalid Name</div>
        <?php endif ?>
    </div>
    <div class="form-row">
        Email: <input type="email" required name="email" maxlength="50">

        <?php if (in_array('email', $errors)): ?>
        <div class="error-msg">Invalid Email</div>
        <?php endif ?>
</div>
    <div class="form-row">
        Password: <input type="password" required name="password" maxlength="50">

        <?php if (in_array('password', $errors)): ?>
        <div class="error-msg">Invalid Password</div>
        <?php endif ?>
</div>
    <input type="submit" value="Submit" />
</form>