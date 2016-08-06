<?php
include_once '/var/www/html/snmp/db_functions.php';
 $user = $_POST['user'];
 $pass = $_POST['pass'];
 $role = $_POST['role'];
 $name = $_POST['name'];
 $lastname = $_POST['lastname'];
 $position = $_POST['position'];
 $sex = $_POST['sex'];
 $age = $_POST['age'];
 $email = $_POST['email'];
  $db = new DB_Functions();
  $db->addUser($user,md5($pass), $role, $name, $lastname, $position, $sex, $age, $email);
  //$sql = "INSERT INTO snmp_user(`user_name`, `user_pass`, `user_flag`) VALUES ('".$user."','".$pass."','".$role."')";
  //print $sql;

	header("Location: user.php");

?>
