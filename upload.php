<?php
include ('connection.php');
session_start();
if($_SESSION){
$user_id = $_SESSION['user_id'];
}
else{
	$user_id = "";
}

$name = $_POST['name'];
$price = $_POST['price'];
$desc = $_POST['desc'];


//upload start
 if(isset($_FILES['pic']))
 {
    $ext = strtolower(substr($_FILES['pic']['name'],-4)); //Pegando extensão do arquivo
    $new_name = date("Y.m.d-H.i.s").$ext; //Definindo um novo nome para o arquivo
    $dir = "C:/xampp/htdocs/site/images/"; //Diretório para uploads 
    move_uploaded_file($_FILES['pic']['tmp_name'], $dir.$new_name); //Fazer upload do arquivo
    echo("Imagen enviada com sucesso!");
    $dir_name = $new_name;
 }
 //upload finish
 if($name && $price && $desc && $dir_name){

   mysqli_query( $dbc, "INSERT INTO catalog (`name`, `price`, `desc`, `img`, `quantity`) VALUES ('$name','$price','$desc','$dir_name', '1');");
   header("Location: catalog.php");

 }else{
  
   header("Location: products_admin.php");

 }

 

 

?>
