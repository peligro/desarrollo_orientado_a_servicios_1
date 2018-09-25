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
function alpha(e) 
         {
         key = e.keyCode || e.which;
           tecla = String.fromCharCode(key).toLowerCase();
           //alert(key);
           letras = " ÃƒÂ¡ÃƒÂ©ÃƒÂ­ÃƒÂ³ÃƒÂºabcdefghijklmnÃƒÂ±opqrstuvwxyz";
           //especiales = [8,37,39,46];
            especiales = [8,39,46,241,225,233,237,243,250];
           tecla_especial = false
           for(var i in especiales){
                if(key == especiales[i]){
                    tecla_especial = true;
                    break;
                } 
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
}

function soloNumeros(evt)
{
  key = (document.all) ? evt.keyCode :evt.which;
  //alert(key);
    if(key==17)return false;
  /* digitos,del, sup,tab,arrows*/
  return ((key >= 48 && key <= 57) || key == 8 || key == 127 || key == 9 || key==0);
}