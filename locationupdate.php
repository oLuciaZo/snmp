<?php
include_once '/var/www/html/snmp/db_functions.php';
  $db = new DB_Functions();
print $count = $_POST['count'];
print "<br>";

for($i=1; $i<=$count; $i++){
	$location = $_POST['location'.$i];
	$macaddr = $_POST['macaddr'.$i];
	$desc = $_POST['desc'.$i];
	$serial = $_POST['serial'.$i];
	$model = $_POST['model'.$i];
	$brand = $_POST['brand'.$i];
	$type = $_POST['type'.$i];
	$license = $_POST['license'.$i];
	$list = $_POST['list'.$i];
  //$repair = $_POST['repair'.$i];
  if(isset($_POST['repair'.$i])){
    $repair = $_POST['repair'.$i];
  }else{
    $repair = 1;
  }
	$sql = "SELECT * FROM snmp_location WHERE location_macaddr = '".$macaddr."'";
	$row = $db->getlocationwhere($sql);
	//print $row;
	//$sql .= " location_name = '".$location."' WHERE location_macaddr = '".$macaddr."' ,";
	//$sql .= "WHEN location_macaddr = '".$macaddr."' THEN '".$location."' ";
	if($row!=""){
		print $sql = "UPDATE snmp_location SET location_name = '".$location."',location_desc = '".$desc."',location_serial = '".$serial."',location_brand = '".$brand."',location_model = '".$model."',location_type = '".$type."', location_license = '".$license."', location_list = '".$list."', location_flag = '".$repair."' WHERE location_macaddr = '".$macaddr."' ";
	}else{
		$sql = "INSERT INTO snmp_location (`location_name`,`location_macaddr`,`location_desc`,`location_serial`,`location_brand`,`location_model`,`location_type`,`location_license`,`location_list`) VALUES ('".$location."','".$macaddr."','".$desc."','".$serial."','".$model."','".$brand."','".$type."','".$license."','".$list."')";
	}
	//$sql = "UPDATE snmp_location SET location_name = '".$location."' WHERE location_macaddr = '".$macaddr."' ";
	//$sql = "INSERT INTO snmp_location (`location_name`,`location_macaddr`) VALUES ('".$location."','".$macaddr."') ON DUPLICATE KEY UPDATE location_name='".$location."', location_macaddr='".$macaddr."'";
	$db->updatelocation($sql);
	print $sql."<BR>";
}
//$sql .= "ELSE location_name END";
//$sql = substr($sql,0,-1);
print $sql;


	header("Location: location.php");

?>
