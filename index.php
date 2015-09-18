<!DOCTYPE HTML>
<html>

<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script type="text/javascript">
	window.onload = function () {

		var dps = []; // dataPoints

		var chart = new CanvasJS.Chart("chartContainer",{
			title :{
				text: "Temperatura"
			},
			axisY: {
				title: "C"
			},
			axisX: {
				title: "T"
			},
			data: [{
				type: "line",
				dataPoints: dps
			}]
		});

		var xVal = 0;
		var yVal = 0;
		var updateInterval = 1000;
		var dataLength = 50; // number of dataPoints visible at any point

		var updateChart = function (count) {
			count = count || 1;
			// count is number of times loop runs to generate random dataPoints.

			for (var j = 0; j < count; j++) {

				$.getJSON( "http://wasp.ddns.net/temperatura.php", function( data ) {
					yVal = parseFloat(data[0]);
				});
				dps.push({
 					x: xVal,
 					y: yVal
 				});
 				xVal++;
 			}

 			if (dps.length > dataLength)
			{
				dps.shift();
			}

			chart.render();

		};

		//***********************************************************************//
		var dps2 = []; // dataPoints

		var chart2 = new CanvasJS.Chart("chartContainer2",{
			title :{
				text: "Humedad"
			},
			axisY: {
				title: "%H"
			},
			axisX: {
				title: "T"
			},
			data: [{
				type: "line",
				dataPoints: dps2
			}]
		});

		var xVal2 = 0;
		var yVal2 = 0;
		var updateInterval2 = 1000;
		var dataLength2 = 50;

		var updateChart2 = function (count) {
			count = count || 1;

			for (var j = 0; j < count; j++) {
					$.getJSON( "http://wasp.ddns.net/humedad.php", function( data ) {
						yVal2 = parseFloat(data[0]);
					});
					dps2.push({
	 					x: xVal2,
	 					y: yVal2
	 				});
	 				xVal2++;
 			}

 			if (dps2.length > dataLength2)
			{
					dps2.shift();
			}

			chart2.render();

		};

		updateChart(dataLength);
		setInterval(function(){updateChart()}, updateInterval);

		updateChart2(dataLength2);
		setInterval(function(){updateChart2()}, updateInterval2);


	}
	</script>
	<script type="text/javascript" src="canvasjs.min.js"></script>
</head>
<body>
	<div id="chartContainer" style="height: 300px; width:500px;">
	</div>

	<div id="chartContainer2" style="height: 300px; width:500px;">
	</div>
</body>
</html>
