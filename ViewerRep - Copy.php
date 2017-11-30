<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="X-UA-Compatible" content="IE=11"/>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.6.1.min.js"></script>
</head>

<body>
	<?php
		$mysqli = mysqli_connect("localhost", "root", "", "wf");
		$query = "select * from kurse order by stamp asc limit 20 ";
		$res = mysqli_query($mysqli,$query);
		
		$valString = "";
		$stmpString = "";
		
		while ($row = $res->fetch_assoc()) {
	    	$values[] = $row['kurs'];
	    	$valString .= ",".$row['kurs'];
   	    	$stmpString .= ",'".date('d.m.Y H:i',$row['stamp'])."'";
	    }
	    
	    $valString = substr($valString, 1,999999999);
   	    $stmpString = substr($stmpString, 1,999999999);
	?>

<pre>
	<?php
		//print_r($values);
	?>
</pre>


        <script>
        
        
        valString = "<?php echo $valString ?>";
        stmpString = "<?php echo $stmpString ?>";
        
        vals = valString.split(",");
        labs = stmpString.split(",");
        
        vals = [1,2,3,7,25,10,18];
       // labs = [1,2,3,7];
        
        
            var graph;
            var xPadding = 30;
            var yPadding = 30;
                      
            
           // Returns the max Y value in our data list
            function getMaxY() {
                var max = 0;
                
                for(var i = 0; i < vals.length; i ++) {
                    if(vals[i] > max) {
                        max = vals[i];
                    }
                }
                
                max += 10 - max % 10;
                return max;
            }
            
            // Return the x pixel for a graph point
            function getXPixel(val) {
                return ((graph.width() - xPadding) / vals.length) * val + (xPadding * 1.5);
            }
            
            // Return the y pixel for a graph point
            function getYPixel(val) {
                return graph.height() - (((graph.height() - yPadding) / getMaxY()) * val) - yPadding;
            }

            $(document).ready(function() {
                graph = $('#graph');
                var c = graph[0].getContext('2d');            
                
                c.lineWidth = 2;
                c.strokeStyle = '#333';
                c.font = 'italic 8pt sans-serif';
                c.textAlign = "center";
                
                // Draw the axises
                c.beginPath();
                c.moveTo(xPadding, 0);
                c.lineTo(xPadding, graph.height() - yPadding);
                c.lineTo(graph.width(), graph.height() - yPadding);
                c.stroke();
                
                // Draw the X value texts
                for(var i = 0; i < vals.length; i ++) {
                    c.fillText(labs[i], getXPixel(i), graph.height() - yPadding + 20);
                }
                
                // Draw the Y value texts
                c.textAlign = "right"
                c.textBaseline = "middle";
                
                for(var i = 0; i < getMaxY(); i += 10) {
                    c.fillText(i, xPadding - 10, getYPixel(i));
                }
                
                c.strokeStyle = '#f00';
                
                // Draw the line graph
                c.beginPath();
                c.moveTo(getXPixel(0), getYPixel(vals[0]));
                for(var i = 1; i < vals.length; i ++) {
                    c.lineTo(getXPixel(i), getYPixel(vals[i]));
                }
                c.stroke();
                
                // Draw the dots
                c.fillStyle = '#333';
                
                for(var i = 0; i < vals.length; i ++) {  
                    c.beginPath();
                    c.arc(getXPixel(i), getYPixel(vals[i]), 4, 0, Math.PI * 2, true);
                    c.fill();
                }
            });
        </script>


        <canvas id="graph" width="1900" height="920">   
        </canvas> 
    </body>

</html>