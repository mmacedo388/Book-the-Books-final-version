<?php

include ('connection.php');
if((isset($_POST['login_email'])) && (isset($_POST['login_password']))){
    $login_email = mysqli_real_escape_string($dbc, $_POST['login_email']); 
    //Escapar de caracteres especiais, como aspas, prevenindo SQL injection
    $login_password = mysqli_real_escape_string($dbc, $_POST['login_password']);
    //Buscar na tabela usuario o usuário que corresponde com os dados digitado no formulário
    $result_user = "SELECT * FROM user WHERE email = '$login_email' && password = '$login_password' LIMIT 1";
    $result_converted = mysqli_query($dbc,  $result_user);
    $final_result = mysqli_fetch_assoc($result_converted);

if(isset($final_result)){

    session_start();

    $_SESSION['user_id'] = $final_result['id'];
    $_SESSION['user_name'] = $final_result['user'];
    $_SESSION['user_email'] = $final_result['email'];
    $_SESSION['user_admin'] = $final_result['admin'];
    
    header("Location: index.php");
}

else{
    //Váriavel global recebendo a mensagem de erro
    $_SESSION['error_login'] = "Utilizador ou senha Inválido";
    header("Location: login.php");
}

}
?>
