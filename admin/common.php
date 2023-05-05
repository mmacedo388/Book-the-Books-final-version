
<?php

require dirname(__DIR__) .'/connection.php';

session_start();

if (!$_SESSION['user_admin']) {
    header('Location: /');
    exit();
}
