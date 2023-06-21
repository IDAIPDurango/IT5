function indicador_solicitudes()
{
	anio = $("#anio").val();
	id = $("#so").val();

	$( "#resultado" ).load( "data/solicitudes.php?anio="+anio+"&id="+id);
}