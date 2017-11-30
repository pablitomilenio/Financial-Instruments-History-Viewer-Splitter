<?php



echo "<a href='index.php?'".rand()."> Hauptseite </a>";





$fl = "uploads/".$_GET['fl'];



$myfile = fopen($fl, "r") or die("Unable to open file!");

//$tcont2 = fread($myfile,100);

$tcont2 = fread($myfile,filesize($fl));

$size = filesize($fl);

fclose($myfile);

$tc2arr = explode(";",$tcont2);

//print_r($tc2arr);

$leftstr = $_GET['fl'];



$folioName = substr($leftstr,2,8);



$i=2;

while(substr($leftstr,$i,1)=="0") $i++;

$folioName = substr($leftstr,$i,10-$i);





echo $folioName;



//echo $tcont2;





//query2b = "insert into bogendiagramm values(".$stamp.",'".$time."','".$festo_today."','".$tts_today."','".$vip_today."','".$produktion_today."','".$festo_week."','".$tts_week."','".$vip_week."','".$produktion_week."','".$festo_month."','".$tts_month."','".$vip_month."','".$produktion_month."','".$av_fto_month."')";

//$res = mysqli_query($mysqli,$query3a );



?>



<!doctype html>

<html>

<head>

</head>

<body>



<pre>



<?php 



$inv = array_reverse($tc2arr);

$fileStart = $tc2arr[0];

for ($i=0;$i<5;$i++) array_pop($inv);


$inv = array_reverse($inv);

//print_r($inv);

$folioName = substr($fileStart,strpos($fileStart, "\n"),99999);
$pos2 = strpos($folioName, "\n",1);
$folioName = substr($folioName,4,$pos2);

$folioName = preg_replace('/[^A-Za-z0-9]/', '', $folioName);

//for ($i=0;$i<count($inv)-1;$i+=5) {

//$i<count($inv)-1
for ($i=5;$i<count($inv)-1;$i+=5) {

	$timesRAW = substr($inv[$i], -32);
	//echo $inv[$i];
	echo "<hr>";


	$datesRAW = substr($inv[$i], -76,40);

	$kurseRAW = str_replace(",",".",$inv[$i+2]);


	echo "inv: ".$inv[$i];
	echo "<br><br>";
	echo "timesRAW: ".$timesRAW;
	echo "<br>";



	$dateString = "";
	//there are white spaces between each character
	for($q=0;$q<40;$q+=4) 	$dateString .= substr($datesRAW,$q,1);
	echo "ds: '".$dateString."'<br>";	
	
	$timeString = "";
	//there are white spaces between each character
	for($q=0;$q<40;$q+=4) 	$timeString .= substr($timesRAW,$q,1);
	echo "ts: '".$timeString."'<br>";	


	$kurseString = "";

	for($q=3;$q<36;$q+=4) 	$kurseString .= substr($kurseRAW,$q,1);
	echo "ks: ".$kurseString."<br>";	
	

	echo "stampRAW: ".$dateString." ".$timeString;
	
	$stamps[] = strtotime($dateString." ".$timeString); 	
	
	echo "stamp: ".end($stamps);
		
	//print_r($stamps);
	

	$times[] = $timeString;

	$dates[] = $dateString;

	$kurse[] = $kurseString;


}



//print_r($kurse); 

//print_r($dates); 

//print_r($inv); 

//print_r($tc2arr); 



$times = array_reverse($times);

$dates = array_reverse($dates);

$kurse = array_reverse($kurse);

$stamps = array_reverse($stamps);



	$mysqli = mysqli_connect("sql303.byethost7.com", "b7_17746104", "public123", "b7_17746104_wf");



	$dt = "drop table '$folioName'";

	$res = mysqli_query($mysqli,$dt);



	

	$ct = "CREATE TABLE `$folioName` (`stamp` varchar(10) NOT NULL,`date` varchar(10) NOT NULL,`time` varchar(5) NOT NULL,`kurs` varchar(9) NOT NULL);";

	//echo $ct;

	$res = mysqli_query($mysqli,$ct);

	

	$prim = "ALTER TABLE `$folioName` ADD PRIMARY KEY (`stamp`);";



	$res = mysqli_query($mysqli,$prim);

	



	for ($i=0;$i < count($kurse);$i++) {

		$query2 = "insert into `$folioName` values('".$stamps[$i]."','".$dates[$i]."','".$times[$i]."','".$kurse[$i]."')";

		$res = mysqli_query($mysqli,$query2);

	}



/*

$mysqli = mysqli_connect("localhost", "root", "", "wf");

$res = mysqli_query($mysqli, "select * from kurse");

$row = $res->fetch_assoc();



$dtm =  $row["datum"];



echo strtotime($dtm);

*/







?>



</pre>

</body>

</html>