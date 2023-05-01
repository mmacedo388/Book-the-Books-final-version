
<?php

require '../connection.php';

session_start();

if (!$_SESSION['user_admin']) {
	header('Location: /');
	exit();
}
