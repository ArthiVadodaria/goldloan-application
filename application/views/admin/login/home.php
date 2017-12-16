<!DOCTYPE html>
<html>
<head>
	<title>HOME | GOLD LOAN</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">	
	<style>
		.thumbnail{    background-color: rgb(252, 238, 163);;
    padding-left: inherit;
		}
    </style>
	 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> 
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 
    <script type="text/javascript"> 
     
    // Load the Visualization API and the piechart package. 
    google.charts.load('current', {'packages':['corechart']}); 
       
    // Set a callback to run when the Google Visualization API is loaded. 
    google.charts.setOnLoadCallback(drawChart); 
       
    function drawChart() { 
      var jsonData = $.ajax({//load ourchart controller_getdata 
          url: "<?php echo '../../gl/Our_Chart/getdata' ?>", 
          dataType: "json", 
          async: false 
          }).responseText; 
           
      // Create our data table out of JSON data loaded from server. 
      var data = new google.visualization.DataTable(jsonData); 
 

      // Instantiate and draw our chart, passing in some options. 
      var chart = new google.visualization.BarChart(document.getElementById('chart_div')); 
      
	  
	  chart.draw(data, {width: 900, height: 400}); 
    } 
 
    </script>
</head>
<body>
	<div class="container">
	<div class = "col-sm-6 col-md-6" class = "thumbnail">
		<div class="thumbnail">
			<h3 style=" font-size:40px; color:white;   text-align: center;">Customers</h3>
			<?php echo "<h2 style=' font-size:40px; color:white;  text-align: center;'>$cc</h2>"?>
		</div>
	</div>
	
	<div class = "col-sm-6 col-md-6" class = "thumbnail">
		<div class="thumbnail">
			<h3 style=" font-size:40px; color:white;  text-align: center;">Loans</h3>
			<?php echo "<h2 style=' font-size:40px; color:white;  text-align: center;'>$lc</h2>"?>
			
		</div>
	</div>
	</div> 
		<div class="container">
		<h2>Graphical Representation for the no of loans</h2>
	    <div id="chart_div"></div>
		</div>
	</div>
	<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
</body>
</html>