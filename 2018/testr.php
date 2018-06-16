elseif ($x == 2){
	?>
	<script>
	AmCharts.addInitHandler(function(chart) {
		// check if there are graphs with autoColor: true set
		for(var i = 0; i < chart.graphs.length; i++) {
		  var graph = chart.graphs[i];
		  if (graph.autoColor !== true)
			continue;
		  var colorKey = "autoColor-"+i;
		  graph.lineColorField = colorKey;
		  graph.fillColorsField = colorKey;
		  for(var x = 0; x < chart.dataProvider.length; x++) {
			var color = chart.colors[x];
			var f1 = chart.dataProvider[x].income;
			var f2 = chart.dataProvider[x].expenses;
			if(f1 < f2){
				//alert("yes")
				  chart.dataProvider[x][colorKey] = "green";
			}
			else{
				//alert("no")
				chart.dataProvider[x][colorKey] = "red";
			}
			//alert(f1)
	  
			//chart.dataProvider[x][colorKey] = color;
			//chart.dataProvider[x][colorKey] = "<?php echo $i?>";
		  }
		}
	  }, ["serial"]);
</script>