<?php

$myfile = fopen("WF0RENDITE.csv", "r") or die("Unable to open file!");
//$tcont2 = fread($myfile,100);
$tcont2 = fread($myfile,filesize("WF0RENDITE.csv"));
fclose($myfile);
$tc2arr = explode(";",$tcont2);

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
for ($i=0;$i<5;$i++) array_pop($inv);
$inv = array_reverse($inv);

//for ($i=0;$i<count($inv)-1;$i+=5) {
for ($i=0;$i<count($inv)-1;$i+=5) {
	$timesRAW = substr($inv[$i], -35);
	$datesRAW = substr($inv[$i], -77,40);
	$kurseRAW = str_replace(",",".",$inv[$i+2]);
	
	$dateString = "";
	for($q=1;$q<40;$q+=4) 	$dateString .= substr($datesRAW,$q,1);
	
	
	$timeString = "";
	for($q=3;$q<20;$q+=4) 	$timeString .= substr($timesRAW,$q,1);
	
	$kurseString = "";
	for($q=3;$q<36;$q+=4) 	$kurseString .= substr($kurseRAW,$q,1);
	
	
	$stamps[] = strtotime($dateString." ".$timeString);
	
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

	$mysqli = mysqli_connect("localhost", "root", "", "wf");
	$query1 = "truncate kurse;";
	$res = mysqli_query($mysqli,$query1);
	
	for ($i=0;$i < count($kurse);$i++) {
		$query2 = "insert into kurse values('".$stamps[$i]."','".$dates[$i]."','".$times[$i]."','".$kurse[$i]."')";
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