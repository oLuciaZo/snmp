<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once './db_functions.php';
$db = new DB_Functions();
$status = $_GET['status'];
if($status==1){
	$result = $db->gethistory();
}else if($status==2){
	$begin = $_GET['begin'];
	$end   = $_GET['end'];
	//print $sql = "SELECT count(`history_hostname`), DATE_FORMAT(`history_end`,'%b %d %Y') FROM `snmp_history` WHERE date(`history_end`) BETWEEN '$begin' AND '$end' GROUP BY EXTRACT(DAY FROM `history_end`)";
	$result = $db->gethistorybydate($begin,$end);
}else if($status==3){
	$begin = $_GET['begin'];
	$end   = $_GET['end'];
	$device = $_GET['device'];
	//print $sql = "";
	/*print $sql = "SELECT count(`history_hostname`) as qty, DATE_FORMAT(`history_end`,'%b %d %Y') as day FROM `snmp_history` WHERE date(`history_end`) 
 	BETWEEN '$begin' AND '$end' AND history_hostname = '$device'
	GROUP BY EXTRACT(DAY FROM `history_end`)";*/
	$result = $db->gethistorybydateanddevice($begin,$end,$device);
	
}

$count=0;
$outp = '{ "success": true,"history" : ';
    $outp .= '[';
while ($row = mysql_fetch_row($result)){

/*
	$outp .= '{"hostname['.$count.']":"'  . $row["1"] . '",';
    $outp .= '"macaddr['.$count.']":"'   . $row["2"]        . '",';
    $outp .= '"ip['.$count.']":"'   . $row["3"]        . '",';
    $outp .= '"flag['.$count.']":"'. $row["4"]     . '"}'; 
    */
    
    $outp .= '{"qty":"'  . $row["0"] . '",';
    $outp .= '"day":"'. $row["1"]     . '"},'; 
	
}
	$outp = substr($outp, 0,-1);
	$outp .="]";
	$outp .="}";
print $outp;



?>