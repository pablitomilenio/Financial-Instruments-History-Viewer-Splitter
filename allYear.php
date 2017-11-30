<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="X-UA-Compatible" content="IE=11"/>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <script src="jquery-2.1.1.js"></script>
        <script src="Smooth-0.1.7.js"></script>
        <script src="theScript.js"></script>
     <title>Jahresuebersicht</title>   
        
<style>
#resumen{
	font-size:16pt;
}
body{
	overflow:hidden;
	text-align:center;

	
}
td{
	text-align:center;
	padding:0;
	margin:0;
	padding-bottom:20px;
	padding-right:3px;
	border:2px solid blue;
}

body{
	background-color:#FFFAFF;
	font-family:Georgia, "Times New Roman", Times, serif;
}
#tit{
	font-size:40pt;
	z-index:100;
		text-shadow: 2px 2px #ffffff;
}
</style>

</head>

<body>

<script>
        urlVal = window.location.toString().substr(-4,4);
</script>


<div style="position:absolute;left:30"><a href="index.php">home</a></div>
<div id="tit">
<a id="goleft" href="">&laquo;</a> Jahresuebersicht <?php echo $_COOKIE['tabelle'] ?> <script>document.write(urlVal)</script> <a id="goright" href="">&raquo;</a>
</div>
<script>        
        $("#goleft").attr("href","allYear.php?"+(urlVal-1));
        $("#goright").attr("href","allYear.php?"+(++urlVal));
        urlVal--;
</script>


<table>
	<tr>
		<td>Januar<br><canvas id="graph1" width="308" height="308" style="background-color:transparent" ></canvas></td>
		<td>Februar<br><canvas id="graph2" width="308" height="308" style="background-color:#eeeeee"></canvas></td>
		<td>Maerz<br><canvas id="graph3" width="308" height="308" style="background-color:transparent"></canvas></td>
		<td>April<br><canvas id="graph4" width="308" height="308" style="background-color:#eeeeee"></canvas></td>
		<td>Mai<br><canvas id="graph5" width="308" height="308" style="background-color:transparent"></canvas></td>
		<td>Juni<br><canvas id="graph6" width="308" height="308" style="background-color:#eeeeee"></canvas></td>
	</tr>
	<tr>
		<td>Juli<br><canvas id="graph7" width="308" height="308" style="background-color:transparent"></canvas></td>
		<td>August<br><canvas id="graph8" width="308" height="308" style="background-color:#eeeeee"></canvas></td>
		<td>September<br><canvas id="graph9" width="308" height="308" style="background-color:transparent"></canvas></td>
		<td>Oktober<br><canvas id="graph10" width="308" height="308" style="background-color:#eeeeee"></canvas></td>
		<td>November<br><canvas id="graph11" width="308" height="308" style="background-color:transparent"></canvas></td>
		<td>Dezember<br><canvas id="graph12" width="308" height="308" style="background-color:#eeeeee"></canvas></td>
	</tr>
</table>

<script>        
    for(i=1;i<13;i++)    $("#graph"+i).attr("onclick","window.open('Viewer.php?0"+i+(urlVal)+"')");
</script>

Klicken Sie auf einen Chart, um ihn zu vergroessern,<br>
Klicken Sie nach links oder rechts um das Jahr umzuschalten     


		<div style="display:none">
	        <div id="contents" style="display:none;">empty</div>
	        <input id="btn" type="button" value="Refresh" onClick="loadVals()"/>
	        <input id="numVls" type="text" value="999999" />
	        <hr>
	        
    	        <hr>
   	        
   	        
   	        <div id="resumen"></div>
        </div>
        
        <script>
        
        urlVal = window.location.toString().substr(-4,4);

        $(document).ready(function() {
        	loadVals(1,1,urlVal);
           	loadVals(2,2,urlVal);
        	loadVals(3,3,urlVal);
           	loadVals(4,4,urlVal);
        	loadVals(5,5,urlVal);
           	loadVals(6,6,urlVal);
        	loadVals(7,7,urlVal);
           	loadVals(8,8,urlVal);
        	loadVals(9,9,urlVal);
           	loadVals(10,10,urlVal);
        	loadVals(11,11,urlVal);
           	loadVals(12,12,urlVal);
         });

        </script>
    </body>

</html>