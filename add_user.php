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
  	<form action="add_user_engine.php" method="post">
  	<table id="myTable" width="40%" bgcolor="#006666" border="1"  bordercolorlight="white">
  <tr>
    <td>Name</td><td><input type="text" name="name" id="name" /></td> </tr>
    <tr>
    <td>Lastname</td><td><input type="text" name="lastname" id="lastname" /></td> </tr>
    <tr>
    <td>Sex</td><td><select name="sex" id="sex">
  <option value="Male">Male</option>
  <option value="Female">Female</option>
</select></td> </tr>
    <tr>
    <td>Age</td><td><input type="text" name="age" id="age" /></td> </tr>
    <tr>
    <td>Position</td><td><input type="text" name="position" id="position" /></td> </tr>
    <tr>
    <td>Email</td><td><input type="email" name="email" id="email" /></td> </tr>
    <tr>
    <td>Username</td><td><input type="text" name="user" id="user" /></td> </tr>
    <tr>
    <td>Password</td><td><input type="password" name="pass" id="pass" /></td> </tr>
    <tr>
    <td>Re-Password</td><td><input type="password" name="repass" id="repass" /></td> </tr>
    <tr>
    <td>Operation</td><td><select name="role" id="role">
  <option value="1">Administrator</option>
  <option value="2">Monitor</option>
</select></td> </tr>



</table>

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
