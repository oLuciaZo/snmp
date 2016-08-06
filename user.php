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
		if($_SESSION['user_flag']!=1){
			echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Only Admin Privilledge')
    window.location.href='monitor.php';
    </SCRIPT>");
		}
	}
  	?>
  <body>

    <div id="wrap">
  <div id="regbar">
    <div id="navthing">
      <h2><a href="monitor.php" id="loginform">Monitoring</a> | <a href="network.php">Network</a>  | <a href="location.php">Device Information</a> | <a href="history.php" >History</a> | <a href="user.php"><u>User</u></a> | <a href="logout.php">Logout</a></h2>
    <!--<div class="login">
      <div class="arrow-up"></div>
      <div class="formholder">

        <div class="randompad">

        </div>
      </div>
    </div>
    </div>!-->
  </div>
  <h2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>User</u></h2>
  <div id="Table" align="center">
  	<table id="myTable" width="800" bgcolor="#006666" border="1"  bordercolorlight="white">
  <tr bgcolor="#999999">
    <td>No</td>
    <td>Username</td>
    <td>Operation</td>
    <td></td>
    <td></td>

  </tr>
  <?php
  include_once '/var/www/html/snmp/db_functions.php';
  $db = new DB_Functions();
  $res = $db->getUserEdit();
  $count=1;
  while($data = mysql_fetch_row($res)){
  	print "<tr>";
	  print "<td>".$count."</td>";
	  print "<td>".$data[1]."</td>";
	  //print "<td>".$data[2]."</td>";
	  if($data[3]==1){
	  print "<td>"."Administrator"."</td>";
	  }else{
	  	print "<td>"."Monitor"."</td>";
	  }
	  print "<td>"."<a href="."usereditor.php?no=$data[0]&flag=1 >"."Edit"."</a>"."</td>";
	  print "<td>"."<a href="."usereditor.php?no=$data[0]&flag=2 >"."Delete"."</a>"."</td>";
	print "</tr>";
	$count++;
  }
  ?>
</table>
<form action="add_user.php">
<table>
  <tr>
    <td></td>
    <td><input type="Submit" name="Add" value="Add"></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
</table>
</form>
  	</div>
</div>
  </body>
</html>
