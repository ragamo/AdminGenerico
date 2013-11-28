<div class="header">
	<div class="container">
		<h1>Inicio</h1>
		<p>Dashboard</p>
	</div>
</div>

<div class="container">
	<div class="dashboard">
		
		<div class="row-fluid">
			<div class="span4 linkeable" data-href="{$BASE_URL}/proyectos">
				<h1>{$totalProyectos}</h1>
				<p>Proyectos</p>
			</div>
			<div class="span4 linkeable" data-href="{$BASE_URL}/modelos">
				<h1>{$totalModelos}</h1>
				<p>Modelos</p>
			</div>
			<div class="span4 linkeable" data-href="{$BASE_URL}/media">
				<h1>{$totalArchivos}</h1>
				<p>Archivos</p>
			</div>
		</div>

		<div class="row-fluid">
			{literal}
			<script type="text/javascript" src="//www.google.com/jsapi"></script>
			<script type="text/javascript">
			google.load('visualization', '1');
		 	function drawVisualization() {
				var wrapper = new google.visualization.ChartWrapper({
					chartType: 'ColumnChart',
					dataTable: [['', 'Proyectos', 'Modelos', 'Archivos'],
			          			{/literal}['', {$totalProyectos}, {$totalModelos}, {$totalArchivos}]],{literal}
					options: {'title': 'Resumen'},
					containerId: 'visualization'
				});
				wrapper.draw();
			}

			google.setOnLoadCallback(drawVisualization);
			</script>
			{/literal}
			<div class="graph">
				<div id="visualization" style="width: 940px; height: 400px;"></div>
			</div>
		</div>

	</div>
</div>