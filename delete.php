<?php
include_once '/var/www/html/snmp/db_functions.php';
  $db = new DB_Functions();
  print $macaddr = $_GET['macaddr'];
  $sql = "DELETE FROM snmp_monitor, snmp_location USING snmp_monitor, snmp_location WHERE snmp_monitor.mon_macaddr = '".$macaddr."' AND snmp_location.location_macaddr = '".$macaddr."'";
  $db->deletedevice($sql);
//print $sql;
  
	header("Location: location.php");
	
?>