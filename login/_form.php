<?php
global $_SESSION;

if ($_SESSION) {
    $user_name = $_SESSION['user_name'];
}


?>
<form method="post" action="/login/process.php">
<?php if (!$user_name) { ?>
<h3>Please login</h3>
<?php } ?>
<p>Email: <input type="email" required name="email" maxlength="50"></p>
<p>Password: <input type="password" required name="password" maxlength="50"></p>
<input type="submit" value="Submit" />
</form>