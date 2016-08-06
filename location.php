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
      <h2><a href="monitor.php" id="loginform">Monitoring</a> | <a href="network.php">Network</a>  | <a href="location.php"><u>Device Information</u></a> | <a href="history.php" >History</a> | <a href="user.php">User</a> | <a href="logout.php">Logout</a></h2>
    <!--<div class="login">
      <div class="arrow-up"></div>
      <div class="formholder">

        <div class="randompad">

        </div>
      </div>
    </div>
    </div>!-->
  </div>
  <h2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>Device Information</u></h2>
  <div id="Table" align="center">
  	<form action="locationupdate.php" method="POST">
  	<table id="myTable" width="800" bgcolor="#006666" border="0"  bordercolorlight="white">
  <tr bgcolor="#999999">
    <td>No</td>
    <td>Hostname</td>
    <td>MAC Address</td>
    <td>IP Address</td>
    <td>Location</td>
    <td>Description</td>
    <td>Serial</td>
    <td>Brand</td>
    <td>Model</td>
    <td>Type</td>
    <td>License</td>
    <td>List Name</td>
    <td>Being Repaired</td>
    <td></td>


  </tr>
  <?php
  include_once '/var/www/html/snmp/db_functions.php';
  $db = new DB_Functions();
  $res = $db->getLocation();
  $count=1;
  while($data = mysql_fetch_row($res)){
  	print "<tr>";
	  print "<td>".$count."</td>";
	  print "<td>".$data[1]."</td>";
	  print "<td>".$data[2]."</td>";
	  print "<td>".$data[3]."</td>";
	  print "<td>"."<input type=text name=location".$count." value=".$data[6]."></td>";
	  print "<td>"."<input type=text name=desc".$count." value=".$data[8]."></td>";
	  print "<td>"."<input type=text name=serial".$count." value=".$data[9]."></td>";
	  print "<td>"."<input type=text name=brand".$count." value=".$data[10]."></td>";
	  print "<td>"."<input type=text name=model".$count." value=".$data[11]."></td>";
	  print "<td>"."<input type=text name=type".$count." value=".$data[12]."></td>";
	  print "<td>"."<input type=text name=license".$count." value=".$data[13]."></td>";
	  print "<td>"."<input type=text name=list".$count." value=".$data[14]."></td>";
    if($data[15]==1){
    print "<td>"."<input type=checkbox name=repair".$count." value=0 ></td>";
    //print ""."<input type=hidden name=repair".$count." value=1>"."";
    /*print "<td><select name=repair".$count.">";
    print "<option value=0>Yes</option>";
    print "<option value=1 selected>No</option>";
    print "</select></td>";*/
  }else {
    print "<td>"."<input type=checkbox name=repair".$count." value=0 checked></td>";
    //print ""."<input type=hidden name=repair".$count." value=0>"."";
    /*print "<td><select name=repair".$count.">";
    print "<option value=0 selected>Yes</option>";
    print "<option value=1>No</option>";
    print "</select></td>";*/
  }
	  print ""."<input type=hidden name=macaddr".$count." value=".$data[2].">"."";
	  print ""."<input type=hidden name=count value=".$count.">"."";
	  print "<td>"."<a href=delete.php?macaddr=".$data[2].">Delete</a></td>";
	print "</tr>";
	$count++;
  }
  ?>
</table>
<br>
<input type="Submit" value="Update"/>
</form>
  	</div>
</div>
  </body>
</html>
