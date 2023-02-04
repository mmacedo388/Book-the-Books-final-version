<?php
if($_SESSION){
    $user_admin = $_SESSION['user_admin'];
    $user_name = $_SESSION['user_name'];
    if($user_admin != "1"){
    header('Location: index.php');
    }
}
else{

	$user_name = "";
	$user_admin = "";
}
?>
    <form method="post" enctype="multipart/form-data" action="upload.php">
    <input name="pic" type="file" />
    <p>Name</p>
    <input name="name" type="text" placeholder="Please insert a book name">
    <p>Price</p>
    <input name="price" type="text" placeholder="Please insert a book price">
    <p>Description</p>
    <input name="desc" type="text" placeholder="Please insert a book description">
    <input type="submit" value="Save">  
    </form>

