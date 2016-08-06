<?php
session_start();
	if($_SESSION['user_name']==null){
		header("Location: index.html");
	}else{

	}

  include_once '/var/www/html/snmp/db_functions.php';
  $db = new DB_Functions();
  $id = $_POST['no'];
	$user = $_POST['user'];
  $pass = $_POST['pass'];
  $role = $_POST['role'];
  $name = $_POST['name'];
  $lastname = $_POST['lastname'];
  $position = $_POST['position'];
  $sex = $_POST['sex'];
  $age = $_POST['age'];
  $email = $_POST['email'];
  $db->updateUserByID($id,$user,md5($pass), $role, $name, $lastname, $position, $sex, $age, $email);
  header("Location: user.php");

?>
