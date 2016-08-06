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
  <h2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>Network</u></h2>
  <div id="Table" align="center">
  	<table id="myTable" width="800" bgcolor="#006666" border="0"  bordercolorlight="white">
  <tr bgcolor="#999999">
    <td>No</td>
    <td>Network</td>
    <td>Netmask</td>
    <td>Community</td>
    <td></td>
    <td></td>

  </tr>
  <?php
  include_once './db_functions.php';
  $db = new DB_Functions();
  $res = $db->getAllNetwork();
  $count=1;
  while($data = mysql_fetch_row($res)){
  	if($count%2==1){
  		print "<tr bgcolor="."#003366"." style="."#FFFFCC"." >";
  	}else{
  		print "<tr bgcolor="."#006666".">";
  	}

	  print "<td><font color="."#FFFFCC".">".$count."</font></td>";
	  print "<td><font color="."#FFFFCC".">".$data[1]."</font></td>";
	  print "<td><font color="."#FFFFCC".">".$data[2]."</font></td>";
	  print "<td><font color="."#FFFFCC".">".$data[3]."</font></td>";
	  print "<td>"."<a href="."networkeditor.php?no=$data[0]&flag=1 >"."Edit"."</a>"."</td>";
	  print "<td>"."<a href="."networkeditor.php?no=$data[0]&flag=2 >"."Delete"."</a>"."</td>";
	print "</tr>";
	$count++;
  }
  ?>

  <tr>
  	<form action="network_add.php" method="POST">
  	<td></td>
  	<td><input type="text" name="network" /></td>
  	<td><input type="text" name="netmask" /></td>
  	<td><select name="community">
  <option value="public">public</option>
  <option value="private">private</option>
</select></td>
  	<td><input type="Submit" value="Done" /></td>
  	<td></td>
  	</form>
  </tr>

</table>
  	</div>
</div>
  </body>
</html>
