<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<div id="chart" style="width: 500px; margin: 0 auto;"></div>

	<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
	<script type="text/javascript">
		var options = {
		  chart: {
		    type: 'bar',
		  },
		  series: [{
		      name: 'Denuncias por año',
		      data: ["1","1"]	  
		  }],
		  xaxis: {
		    categories: ["DESECHA","INFUNDADA"]
		  },
		}
		var chart = new ApexCharts(document.querySelector("#chart"), options);
		chart.render();
	</script>
</body>
</html>