<?php
session_start();
print $_POST["a"];
print $_POST["b"];

if (isset($_POST["a"]) || isset($_POST["b"])) {
    $email = $_POST["a"];
    $password = $_POST["b"];
    // Store user details in db
    include_once './db_functions.php';
    //include_once './GCM.php';
    $db = new DB_Functions();
    //$gcm = new GCM();

	$res = $db->getUser($email,$password);
	$data = mysql_fetch_array($res);
	//print $data['user_name'];
	if($data['user_name']!=null){
	//$_SESSION['mac'] = $data['gcm_mac_address'];
	$_SESSION['user_name'] = $data['user_name'];
	$_SESSION['user_pass'] = $data['user_pass'];
	$_SESSION['user_flag'] = $data['user_flag'];
	header("Location: monitor.php");
	}else{
		header("Location: index.html");
	}
/*
    $res = $db->storeUser($name, $password, $email, $gcm_regid, $gcm_mac_address);

    $registatoin_ids = array($gcm_regid);
    //$message = array("product" => "shirt");
	$message = "Username : ".$name." Password : ".$password." has been registeration";

    $result = $gcm->send_notification($registatoin_ids, $message);

    echo $result;*/
} else {
	print "nothing";
}


?>