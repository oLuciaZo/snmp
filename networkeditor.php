<!DOCTYPE html>
<html >
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

        <script src="js/index.js"></script>
        <script>

</script>
    <title>Flat UI Login</title>

        <link rel="stylesheet" href="css/style.css">

  </head>
<?php
  	session_start();
	if($_SESSION['user_name']==null){
		header("Location: index.html");
	}else{

	}
  	?>
  <body>

    <div id="wrap">
  <div id="regbar">
    <div id="navthing">
      <h2><a href="monitor.php" id="loginform">Monitoring</a> | <a href="network.php"><u>Network</u></a>  | <a href="location.php">Device Information</a> | <a href="history.php" >History</a> | <a href="user.php">User</a> | <a href="logout.php">Logout</a></h2>
    <!--<div class="login">
      <div class="arrow-up"></div>
      <div class="formholder">

        <div class="randompad">

        </div>
      </div>
    </div>
    </div>!-->
  </div>
  <h2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>Network >> Edit</u></h2>
  <div id="Table" align="center">
  	<form action="networkediting.php" method="post">
  	<table id="myTable" width="800" bgcolor="#006666" border="1"  bordercolorlight="white"">
  <tr bgcolor="#999999">

    <td>Network</td>
    <td>Netmask</td>
    <td>Community</td>
    <td></td>
  </tr>
  <?php
  include_once '/var/www/html/snmp/db_functions.php';
  $db = new DB_Functions();
  if($_GET['flag']==1){
  $res = $db->getNetworkByID($_GET['no']);
  }else{
  	$db->deleteNetworkByID($_GET['no']);
	//print "DELETE FROM `snmp_network` WHERE network_no = '".$_GET['no']."'";
	header("Location: network.php");
  }
  $data = mysql_fetch_array($res);
  ?>
  <tr><input type="hidden" name="no" value="<?php print $data['network_no']; ?>" />
  <td><input type="text" name="network" value="<?php print $data['network_range']; ?>" /></td>
  <td><input type="number" name="netmask" value="<?php print $data['network_mask']; ?>" /></td>
  <td><select name="community">
<option value="public">public</option>
<option value="private">private</option>
</select></td>
  <td><input type="submit" value="Done"/></td>
  </tr>
</table>
</form>
  	</div>
</div>
  </body>
</html>
