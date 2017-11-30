  
        valString = "<?php echo $valString ?>";
        stmpString = "<?php echo $stmpString ?>";
        
        vals = valString.split(",");
        labs = stmpString.split(",");
        
        //vals = [25,10,18,17,30];
        //labs = [1,2,3,7];
        
        
        for(i=0;i<vals.length;i++) vals[i] = parseFloat(vals[i]); //floatconv
        
            var graph;
            var xPadding = 30;
            var yPadding = 30;
                      
            
            
            function getMaxY() {
				var max = 0;
		
				for(var i = 0; i < vals.length; i ++) {
					if(vals[i] > max) {
					max = vals[i];
					}
				}
		
			//console.log("maxY:"+max);
			return max;

			}

            
            
        	function getMinY() {
				var min = 2000;
		
				for(var i = 0; i < vals.length; i ++) {
					if(vals[i] < min) {
					min = vals[i];
					}
				}
			
			//console.log("minY:"+min);
			return min;

			}
			
			minval = getMinY();
			maxval = getMaxY();
			
			valsOrig = vals;
			for(cd=0;cd<vals.length;cd++) vals[cd] = vals[cd]-minval;
			
			s = Smooth(vals);
			


            
            // Return the x pixel for a graph point
            function getXPixel(val) {
                return ((graph.width() - xPadding) / vals.length) * val + (xPadding * 1.5);
            }
            
            // Return the y pixel for a graph point
            function getYPixel(val) {
                return graph.height() - (((graph.height() - yPadding*3) / getMaxY()) * val) - yPadding;
            }

///////////////////////////
            function drawLine(gn) {
                graph = $('#graph'+gn);
                var c = graph[0].getContext('2d');            
                
               	c.clearRect(0,0,999999,999999);
               	
               	if(gn!=0) {
	               	c.font = '13pt arial';
	                c.fillText(Math.round((1-lv/fv)*-10000)/100+"%",40,20);
				}
                
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
                   if(gn==0) c.fillText(labs[i], getXPixel(i), graph.height() - yPadding + 20);
                }
                
                // Draw the Y value texts
                c.textAlign = "right"
                c.textBaseline = "middle";
                
                for(var i = 0; i < getMaxY(); i += 10) {
//                    c.fillText(i, xPadding - 10, getYPixel(i));
                }
                
                
                              
                
                // Draw the line graph
                c.beginPath();
                c.strokeStyle = '#0000ff';
                c.moveTo(getXPixel(0), getYPixel(vals[0]));
                
                for(i = 1; i<vals.length*20; i++) {                
                	c.lineTo(getXPixel(i/20),getYPixel(s(i/20)));
                }               
                c.stroke();

                
   if(gn==0)     {         
                // KRISENDECKEL
                
                vors = new Array();
               	vc = 0;
                for(i = 1; i<vals.length; i++) {                
                	if(vals[i-1]>=vals[i]) vors[vc++] = i-1;
                }               
                
                consec = new Array();
                for(i=0;i<vors.length;i++) {
                	if(vors[i]+1 == vors[i+1]) consec[i] = 1;
                	else consec[i]=0;
                }
                
                for(i=0;i<vors.length;i++) {
                	if(consec[i]==1) vors[i+1] = 0;
                }

                vors2 = new Array();
                q=0;
                for(i=0;i<vors.length;i++) {
                	if(vors[i]!=0) vors2[q++] = vors[i];
                }
				vors = vors2;
                
				xStart = new Array();
				xEnd = new Array();
				yLevel = new Array();
				iStart = new Array();
				iEnd = new Array();

                for(q=0;q<vors.length;q++) {
	                c.beginPath();
	                c.strokeStyle = '#0000ff';

	              	valsY = getYPixel(vals[vors[q]]);	 
		            valsX = getXPixel(vors[q]);
					maxX = 0;
					prev = 0;
					cnt = 0;
					cnt2 = 0;
	                for(i = 1; i<vals.length*20; i++) {    
		                if((getYPixel(s(i/20))>valsY)&&(getXPixel(i/20)>valsX)) maxX = getXPixel(i/20); 
		               	if((getYPixel(s(i/20))==valsY)&&(getXPixel(i/20)==valsX)) iStart[q] = i;
		                diff = (maxX-prev);
		                //console.log(diff);
		                if (Math.round(diff) >0 && Math.round(diff) < 100 ) cnt++;
		                if (diff == 0 && cnt > 10) {
		                	iEnd[q] = i;
							break;
		                }
		                prev = maxX;
	                }  
	                c.moveTo(valsX,valsY);
	                c.lineTo(maxX,valsY);
	                //c.stroke();       
	                xStart[q] = valsX;
	                xEnd[q] = maxX;
	                yLevel[q] = valsY;      
				}
	
                
                //Draw Crisis
               	c.beginPath();
                var my_gradient=c.createLinearGradient(0,0,0,1080);
				my_gradient.addColorStop(0,"black");
				my_gradient.addColorStop(0.5,"red");
				my_gradient.addColorStop(1,"white");
				c.fillStyle=my_gradient;
                for(q=0;q<vors.length;q++) {
	                c.moveTo(xEnd[q], yLevel[q]);
	                c.lineTo(xStart[q], yLevel[q]);
	                for(i = iStart[q]; i<iEnd[q]; i++) {                
	                	c.lineTo(getXPixel(i/20),getYPixel(s(i/20)));
	                } 
	                c.closePath();
					c.fill();
					//c.stroke();
                }
                /*
                mom1 = labsOrig[vors[0]];
                for(i = iStart[1]; getYPixel(vals[i])<valsY; i++) {                			                	
                }  
                mom2 = labsOrig[i];              
                alert(mom1+" "+mom2);
                */
       }//end crisis         
                
                
                // Draw the dots
                c.fillStyle = '#333';
                
                for(var i = 0; i < vals.length; i ++) {  
                    c.beginPath();
                    c.strokeStyle = '#00';
                    if((gn==0)) c.arc(getXPixel(i), getYPixel(vals[i]), 4, 0, Math.PI * 2, true);
                    else c.arc(getXPixel(i), getYPixel(vals[i]), 2.5, 0, Math.PI * 2, true);

                    if((i%1==0)&&(gn==0)) c.fillText(i+" "+Math.round((vals[i]+minval)*10)/10,getXPixel(i), getYPixel(vals[i])-10);
                    c.fill();
       
                }               
                
                
                
                //Draw Horizontal separators
                
  			sh = 920;
  			numLines = 8;
  			
  			interval = sh/numLines;
  			iv = interval;
  			
  			numdiff = maxval-minval
  							
       		var linesArr = [0,iv,iv*2,iv*3,iv*4,iv*5,iv*6,iv*7];
			for(f=0;f<linesArr.length;f++) {
				if (c.setLineDash) c.setLineDash([2,2]);
				c.moveTo(xPadding*2+10,  linesArr[f]+yPadding);
				c.lineTo(99999,  linesArr[f]+yPadding);
				linePerc = numdiff/numLines*(f)+minval;
				lp2 = maxval/linePerc;
				if(gn==0) c.fillText("+"+Math.round((lp2*100-100)*10)/10+"%", xPadding*2+5, linesArr[f]+yPadding); // Here are the Y-Axis labels
				c.strokeStyle = 'lightgray';
				if(gn==0) c.stroke();
				c.setLineDash([0,0]);
			}


            };
            
            
            
            function loadVals(mn,gn,yr) {
	            
	             $( "#contents" ).load( "ajLoad.php?parm="+$('#numVls').val()+"&rnd="+Math.random()+"&month="+mn+"&year="+yr, function() {
	             
	 
 			    cArr = $('#contents').html().split(";");
 			    
 			    //if (cArr[0] < 1) break;
					  
			    valString = cArr[0];
        		stmpString = cArr[1];
        
		        vals = valString.split(",");
		        labs = stmpString.split(",");
		        valsOrig = vals;
		        
		        q=0;
		        valsTrim = new Array();
		        labsTrim = new Array();

		        for(i=0;i<vals.length;i++) {
		        	if (i%10==0) valsTrim[q] = vals[i];
		        	if (i%10==0) labsTrim[q++] = labs[i];

		        }
		        
		        fv = vals[0];
		        lv = vals[vals.length-1];
		        
		        valsTrim.pop();
		        valsTrim.push(lv);		        
		        
		        vals = valsTrim;
		        labsOrig = labs;
		        labs = labsTrim;
		        
		        
		        
		        firstval = Math.round(vals[0]*10)/10;
		        lastval = Math.round(vals[vals.length-1]*10)/10;
		        monat = mn;
		        
		       	valsOrig = vals;
		        elim = Math.ceil(vals.length/10);
		        
		        for(i=0;i<labs.length;i++) {
		        	if((i%elim) != 0) labs[i] = "";
		        }
		        
		        for(i=0;i<vals.length;i++) vals[i] = parseFloat(vals[i]); //floatconv
		        
		        minval = getMinY();
				maxval = getMaxY();
				

				for(cd=0;cd<vals.length;cd++) vals[cd] = vals[cd]-minval;
			
				s = Smooth(vals);

        
				drawLine(gn);
				
				
				ratio = lastval/firstval;
				if (ratio > 1) {
					typ = "Gewinn"; 
					erg = Math.round((ratio-1)*100*1000)/1000;
					}
				else {
					typ = "Verlust";
					erg = Math.round((1-ratio)*10000)/100;
				}
				contStr = "Der Monat "+monat+" wurde mit €"+firstval+" begonnen und mit €"+lastval+" abgeschlossen<br>Das ist ein "+typ+" von "+erg+"%";
				contStr += "<hr> Wenn alle Monate so wären, so würde das Jahr einen "+typ+" von "+Math.round(erg*12*100)/100+"% verbuchen";
				$('#resumen').html(contStr);
				
				//$('#graph').width(window.innerWidth*0.55);
				//$('#graph').height(window.innerHeight*0.95);

				});


           	}
