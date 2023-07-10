function indicador_solicitudes()
{
	anio = $("#anio").val();
	id = $("#so").val();

	$( "#resultado" ).load( "data/solicitudes.php?anio="+anio+"&id="+id);
}

function indicador_recursos()
{
	anio = $("#anio").val();
	id = $("#so").val();

	$( "#resultado" ).load( "data/recursos.php?anio="+anio+"&id="+id);
}

function indicador_denuncias()
{
	anio = $("#anio").val();
	id = $("#so").val();

	$( "#resultado" ).load( "data/denuncias.php?anio="+anio+"&id="+id);
}

function indicador_verificaciones()
{
	anio = $("#anio").val();
	id = $("#so").val();

	$( "#resultado" ).load( "data/verificaciones.php?anio="+anio+"&id="+id);
}

function indicador_capacitaciones()
{
	anio = $("#anio").val();
	id = $("#so").val();

	$( "#resultado" ).load( "data/capacitaciones.php?anio="+anio+"&id="+id);
}