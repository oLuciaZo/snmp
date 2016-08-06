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
  <h2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>User >> Edit</u></h2>
  <div id="Table" align="center">
  	<form action="userediting.php" method="post">
  	<table id="myTable" width="800" bgcolor="#006666" border="1"  bordercolorlight="white"">

  <?php
  include_once '/var/www/html/snmp/db_functions.php';
  $db = new DB_Functions();
  if($_GET['flag']==1){
  $res = $db->getUserEditByID($_GET['no']);
  }else{
  	$db->deleteUserByID($id);
	header("Location: user.php");
  }
  $data = mysql_fetch_array($res);
  ?>
  <tr bgcolor="#999999">
    <input type="hidden" name="no" value="<?php print $data['user_no']; ?>" />
    <td>User Information</td><td></td></tr>
    <tr>
    <td>Name</td><td><input type="text" name="name" id="name" value="<?php print $data['name']; ?>"/></td> </tr>
    <tr>
    <td>Lastname</td><td><input type="text" name="lastname" id="lastname" value="<?php print $data['lastname']; ?>"/></td> </tr>
    <tr>
      <?php if($data['sex']=="Male"){?>
    <td>Sex</td><td><select name="sex" id="sex">
  <option value="Male" selected>Male</option>
  <option value="Female">Female</option>
</select></td>
<?php }else{?>
  <td>Sex</td><td><select name="sex" id="sex">
<option value="Male" >Male</option>
<option value="Female" selected>Female</option>
</select></td>
<?php }?>
</tr>
    <tr>
    <td>Age</td><td><input type="text" name="age" id="age" value="<?php print $data['age']; ?>"/></td> </tr>
    <tr>
    <td>Position</td><td><input type="text" name="position" id="position" value="<?php print $data['position']; ?>"/></td> </tr>
    <tr>
    <td>Email</td><td><input type="email" name="email" id="email" value="<?php print $data['email']; ?>"/></td> </tr>
    <tr>
    <td>Username</td><td><input type="text" name="user" id="user" value="<?php print $data['user_name']; ?>"/></td> </tr>
    <tr>
    <td>Password</td><td><input type="password" name="pass" id="pass" required /></td> </tr>
    <tr>
    <td>Re-Password</td><td><input type="password" name="repass" id="repass" required /></td> </tr>
    <tr>
    <td>Operation</td><td><select name="role" id="role">
  <option value="1">Administrator</option>
  <option value="2">Monitor</option>
</select></td> </tr>
  </tr>
  <tr>
  <td><input type="submit" value="Submit"/></td>
  </tr>
</table>
</form>
  	</div>
</div>
  </body>
</html>
