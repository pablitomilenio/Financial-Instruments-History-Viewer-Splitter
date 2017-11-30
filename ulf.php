<!DOCTYPE html>
<html>
<body>

<form action="upload.php" method="post" enctype="multipart/form-data">

<HR>WICHTIG:Bitte stellen Sie sicher, dass der Maximalzeitraum ueber die gasamte Existenz des Wikifolios ausgewaehlt wurde. Notfalls seit 2011
"Download wikifolio Kurs 60 min" => Bitte auf diesen Link auf der Wikifolio Seite druecken, und nicht woanders
 |
<HR>

    Bitte waehlen Sie hier ihre CSV Datei aus:
    <input type="file" name="fileToUpload" id="fileToUpload" value="auswaehlen...">
    <input type="submit" value="Upload starten" name="submit"  onfocus="setInterval('cdwn()',1000);">
</form>
<br>
<div id="secs"></div>
<script>
	i = 600;
	function cdwn() {
	i--;
		document.getElementById("secs").innerHTML = "Bitte warten Sie ca:"+i+" Sekunden";
	}
	
</script>


</body>
</html> 