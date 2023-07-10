<br/>
<div class="container">
	<div class="row">
		<div class="col-md-12">	
			<h5>Capacitaciones en el año</h5>	
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th class="text-center">fecha</th>
						<th>Tema</th>
						<th class="text-center">Participantes</th>
						<th class="text-center">Hombres</th>
						<th class="text-center">Mujeres</th>
					</tr>
				</thead>
				<tbody>		
					<?php
						$id = $_GET['id'];
						$anio = $_GET['anio'];

						require('conexion.php');
						$consulta = "SELECT * FROM capacitaciones WHERE anio=$anio AND id_busqueda=$id";
						$stmt = $db_con->prepare($consulta);
						$stmt->execute();

						$count = $stmt->rowCount();
						
						$datos_si_trim = [];
						for ($i=0; $i<$count; $i++)
						{
							$row = $stmt->fetch(PDO::FETCH_ASSOC);
							echo "<tr>";
							echo "  <td class=\"text-center\">".$row['fecha']."</td>";
							echo "  <td>".$row['tema']."</td>";
							echo "  <td class=\"text-center\">".$row['participantes']."</td>";
							echo "  <td class=\"text-center\">".$row['hombres']."</td>";
							echo "  <td class=\"text-center\">".$row['mujeres']."</td>";
							echo "</tr>";
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>