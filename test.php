<?php

snmp("192.168.1.1","public");
function snmp($ip, $community){
	//print $ip;
		 $sysname = snmp2_get($ip, $community, "SNMPv2-MIB::sysName.0", 10000 ,5);
		print $sysname = str_replace("STRING: ","",$sysname);
		 $macaddr = snmp2_walk($ip, $community, "IF-MIB::ifPhysAddress", 100000 ,5);
		print $macaddr = str_replace("STRING: ","",$macaddr[5]);
		
	}
?>