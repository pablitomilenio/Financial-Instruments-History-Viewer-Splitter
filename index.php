<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">



<head>

<link rel="shortcut icon" href="favicon.ico" />

<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />

<title>Wikifolio Auswahl - Startseite</title>

<style>

body{

	background-color:#FFCCFF;

	font-family:Georgia, "Times New Roman", Times, serif;

	padding-left:20px;

	overflow:hidden;

}

#stat{

	position:absolute;

	left:65%;

	top:0;

	background-color:aqua;

	z-index:10;

}

#tit{

	font-size:100pt;

	z-index:100;

	position:absolute;

		text-shadow: 2px 7px #ffffff;

}

#btm{

	position:absolute;

	bottom:50px;

	left:20px;

	width:100%;

}

</style>

</head>



<body>

<div id="tit">High Finance for Wikifolio</div>

<br><br><br><br><br><br><br><br><br><br><br><br><br>

<?php 

		$mysqli = mysqli_connect("sql303.byethost7.com", "b7_17746104", "public123", "b7_17746104_wf");



		//$mysqli = mysqli_connect("localhost", "root", "", "wf");

		$query = "show tables";

		$res = mysqli_query($mysqli,$query);	    



$i=1;

while ($row = mysqli_fetch_array($res,MYSQLI_NUM)) {

	    

    $tnam = ($row[0]);

    echo "<a style='font-size:35pt' href=sc.php?nam=$tnam>$i) Wikifolio $tnam verwenden</a><br>";

    $i++;

}





?>

<p></p>

<a href="ulf.php">Neues Wikifolio laden</a><br><br><br>

<br><br><br><br>

Dieses System soll Wikifolios sprichwoertlich "unter die Lupe" nehmen und alle erdenklichen Fragen zum Kursverlauf aufklaeren.<br>

Das System ist Stand Maerz 2016 natuerlich noch nicht fertig. <br>

Es fehlen die ganzen Zahlen wie Performance 1 Tag, 1 Woche etc und die Semesteransicht <br>Quartalsansicht Intradayansicht und Wochenansicht<br>

...to be continued

<div id="btm">

<hr>optimiert fuer full HD Bildschirme

</div>



<div id="stat"><img src="statue.png"></div>

</body>



</html>

