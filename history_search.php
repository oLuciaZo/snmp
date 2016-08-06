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
    <meta charset="UTF-8">
    <title>Flat UI Login</title>
   
        <link rel="stylesheet" href="css/style.css">

  </head>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src='Chart/Chart.js'></script>
        <script src="js/index.js"></script>
        
<script>
var mychart;//variable for class Chart
function chart(labelgraph,datagraph){
	//mychart.remove();
var history = document.getElementById('historygraph').getContext('2d');
mychart = new Chart(history);
//var jsondata = '{"0":"203","1":"156","2":"99","3":"251","4":"305","5":"247"}';
//var parsed = JSON.parse(jsondata);
//var arr = [];
//for(var x in parsed){
//  arr.push(parsed[x]);
//}

//var b = [203,156,99,251,305,247];
//var a = b;

var historyData = {
	labels : labelgraph,
	datasets : [
		{
			fillColor : "rgba(172,194,132,0.4)",
			strokeColor : "#ACC26D",
			pointColor : "#fff",
			pointStrokeColor : "#9DB86D",
			data : datagraph
		}
	]
}
//var mychart;
//new Chart.destroy();
//mychart = new Chart(history).Line(historyData);

mychart.Line(historyData);

}

function resetchart(){
	var history = document.getElementById('historygraph').getContext('2d');
	new Chart(history).destroy();
	
}


function chart2date(){
	//var device = "";
	var begin = "<?php print $_POST['begin']; ?>";
	var end = "<?php print $_POST['end'];  ?>";
	var device = "<?php print $_POST['device'];  ?>";
	createtable(begin,end,device);
	//mychart.Destroy();
	//var history = document.getElementById('historygraph').getContext('2d');
	//mychart = new Chart(history);
	//mychart.destroy();
	var xmlhttp = new XMLHttpRequest();
	if(device==0){
	var url = "history_json.php?status=2&begin="+begin+"&end="+end+"";
	console.log(url);
	}else{
	var url = "history_json.php?status=3&begin="+begin+"&end="+end+"&device="+device+"";
	console.log(url);
	}
xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        myFunction(xmlhttp.responseText);
    }
}
xmlhttp.open("GET", url, true);
xmlhttp.send();

function myFunction(response) {
	var labelgraph = [];
    var datagraph  = [];
    var jsonData = JSON.parse(response);
for (var i = 0; i < jsonData.history.length; i++) {
    var counter = jsonData.history[i];
    labelgraph.push(counter.day);
    datagraph.push(counter.qty);
   }
   chart(labelgraph,datagraph);
  }
	
	console.log(begin);
	console.log(end);
	console.log(device);
}
/*
//############ Listening from Submit SEARCH  ##############//
$(document).ready(function() {
    $('#Search').click(function() {
    	test($('#begin').val(),$('#end').val(),$('#device').val());
    	//createtable();
    	//mychart.destroy();
      chart2date($('#begin').val(),$('#end').val(),$('#device').val());
    });
});
*/
function test(begin,end,device){
	console.log(begin);
	console.log(end);
	console.log(device);
}

function createtable(begin,end,device){
	var xmlhttp = new XMLHttpRequest();
	if(device==1){
	var url = "history_json_table.php";
	console.log(url);
	}else if(device==0){
		var url = "history_json_table.php?status=2&begin="+begin+"&end="+end+"";
		console.log(url);
	}else {
		var url = "history_json_table.php?status=3&begin="+begin+"&end="+end+"&device="+device+"";
		console.log(url);
	}
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
for (var i = 0; i < jsonData.history_table.length; i++) {
    var counter = jsonData.history_table[i];
    var row = table.insertRow();
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);
    if((i%2)==0){
    row.style.backgroundColor = "#003366";
    } else {
    row.style.backgroundColor = "#006666";	
    } 
    row.style.color = "#FFFFCC";
    cell1.innerHTML = i+1;
    cell2.innerHTML = counter.hostname;
    cell3.innerHTML = counter.macaddr;
    cell4.innerHTML = counter.location;
    cell5.innerHTML = counter.downtime;
    
    console.log(counter.hostname);
}

		}
}
function test(){
	var name = $("begin").val();
	alert(name);
}

</script>


  <body onload="chart2date()">
  <div id="wrap">
  <div id="regbar">
    <div id="navthing">
      <h2><a href="monitor.php" id="loginform">Monitoring</a> | <a href="network.php">Network</a> | <a href="history.php" >History</a> | <a href="user.php">User</a> | <a href="logout.php">Logout</a></h2>
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
  <?php
  include_once '/var/www/html/snmp/db_functions.php';
  $db = new DB_Functions();
  $res = $db->getdevice_history();
  //print $_POST['begin'];
  ?>
  	
  	
</div>
	<br>
    <br>
<div align="center">
	<br>
  <br>
  <form action="history_search.php" method="POST">
  <div id="Table" align="center">
  	<font color="white">Enter a date before :</font>
  	<input type="date" name="begin" max="2016-12-31">
  	<font color="white">Enter a date after :</font>
  	<input type="date" name="end" max="2016-12-31">
  	<select name=device value=''>device</option>
  		<option value=0>none</option>
  	<?php
  	//$count=1;
  	while($data = mysql_fetch_row($res)){
  	echo "<option value=$data[0]>$data[0]</option>"; 
  	//$count++;
  }
	echo "</select>";
  	?>
  	<input type="Submit" id="Search" value="Search" onclick="" />
  	<!--<input type="Submit" id="Reset" value="Reset" onclick="resetchart()" />-->
  	</div>  
<br>
  <br>
  </form>
  <table width="600" height="400" border="1">
  	<tr><td>
<canvas id="historygraph" width="600" height="400"></canvas>
</td>
</tr>
</table>
<br>
<table width="600" border="0" bgcolor="#B6B6B4" id="myTable">
	<tr>
		<td>No</td>
		<td>Hostname</td>
		<td>MAC Address</td>
		<td>Location</td>
		<td>Downtime</td>
	</tr>
	</table>
    </div>
    
    
  </body>
</html>
