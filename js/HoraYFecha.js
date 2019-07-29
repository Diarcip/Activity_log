function HoraYFecha(){

  var fechaactividad = document.getElementById('Fecha');
  var horainicio = document.getElementById('Hora_inicio');
  var horafin = document.getElementById('Hora_fin');

  var fecha = fechaactividad.value;
  var hora1 = horainicio.value;
  var hora2 = horafin.value;

  var hoy = new Date();
  var year = hoy.getFullYear();
  var month = hoy.getMonth()+1;
  var date = hoy.getDate();
  var fechahoy = year+'-'+month+'-'+date;
  var fechamenosdos = year+'-'+month+'-'+(date-2);

  if(fecha>fechahoy || fecha<fechamenosdos){
    fechaactividad.setCustomValidity('Esta fecha no puede ser superior a '+fechahoy+' ni inferior a '+fechamenosdos);
    console.log(fecha);
    console.log(fechahoy);
    console.log(fechamenosdos);
    return;
  }else{
    fechaactividad.setCustomValidity('');
    if(hora2 <= hora1) {
    horafin.setCustomValidity('Este campo debe ser mayor a la hora de inicio: "'+hora1+'"');
    console.log(hora1);
    console.log(hora2);
    return;
    }
    horafin.setCustomValidity('');
  }
}
