<?php
	//$so = $_POST['so'];
	//$anio = $_POST['anio'];
	$id = $_GET['id'];
	$anio = $_GET['anio'];

	require('conexion.php');
	$consulta = "SELECT * FROM verificaciones WHERE anio=$anio AND id_busqueda=$id";
	$stmt = $db_con->prepare($consulta);
	$stmt->execute();

	$count = $stmt->rowCount();
	
	$datos = [];
	for ($i=0; $i<$count; $i++)
	{
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$so=$row['sujeto_obligado'];
		array_push($datos, $row['1verif']*100);
		array_push($datos, $row['2verif']*100);
		array_push($datos, $row['3verif']*100);
		array_push($datos, $row['4verif']*100);
		//$total_si = $row['total'];
	}
?>
<br/>
<div class="container">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<h5>Verificaciones</h5>
			<div id="chart"></div>
		</div>
		<div class="col-md-3"></div>
	</div>

	<div class="row">
		<?php
			/*$consulta = "SELECT * FROM solicitudes_detalle WHERE anio=$anio AND id_busqueda=$id ORDER BY orden";
			$stmt = $db_con->prepare($consulta);
			$stmt->execute();

			$count = $stmt->rowCount();
			
			for ($i=0; $i<$count; $i++)
			{
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				$detalle = $row['detalle'];
				$valor = $row['valor'];

				$tarjeta = "<div class=\"col-md-4\" style=\"padding: 1em;\">
							  <div class=\"card text-center\">
							    <h2 class=\"card-header\">
                                  $valor
                                </h2>
							    <div class=\"card-body\">
						          <h3 class=\"text-center\">$detalle</h3>
							    </div>
							  </div>
							</div>";
				echo $tarjeta;
			}*/
		?>
	</div>
</div>

<script type="text/javascript">
	var options = {
	  chart: {
	    type: 'bar'
	  },
	  series: [
	  	{
	    	name: 'Solicitudes de Acceso',
	    	data: <?php echo json_encode($datos); ?>
	    },
	    ],
	  xaxis: {
	    categories: ["1 Verif","2 Verif","3 Verif","4 Verif"]
	  },
	  markers: 
	  {
    	size: 2,
	  },
	}

	var chart = new ApexCharts(document.querySelector("#chart"), options);

	chart.render();
</script>
