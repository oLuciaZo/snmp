<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once './db_functions.php';
$db = new DB_Functions();
if(isset($_GET['status'])){
	$status = $_GET['status'];
}else{
	$status = 1;
}

if($status==1){
	$result = $db->gethistorytable();
}else if($status==2){
	$begin = $_GET['begin'];
	$end   = $_GET['end'];
	$result = $db->gethistorytablebydate($begin,$end);
}else if($status==3){
	$begin = $_GET['begin'];
	$end   = $_GET['end'];
	$device = $_GET['device'];
	$result = $db->gethistorytablebydateanddevice($begin,$end,$device);
}

$count=0;
$outp = '{ "success": true,"history_table" : ';
    $outp .= '[';
while ($row = mysql_fetch_row($result)){

/*
	$outp .= '{"hostname['.$count.']":"'  . $row["1"] . '",';
    $outp .= '"macaddr['.$count.']":"'   . $row["2"]        . '",';
    $outp .= '"ip['.$count.']":"'   . $row["3"]        . '",';
    $outp .= '"flag['.$count.']":"'. $row["4"]     . '"}'; 
    */
    
    $outp .= '{"hostname":"'  . $row["0"] . '",';
    $outp .= '"macaddr":"'. $row["1"]     . '",'; 
    $outp .= '"location":"'. $row["2"]     . '",'; 
	$outp .= '"downtime":"'. $row["3"]     . '"},'; 
	
}
	$outp = substr($outp, 0,-1);
	$outp .="]";
	$outp .="}";
print $outp;



?>