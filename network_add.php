<?php
session_start();
	if($_SESSION['user_name']==null){
		header("Location: index.html");
	}else{
		
	}
	
  include_once '/var/www/html/snmp/db_functions.php';
  $db = new DB_Functions();
  
  $network = $_POST['network'];
  $netmask = $_POST['netmask'];
  $community = $_POST['community'];
  print "INSERT INTO `snmp_network`( `network_range`, `network_mask`, `network_community`) VALUES ('".$network."','".$netmask."','".$community."')";
  $db->addNetwork($network,$netmask,$community);
  header("Location: network.php");
	
?>