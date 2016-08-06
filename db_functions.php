<?php

class DB_Functions {

    private $db;

    //put your code here
    // constructor
    function __construct() {
        include_once '/var/www/html/snmp/db_connect.php';
        // connecting to database
        $this->db = new DB_Connect();
        $this->db->connect();
    }

    // destructor
    function __destruct() {

    }

	public function getUser($username,$password){
		$password = md5($password);
		$result = mysql_query("SELECT * FROM snmp_user WHERE user_name = '$username' AND user_pass = '$password'");
		return $result;
	}

	public function getUserEdit(){
		//$password = md5($password);
		$result = mysql_query("SELECT * FROM snmp_user ");
		return $result;
	}

	public function getUserEditByID($id){
		//$password = md5($password);
		$result = mysql_query("SELECT * FROM snmp_user WHERE user_no = '$id' ");
		return $result;
	}

	public function deleteUserByID($id){
		$result = mysql_query("DELETE FROM `snmp_user` WHERE user_no='$id'");
	}

	public function updateUserByID($id,$user,$pass, $role, $name, $lastname, $position, $sex, $age, $email){
		//$pass = md5($pass);
		$result = mysql_query("UPDATE `snmp_user` SET `user_name`='$user', `user_pass`='$pass',
      `name`='$name', `lastname`='$lastname',`position`='$position', `sex`='$sex', `age`='$age', `email`='$email' WHERE `user_no`='$id'");
		return $result;
	}

    public function getNetwork(){
		$result = mysql_query("SELECT * FROM snmp_network");
		return $result;
	}
    /**
     * Getting all Devices Up
     */
    public function getAllDevices() {
        $result = mysql_query("SELECT * FROM snmp_monitor JOIN snmp_location ON location_macaddr = mon_macaddr ");
        return $result;
    }

	public function getDevices($macaddr) {
        $result = mysql_query("SELECT * FROM snmp_monitor JOIN snmp_location ON location_macaddr = mon_macaddr WHERE location_macaddr = '".$macaddr."'");
        return $result;
    }

	public function deletedevice($sql){
		mysql_query($sql);
	}

	public function checkup($ip, $macaddr, $sysname){
		$result = mysql_query("SELECT * FROM snmp_monitor WHERE mon_ip = '$ip'");
		return $result;
	}

	public function checkdown($ip){
		$result = mysql_query("SELECT mon_ip,history_no,history_ip,history_flag FROM `snmp_monitor` LEFT JOIN snmp_history ON mon_ip = history_ip WHERE mon_ip = '$ip' ORDER BY history_no DESC LIMIT 1;");
		return $result;
	}

	public function insertup_monitor($ip, $macaddr, $sysname){
		$result = mysql_query("INSERT INTO `snmp_monitor`(`mon_hostname`, `mon_macaddr`, `mon_ip`) VALUES ('$sysname','$macaddr','$ip')");
		return $result;
	}

	public function insertup_monitor1($sql){
		$result = mysql_query($sql);
		return $result;
	}

	public function getdevice_history(){
		$result = mysql_query("SELECT history_hostname FROM snmp_history WHERE history_flag=1 GROUP BY history_hostname");
		return $result;
	}

	public function updateup_monitor($ip, $macaddr, $sysname){
		$result = mysql_query("UPDATE snmp_monitor SET `mon_flag` = 1 WHERE `mon_ip` = '$ip'");
		return $result;
	}

	public function updateup_history($ip, $macaddr, $sysname){
		$result = mysql_query("UPDATE snmp_history SET `history_macaddr` = '$macaddr', `history_hostname` = '$sysname', `history_end` = NOW(), `history_flag` = 1 WHERE `history_ip` = '$ip' AND  `history_flag` = 0");
		return $result;
	}

	public function updatedown_monitor($ip){
		$result = mysql_query("UPDATE `snmp_monitor` SET `mon_flag`='0' WHERE `mon_ip`='$ip'");
		return $result;
	}

	public function insertdown_history($ip){
		$result = mysql_query("INSERT INTO snmp_history(`history_ip`, `history_begin`) VALUES ('$ip', NOW())");
		return $result;
	}

	public function getAllNetwork(){
		$result = mysql_query("SELECT * FROM snmp_network");
		return $result;
	}


	public function getNetworkByID($id){
		$result = mysql_query("SELECT * FROM `snmp_network` WHERE network_no='$id'");
		return $result;
	}

	public function updateNetworkByID($id,$network,$netmask,$community){
		$result = mysql_query("UPDATE `snmp_network` SET `network_range`='$network', `network_mask`='$netmask', `network_community`='$community' WHERE `network_no`='$id'");
		return $result;
	}

	public function addNetwork($network,$netmask,$community){
		$result = mysql_query("INSERT INTO `snmp_network`( `network_range`, `network_mask`, `network_community`) VALUES ('".$network."','".$netmask."','".$community."')");
		return $result;
	}

	public function addUser($user, $pass, $role, $name, $lastname, $position, $sex, $age, $email){
		$result = mysql_query("INSERT INTO snmp_user(`user_name`, `user_pass`, `user_flag`, `name`, `lastname`, `sex`, `age`, `position`, `email`) VALUES ('".$user."','".$pass."','".$role."','".$name."','".$lastname."','".$sex."','".$age."','".$postion."','".$email."')");
		return $result;
	}

	public function deleteNetworkByID($id){
		$result = mysql_query("DELETE FROM `snmp_network` WHERE network_no = '".$id."'");
	}

	public function gethistory(){
		$result = mysql_query("SELECT count(`history_hostname`) as qty, DATE_FORMAT(`history_end`,'%b %d %Y') as day FROM `snmp_history` WHERE date(`history_end`)
 	> (NOW() - INTERVAL 365 DAY)
	GROUP BY EXTRACT(DAY FROM `history_end`) ");
		return $result;
	}

	public function gethistorybydate($begin,$end){
		$result = mysql_query("SELECT count(`history_hostname`) as qty, DATE_FORMAT(`history_end`,'%b %d %Y') as day FROM `snmp_history` WHERE date(`history_end`)
 	BETWEEN date('$begin') AND date('$end')
	GROUP BY EXTRACT(DAY FROM `history_end`)");
		return $result;
	}

	public function gethistorybydateanddevice($begin,$end,$device){
		$result = mysql_query("SELECT count(`history_hostname`) as qty, DATE_FORMAT(`history_end`,'%b %d %Y') as day FROM `snmp_history` WHERE date(`history_end`)
 	BETWEEN date('$begin') AND date('$end') AND history_hostname = '$device'
	GROUP BY EXTRACT(DAY FROM `history_end`)");
		return $result;
	}

	public function gethistorytable(){
		$result = mysql_query("SELECT history_hostname,history_macaddr,location_name,concat(history_end,' | ',DATEDIFF(NOW(),history_end), ' days ',MOD(TIMESTAMPDIFF(HOUR,history_end, NOW()),24), ' hours ', MOD(TIMESTAMPDIFF(HOUR,history_end, NOW()),60), ' minutes')as downtime FROM snmp_history JOIN snmp_location ON history_macaddr = location_macaddr WHERE history_flag=1 ORDER BY history_end");
		return $result;
	}

	public function gethistorytablebydate($begin,$end){
		$result = mysql_query("SELECT `history_hostname`,history_macaddr , location_name, concat(history_end,' | ',DATEDIFF(NOW(),history_end), ' days ',MOD(TIMESTAMPDIFF(HOUR,history_end, NOW()),24), ' hours ', MOD(TIMESTAMPDIFF(HOUR,history_end, NOW()),60), ' minutes')as downtime
		FROM snmp_history JOIN snmp_location ON history_macaddr = location_macaddr
		WHERE date(`history_end`)
		BETWEEN '$begin' and '$end' AND history_flag = 1 ORDER BY history_end");
		return $result;
	}

	public function gethistorytablebydateanddevice($begin,$end,$device){
		$result = mysql_query("SELECT `history_hostname`,history_macaddr , location_name, concat(history_end,' | ',DATEDIFF(NOW(),history_end), ' days ',MOD(TIMESTAMPDIFF(HOUR,history_end, NOW()),24), ' hours ', MOD(TIMESTAMPDIFF(HOUR,history_end, NOW()),60), ' minutes')as downtime
		FROM snmp_history JOIN snmp_location ON history_macaddr = location_macaddr
		WHERE date(`history_end`)
		BETWEEN '$begin' and '$end' AND `history_hostname` = '$device' AND history_flag = 1 ORDER BY history_end");
		return $result;
	}

	public function getLocation(){
		//$result = mysql_query("SELECT * FROM `snmp_monitor` JOIN snmp_location ON `mon_macaddr` = location_macaddr");
		$result = mysql_query("SELECT * FROM `snmp_monitor` LEFT JOIN snmp_location ON `mon_macaddr` = location_macaddr");
		return $result;
	}

	public function getlocationwhere($sql){
		$result = mysql_query($sql);
		$row = mysql_fetch_row($result);
		return $row[0];
		/*if(!isset($row)){
			return $row[0];
		}else{
			return $row[0];
		}*/

	}

	public function updatelocation($sql){
		$result = mysql_query($sql);
	}

    /**
     * Check user is existed or not
     */
    public function isUserExisted($email) {
        $result = mysql_query("SELECT email from gcm_users WHERE email = '$email'");
        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {
            // user existed
            return true;
        } else {
            // user not existed
            return false;
        }
    }

}

?>
