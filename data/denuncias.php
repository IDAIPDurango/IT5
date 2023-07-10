<?php
	//$so = $_POST['so'];
	//$anio = $_POST['anio'];
	$id = $_GET['id'];
	$anio = $_GET['anio'];

	require('conexion.php');
	$consulta = "SELECT 
				   COUNT(CASE WHEN resolucion LIKE 'DESECHA' THEN 1 END) AS \"deshecha\",
				   COUNT(CASE WHEN resolucion LIKE 'INFUNDADA' THEN 1 END) AS \"infundada\",
				   COUNT(CASE WHEN resolucion LIKE 'FUNDADA' THEN 1 END) AS \"fundada\",
				   COUNT(CASE WHEN resolucion LIKE 'FUNDADA C%' THEN 1 END) AS \"con_requerimiento\",
				   COUNT(CASE WHEN resolucion LIKE 'FUNDADA S%' THEN 1 END) AS \"sin_requerimiento\"
				 FROM denuncias 
				 WHERE
				    anio=$anio AND id_busqueda=$id";

	$stmt = $db_con->prepare($consulta);
	$stmt->execute();

	$count = $stmt->rowCount();
	
	$datos = [];
	$resoluciones = ["Deshechada", "Infundada", "Fundada", "Fundada con requerimiento", "Fundada sin requerimiento"];
	for ($i=0; $i<$count; $i++)
	{
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$resolucion = $row['deshecha'];

		array_push($datos, $row['deshecha']);
		array_push($datos, $row['infundada']);
		array_push($datos, $row['fundada']);
		array_push($datos, $row['con_requerimiento']);
		array_push($datos, $row['sin_requerimiento']);
	}

?>
<br/>
<div class="container">
	<div class="row">
		<div class="col-md-3">
		</div>
		<div class="col-md-6">
			<h5>Denuncias por Año</h5>
			<div id="chart"></div>
		</div>
		<div class="col-md-2">
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">		
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th class="text-center">Expediente</th>
						<th>Sujeto Obligado</th>
						<th class="text-center">Información</th>
					</tr>
				</thead>
				<tbody>		
					<?php
						$consulta = "SELECT * FROM denuncias WHERE anio=$anio AND id_busqueda=$id";
						$stmt = $db_con->prepare($consulta);
						$stmt->execute();

						$count = $stmt->rowCount();
						
						$datos_si_trim = [];
						for ($i=0; $i<$count; $i++)
						{
							$row = $stmt->fetch(PDO::FETCH_ASSOC);
							echo "<tr>";
							echo "  <td class=\"text-center\">".$row['expediente']."</td>";
							echo "  <td>".$row['sujeto_obligado']."</td>";
							echo "  <td class=\"text-center\">".$row['resolucion']."</td>";
							echo "</tr>";
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<script type="text/javascript">
	var options = {
	  chart: {
	    type: 'bar',
	  },
	  series: [{
	      name: 'Denuncias por año',
	      data: <?php echo json_encode($datos); ?>
	  }],
	  xaxis: {
	    categories: <?php echo json_encode($resoluciones); ?>,
	  },
	}

	var chart = new ApexCharts(document.querySelector("#chart"), options);

	chart.render();
</script>

<script type="text/javascript">
	var options = {
	  chart: {
	    type: 'line'
	  },
	  series: [
	  	{
	    	name: 'Recursos de Acceso',
	    	data: <?php echo json_encode($datos); ?>
	    },
	    {
			name: 'Recursos de Datos Personales',
	    	data: <?php echo json_encode($datos_dp); ?>
	    }
	    ],
	  xaxis: {
	    categories: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"]
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
