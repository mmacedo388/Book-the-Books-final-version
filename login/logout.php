<?php
    session_start();
    unset(
        $_SESSION['user_id'],
        $_SESSION['user_name'],
        $_SESSION['user_email'],
        $_SESSION['user_admin']

    );
    //redirecionar o utlizador para a página de login
    header("Location: index.php");
?>