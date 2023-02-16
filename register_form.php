<?php
global $_SESSION;

if($_SESSION){
    
    $user_name = $_SESSION['user_name'];
}


?>
<form method="post" action="register_script.php">
<p>Name: <input type="text" name="user" maxlength="50"></p>
<p>Email: <input type="email" name="email" maxlength="50"></p>
<p>Password: <input type="password" name="password" maxlength="50"></p>
<input type="submit" value="Submit" />
</form>
