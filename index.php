<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Indicadores de Transparencia del IDAIP</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<table>
			<tr>
				<td><label>Año:</label></td>
				<td>
					<select id="anio" class="form-control">
						<option value="2021">2021</option>
						<option value="2022">2022</option>
					</select>
				</td>
			</tr>
			<tr>
				<td><label>Sujeto Obligado:</label></td>
				<td>
					<?php
						require_once("data/controles.php");
						imprimir_select_sujetos_obligados(2021);
					?>
				</td>
			</tr>
		</table>

		<table>
			<tr>
				<td style="width:20%">
					<button class="form-control" onclick="indicador_solicitudes()">Solicitudes</button>
				</td>
				<td style="width:20%">
					<button class="form-control" onclick="alert('Hola Mundo 2')">Recursos de revisión</button>
				</td>
				<td style="width:20%">
					<button class="form-control" onclick="alert('Hola Mundo 3')">Denuncias a Obligaciones de Transparencia</button>
				</td>
				<td style="width:20%">
					<button class="form-control" onclick="alert('Hola Mundo 4')">Verificaciones de Obligaciones de Transparencia</button>
				</td>
				<td style="width:20%">
					<button class="form-control" onclick="alert('Hola Mundo 5')">Capacitaciones</button>
				</td>
			</tr>
		</table>
	</div>

	<div id="resultado">
		
	</div>

	<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
	<script type="text/javascript" src="js/it5.js">
	</script>
</body>
</html>