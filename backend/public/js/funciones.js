function saludo()
{
	alert("ñandú lalá");
}
function eliminar(url)
{
	if(window.confirm('¿Realmente desea eliminar este registro?'))
	{
		window.location=url;
	}
}