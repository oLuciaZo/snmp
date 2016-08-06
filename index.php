<?php

include_once './db_functions.php';
//$community = "public";
$db = new DB_Functions();
$res = $db->getNetwork();

//$data = mysql_fetch_array($res);
while($data = mysql_fetch_row($res)){
	print $data[1]."/".$data[2];
	$address = findip($data[1],$data[2]);
	foreach($address as $ip){
	snmp($ip, $data[3]);
	print "<br>";
	}
}



function snmp($ip, $community){
	print $ip;
		 $sysname = snmp2_get($ip, $community, "SNMPv2-MIB::sysName.0", 10000 ,5);
		print $sysname = str_replace("STRING: ","",$sysname);
		 $macaddr = snmp2_walk($ip, $community, "IF-MIB::ifPhysAddress", 10000 ,5);
		print $macaddr = str_replace("STRING: ","",$macaddr[4]);
		if($sysname!=null){
			//print "1";
			snmpup($ip, $macaddr, $sysname);
		}else{
			//print "2";
			snmpdown($ip);
		}
	}

function snmpup($ip, $macaddr, $sysname){
	$db = new DB_Functions();
	$res = $db->checkup($ip, $macaddr, $sysname);
	$chk = mysql_fetch_array($res);
	if($chk['mon_flag']==null){
		print "INSERT";
		//print $sql = "INSERT INTO `snmp_monitor`(`mon_hostname`, `mon_macaddr`, `mon_ip`) VALUES ('$sysname','$macaddr','$ip')";
		$db->insertup_monitor($ip, $macaddr, $sysname);
	}else if($chk['mon_flag']==0){
		$db->updateup_monitor($ip, $macaddr, $sysname);
		print "UPDATE";
	}
}

function snmpdown($ip){
	$db = new DB_Functions();
	echo $ip;
	$res = $db->checkdown($ip);
	//print "4";
	$chk = mysql_fetch_array($res);
	//print "5";
	if($chk['history_ip']==null){
		
		$db->updatedown_monitor($ip);
		$db->insertup_history($ip);
	}
}




function findip($ip,$subnet){
	$mask = 32-$subnet;
	$iparray = explode('.',$ip);
	$bin = mask2bit($mask);
	$host = bindec($bin);
	$c=1;
	for($i=1; $i<$host; $i++){
		$address[$i] = $iparray[0].".".$iparray[1].".".$iparray[2].".".$c;
		$c = $c+1;
		if(($i%255)==0){
			$c=1;
			$iparray[2] += 1;
			$i++;
		}
		
	}
	return $address;
}

function mask2bit($mask){
	$bin=0;
	for($i=0; $i<$mask; $i++){
		$bin .= "1";
	}
	return $bin;
}


?>