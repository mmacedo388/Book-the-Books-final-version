<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$user_name = $_POST['user_name'];
	$user_email = $_POST['user_email'];
	$user_gender = $_POST['user_gender'];
	$user_age = $_POST['user_age'];
	$user_message = $_POST['user_message'];

	$name = filter_var($_POST['user_name'], FILTER_SANITIZE_STRING);
	$email = filter_var($_POST['user_email'], FILTER_SANITIZE_EMAIL);
	$message = filter_var($_POST['user_message'], FILTER_SANITIZE_STRING);

	if (empty($name)){
		die("Please enter your name!");
	}
	if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
		die("Please enter valid email address!");
	}
		
	if (empty($age)){
		die("Please choose your age!");
	}

	if (empty($message)){
		die("Please enter text!");
	}	
	}
?>