<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="X-UA-Compatible" content="IE=11"/>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <script src="jquery-2.1.1.js"></script>
        <script src="Smooth-0.1.7.js"></script>
        <script src="theScript.js"></script>
        <title>Monatsansicht</title>
        
<style>
#resumen{
	font-size:16pt;
}
body{
	overflow:hidden;
	
}
</style>
</head>

<body>
       <canvas id="graph0" width="1100" height="920"></canvas> 
        <div style="background-color:#e3fcf4; padding:10px; right:0;top:0;position:absolute; width:40%; height:100%">
	        <div id="contents" style="display:none;">empty</div>
	        <input style="display:none" id="btn" type="button" value="Refresh" onClick="loadVals()"/>
	        <input style="display:none"id="numVls" type="text" value="999999" />
	        <input id="year" type="text" value="2016" onchange="chgYr()"/>

	        <hr>
	        
   	        <input id="jan" class="mth" type="button" value="Januar" onClick="loadVals(1,0,2015)"/>
   	        <input id="feb" class="mth" type="button" value="Februar" onClick="loadVals(2,0,2015)"/>
   	        <input id="mar" class="mth" type="button" value="März" onClick="loadVals(3,0,2015)"/>
   	        <input id="apr" class="mth" type="button" value="Aprli" onClick="loadVals(4,0,2015)"/>
   	        <input id="mai" class="mth" type="button" value="Mai" onClick="loadVals(5,0,2015)"/>
   	        <input id="jun" class="mth" type="button" value="Juni" onClick="loadVals(6,0,2015)"/>
   	        <input id="jul" class="mth" type="button" value="Juli" onClick="loadVals(7,0,2015)"/>
   	        <input id="aug" class="mth" type="button" value="August" onClick="loadVals(8,0,2015)"/>
   	        <input id="sep" class="mth" type="button" value="September" onClick="loadVals(9,0,2015)"/>
   	        <input id="oct" class="mth" type="button" value="Oktober" onClick="loadVals(10,0,2015)"/>
   	        <input id="nov" class="mth" type="button" value="November" onClick="loadVals(11,0,2015)"/>
   	        <input id="dez" class="mth" type="button" value="Dezember" onClick="loadVals(12,0,2015)"/>
   	        <hr>
   	        
   	        
   	        <div id="resumen"></div>
   	        <a href="/">Home</a>
        </div>
        
        <script>
        
        urlVal = window.location.toString().substr(-4,4);
        mVal = window.location.toString().substr(-6,2);

        
        if (parseInt(urlVal) > 0) $("#year").val(urlVal);
        
        function chgYr() {
	        theYear = $("#year").val();
	        
	        $("#jan").attr("onclick","loadVals(1,0,"+theYear+")");
	        $("#feb").attr("onclick","loadVals(2,0,"+theYear+")");
	        $("#mar").attr("onclick","loadVals(3,0,"+theYear+")");
	        $("#apr").attr("onclick","loadVals(4,0,"+theYear+")");
	        $("#mai").attr("onclick","loadVals(5,0,"+theYear+")");
	        $("#jun").attr("onclick","loadVals(6,0,"+theYear+")");
	        $("#jul").attr("onclick","loadVals(7,0,"+theYear+")");
	        $("#aug").attr("onclick","loadVals(8,0,"+theYear+")");
	        $("#sep").attr("onclick","loadVals(9,0,"+theYear+")");
	        $("#oct").attr("onclick","loadVals(10,0,"+theYear+")");
	        $("#nov").attr("onclick","loadVals(11,0,"+theYear+")");
	        $("#dez").attr("onclick","loadVals(12,0,"+theYear+")");
		}

        
        $(document).ready(function() {
           	loadVals(mVal,0,urlVal);
           	chgYr()
			});

        </script>
        
       <div style="position:absolute;bottom:10px;right:10px;opacity:0.2"><img src="eu.png"></div>
    </body>

</html>