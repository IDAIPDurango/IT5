<?php
function imprimir_select_sujetos_obligados($anio)
{
	require('conexion.php');
	$consulta = "SELECT id_busqueda, sujeto_obligado FROM solicitudes WHERE anio = $anio";
	$stmt = $db_con->prepare($consulta);
	$stmt->execute();

	$select_so  ="<select class='form-control' id='so'>";
	$count = $stmt->rowCount();
	for ($i=0; $i<$count; $i++)
	{
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$id = ($row['id_busqueda']);
		$so = ($row['sujeto_obligado']);

		$select_so .= "  <option value=\"$id\">$so</option>";
	}

	$select_so .="</select>";
	echo $select_so;
}

	