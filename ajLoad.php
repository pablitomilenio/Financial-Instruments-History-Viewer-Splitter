	<?php

		$parm = $_GET['parm'];

		$monthNum = $_GET['month'];

		

		$yearNum = $_GET['year'];

		$fullstring = $_GET['fullstring'];

		$tabelle = $_COOKIE['tabelle'];

		
		if ($monthNum > 0) {
			$firstday = strtotime($monthNum."/01/".$yearNum);
	
			$lastday  = strtotime($monthNum."/".date("t", $firstday )."/".$yearNum. " 23:59");	
			$moment1 = $firstday;
			$moment2 = $lastday;			
		}else {
			$moment1 = strtotime($_GET['start']);
			$moment1 = strtotime($_GET['end']);
		}

		$mysqli = mysqli_connect("sql303.byethost7.com", "b7_17746104", "public123", "b7_17746104_wf");

		$query = "select * from $tabelle where stamp > $moment1 and stamp < $moment2 order by stamp asc ";

		//echo $query;
		$res = mysqli_query($mysqli,$query);

		

		$valString = "";

		$stmpString = "";

		

		while ($row = $res->fetch_assoc()) {

	    	$values[] = $row['kurs'];

	    	$valString .= ",".$row['kurs'];

   	    	$stmpString .= ",".date('d.m.Y H:i',$row['stamp'])."";

	    }

	    

	    $valString = substr($valString, 1,999999999);

   	    $stmpString = substr($stmpString, 1,999999999);

   	    

   	    echo $valString.";".$stmpString;

   	       	    

	?>



       





