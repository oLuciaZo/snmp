<!DOCTYPE html>
<html >
  <head>
  	<?php
  	session_start();
	if($_SESSION['user_name']==null){
		header("Location: index.html");
	}else{
		
	}
  	?>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

        <script src="js/index.js"></script>
        
    <title>Flat UI Login</title>
    
    
    
    
        <link rel="stylesheet" href="css/style.css">

    
    
    
  </head>

  <body>

    <div id="wrap">
  <div id="regbar">
    <div id="navthing">
      <h2><a href="monitor.php" id="loginform">Monitoring</a> | <a href="network.php">Network</a>  | <a href="location.php">Location</a> | <a href="history.php" >History</a> | <a href="user.php">User</a> | <a href="logout.php">Logout</a></h2>
    <!--<div class="login">
      <div class="arrow-up"></div>
      <div class="formholder">
      
        <div class="randompad">
        
        </div>
      </div>
    </div>
    </div>!-->
  </div>
  <br>
  <br>
  <div id="Table" align="center">
  	<?php
include_once '/var/www/html/snmp/db_functions.php';
 	$db = new DB_Functions();
 	$macaddr = $_GET['macaddr'];
	$res = $db->getDevices($macaddr);
	while($data = mysql_fetch_row($res)){;
?>
  	<table id="myTable" width="800" bgcolor="#006666" border="0"  bordercolorlight="white">
  <tr>
    <td bgcolor="#999999" width=20%>Host Name</td>
    <td><?php print $data[1]; ?></td>
  </tr> 
  <tr>
    <td bgcolor="#999999">MAC Address</td>
    <td><?php print $data[2]; ?></td>
  </tr>
  <tr>
    <td bgcolor="#999999">IP Address</td>
    <td><?php print $data[3]; ?></td>
  </tr>
  <tr>
    <td bgcolor="#999999">Serial Number</td>
    <td><?php print $data[6]; ?></td>
  </tr>
  <tr>
    <td bgcolor="#999999">Location</td>
    <td><?php print $data[8]; ?></td>
  </tr>
  <tr>
    <td bgcolor="#999999">Description</td>
    <td><?php print $data[9]; ?></td>
  </tr>
  <tr>
    <td bgcolor="#999999">Serial</td>
    <td><?php print $data[10]; ?></td>
  </tr>
  <tr>
    <td bgcolor="#999999">Model</td>
    <td><?php print $data[11]; ?></td>
  </tr>
  <tr>
    <td bgcolor="#999999">Type</td>
    <td><?php print $data[12]; ?></td>
  </tr>
  <tr>
    <td bgcolor="#999999">License</td>
    <td><?php print $data[13]; ?></td>
  </tr>
  <tr>
    <td bgcolor="#999999">List Name</td>
    <td><?php print $data[14]; }?></td>
  </tr>
</table>
  	</div>
</div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

        <script src="js/index.js"></script>

    
    
    
  </body>
</html>
