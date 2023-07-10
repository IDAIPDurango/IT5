<?php
	//$so = $_POST['so'];
	//$anio = $_POST['anio'];
	$id = $_GET['id'];
	$anio = $_GET['anio'];

	require('conexion.php');
	$consulta = "SELECT * FROM solicitudes WHERE tipo_solicitud='SI' AND anio=$anio AND id_busqueda=$id";
	$stmt = $db_con->prepare($consulta);
	$stmt->execute();

	$count = $stmt->rowCount();
	
	$datos = [];
	for ($i=0; $i<$count; $i++)
	{
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$so=$row['sujeto_obligado'];
		array_push($datos, $row['ene']);
		array_push($datos, $row['feb']);
		array_push($datos, $row['mar']);
		array_push($datos, $row['abr']);
		array_push($datos, $row['may']);
		array_push($datos, $row['jun']);
		array_push($datos, $row['jul']);
		array_push($datos, $row['ago']);
		array_push($datos, $row['sep']);
		array_push($datos, $row['oct']);
		array_push($datos, $row['nov']);
		array_push($datos, $row['dic']);
		$total_si = $row['total'];
	}

	$consulta = "SELECT * FROM solicitudes WHERE tipo_solicitud='DP' AND anio=$anio AND id_busqueda=$id";
	$stmt = $db_con->prepare($consulta);
	$stmt->execute();

	$count = $stmt->rowCount();
	
	$datos_dp = [];
	for ($i=0; $i<$count; $i++)
	{
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$so=$row['sujeto_obligado'];
		array_push($datos_dp, $row['ene']);
		array_push($datos_dp, $row['feb']);
		array_push($datos_dp, $row['mar']);
		array_push($datos_dp, $row['abr']);
		array_push($datos_dp, $row['may']);
		array_push($datos_dp, $row['jun']);
		array_push($datos_dp, $row['jul']);
		array_push($datos_dp, $row['ago']);
		array_push($datos_dp, $row['sep']);
		array_push($datos_dp, $row['oct']);
		array_push($datos_dp, $row['nov']);
		array_push($datos_dp, $row['dic']);
		$total_dp = $row['total'];
	}

	$consulta = 
		"SELECT 
			ene+feb+mar AS 1_trim,
			abr+may+jun AS 2_trim,
			jul+ago+sep AS 3_trim,
			oct+nov+dic AS 4_trim
		FROM 
		   solicitudes 
		WHERE 
		   anio=$anio 
			AND tipo_solicitud='SI' 
		    AND id_busqueda=$id";
	$stmt = $db_con->prepare($consulta);
	$stmt->execute();

	$count = $stmt->rowCount();
	
	$datos_si_trim = [];
	for ($i=0; $i<$count; $i++)
	{
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		array_push($datos_si_trim, $row['1_trim']);
		array_push($datos_si_trim, $row['2_trim']);
		array_push($datos_si_trim, $row['3_trim']);
		array_push($datos_si_trim, $row['4_trim']);
		//array_push($datos_si_trim, $row['total']);
	}

	$consulta = 
		"SELECT 
			ene+feb+mar AS 1_trim,
			abr+may+jun AS 2_trim,
			jul+ago+sep AS 3_trim,
			oct+nov+dic AS 4_trim
		FROM 
		   solicitudes 
		WHERE 
		   anio=$anio 
			AND tipo_solicitud='DP' 
		    AND id_busqueda=$id";
	$stmt = $db_con->prepare($consulta);
	$stmt->execute();

	$count = $stmt->rowCount();
	
	$datos_dp_trim = [];
	for ($i=0; $i<$count; $i++)
	{
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		array_push($datos_dp_trim, $row['1_trim']);
		array_push($datos_dp_trim, $row['2_trim']);
		array_push($datos_dp_trim, $row['3_trim']);
		array_push($datos_dp_trim, $row['4_trim']);
		//array_push($datos_si_trim, $row['total']);
	}
?>
<br/>
<div class="container">
	<div class="row">
		<div class="col-md-6">
			<h5>Solicitudes por mes</h5>
			<div id="chart"></div>
		</div>
		<div class="col-md-6">
			<h5>Solicitudes por trimestre</h5>
			<div id="chart_trim"></div>
		</div>
	</div>

	<div class="row">
		<?php
			$consulta = "SELECT * FROM solicitudes_detalle WHERE anio=$anio AND id_busqueda=$id ORDER BY orden";
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
			}
		?>
	</div>
</div>

<script type="text/javascript">
	var options = {
	  chart: {
	    type: 'area'
	  },
	  series: [
	  	{
	    	name: 'Solicitudes de Acceso',
	    	data: <?php echo json_encode($datos_si_trim); ?>
	    },
	    {
			name: 'Solicitudes de Datos Personales',
	    	data: <?php echo json_encode($datos_dp_trim); ?>
	    }
	    ],
	  xaxis: {
	    categories: ["1er Trim", "2do Trim", "3er Trim", "4to Trim"]
	  },
	  markers: 
	  {
    	size: 2,
	  },
	  stroke: {
  		curve: 'smooth',
	  }
	}

	var chart = new ApexCharts(document.querySelector("#chart_trim"), options);

	chart.render();
</script>

<script type="text/javascript">
	var options = {
	  chart: {
	    type: 'line'
	  },
	  series: [
	  	{
	    	name: 'Solicitudes de Acceso',
	    	data: <?php echo json_encode($datos); ?>
	    },
	    {
			name: 'Solicitudes de Datos Personales',
	    	data: <?php echo json_encode($datos_dp); ?>
	    }
	    ],
	  xaxis: {
	    categories: ["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"]
	  },
	  markers: 
	  {
    	size: 2,
	  },
	  stroke: {
  		curve: 'smooth',
	  }
	}

	var chart = new ApexCharts(document.querySelector("#chart"), options);

	chart.render();
</script>
