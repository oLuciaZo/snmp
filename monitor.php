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
        <script>
function querydevices(){
var xmlhttp = new XMLHttpRequest();
var url = "monitor_json.php";
xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        myFunction(xmlhttp.responseText);
    }
}
xmlhttp.open("GET", url, true);
xmlhttp.send();

function myFunction(response) {
	var table = document.getElementById("myTable");
	var tableRows = table.getElementsByTagName('tr');
	var rowCount = tableRows.length;
	for (var x=rowCount-1; x>0; x--) {
   		table.deleteRow(x);
}
    var jsonData = JSON.parse(response);
for (var i = 0; i < jsonData.monitor.length; i++) {
    var counter = jsonData.monitor[i];
    var row = table.insertRow();
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);
    var cell6 = row.insertCell(5);
    var cell7 = row.insertCell(6);
    var cell8 = row.insertCell(7);
    if((i%2)==0){
    row.style.backgroundColor = "#003366";
    } else {
    row.style.backgroundColor = "#006666";
    }
    row.style.color = "#FFFFCC";
    cell1.innerHTML = i+1;
    //cell2.innerHTML = '<a href="somepage.htm?varName=' + counter.hostname + '">click me</a>';
    cell2.innerHTML = counter.hostname;
    cell3.innerHTML = '<a href="devicedetail.php?macaddr=' + counter.macaddr + '" target="_blank">'+counter.macaddr+'</a>';
    cell4.innerHTML = counter.ip;
    cell5.innerHTML = counter.serial;
    cell6.innerHTML = counter.location;
    cell7.innerHTML = counter.desc;
    if(counter.flag==1){
    	cell8.innerHTML = "Up";
    }else{
    	cell8.innerHTML = "Down";
      if(counter.location_flag==1){
      cell8.style.color = 'red';
    }
    }

    console.log(counter.hostname);
}

		}
		setTimeout(function(){ querydevices(); }, 10000);

}

function createTable(){
	console.log("OK");

}


</script>
    <title>Flat UI Login</title>




        <link rel="stylesheet" href="css/style.css">




  </head>

  <body onload="querydevices()">

    <div id="wrap">
  <div id="regbar">
    <div id="navthing">
      <h2><a href="monitor.php" id="loginform"><u>Monitoring</u></a> | <a href="network.php">Network</a>  | <a href="location.php">Device Information</a> | <a href="history.php" >History</a> | <a href="user.php">User</a> | <a href="logout.php">Logout</a></h2>
    <!--<div class="login">
      <div class="arrow-up"></div>
      <div class="formholder">

        <div class="randompad">

        </div>
      </div>
    </div>
    </div>!-->
  </div>
  <h2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>Monitoring</u></h2>

  <div id="Table" align="center">
  	<table id="myTable" width="800" bgcolor="#006666" border="0"  bordercolorlight="white">
  <tr bgcolor="#999999">
    <td>No</td>
    <td>Hostname</td>
    <td>MAC Address</td>
    <td>IP Address</td>
    <td>Serial</td>
    <td>Location</td>
    <td>Description</td>
    <td>Status</td>
  </tr>
</table>
  	</div>
</div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

        <script src="js/index.js"></script>




  </body>
</html>
