<?php
session_start();
	if($_SESSION['user_name']==null){
		header("Location: index.html");
	}else{
		
	}
	
  include_once '/var/www/html/snmp/db_functions.php';
  $db = new DB_Functions();
  $id = $_POST['no'];
  $network = $_POST['network'];
  $netmask = $_POST['netmask'];
  $community = $_POST['community'];
  $db->updateNetworkByID($id,$network,$netmask,$community);
  header("Location: network.php");
	
?>