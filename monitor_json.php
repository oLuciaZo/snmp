<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once './db_functions.php';
$db = new DB_Functions();
$result = $db->getAllDevices();
$count=0;
$outp = '{ "success": true,"monitor" : ';
    $outp .= '[';
while ($row = mysql_fetch_row($result)){

/*
	$outp .= '{"hostname['.$count.']":"'  . $row["1"] . '",';
    $outp .= '"macaddr['.$count.']":"'   . $row["2"]        . '",';
    $outp .= '"ip['.$count.']":"'   . $row["3"]        . '",';
    $outp .= '"flag['.$count.']":"'. $row["4"]     . '"}';
    */

    $outp .= '{"hostname":"'  . $row["1"] . '",';
    $outp .= '"macaddr":"'   . $row["2"]        . '",';
    $outp .= '"ip":"'   . $row["3"]        . '",';
    $outp .= '"flag":"'. $row["4"]     . '",';
	$outp .= '"location":"'. $row["6"]     . '",';
	$outp .= '"desc":"'. $row["8"]     . '",';
	$outp .= '"serial":"'. $row["9"]     . '",';
  $outp .= '"location_flag":"'. $row["15"]     . '"},';

}
	$outp = substr($outp, 0,-1);
	$outp .="]";
	$outp .="}";
print $outp;



?>
