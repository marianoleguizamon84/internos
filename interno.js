window.onload = function(event){
  var tabla = document.getElementsByTagName('tbody');
  var largo = window.innerHeight - 160;
  tabla[0].style.height = largo + "px";
  document.getElementById('buscar').focus();
}

window.onresize = function(event){
  var tabla = document.getElementsByTagName('tbody');
  var largo = window.innerHeight - 160;
  tabla[0].style.height = largo + "px";
}

function nuevo(){
  document.getElementById('formu').action = "nuevo.php";
  document.getElementById('interno').value = "";
  document.getElementById('usuario').value = "";
  document.getElementById('sede').value = "";
  document.getElementById('observaciones').value = "";
  document.getElementById('myModalLabel').innerText = "Nuevo Interno";
  document.getElementById('borrarBtn').style.display = 'none';
  $('#myModal').modal('toggle');
}

function interno(int){
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            texto = xmlhttp.responseText;
            objeto = JSON.parse(xmlhttp.responseText);
            document.getElementById('formu').action = "editar.php?id="+int;
            document.getElementById('interno').value = objeto[0].interno;
            document.getElementById('usuario').value = objeto[0].usuario;
            document.getElementById('sede').value = objeto[0].sede;
            document.getElementById('observaciones').value = objeto[0].observaciones;
            document.getElementById('myModalLabel').innerText = "Editar Interno " + objeto[0].interno;
            document.getElementById('borrarTitulo').innerText = "Desea borrar el interno " + objeto[0].interno + "?";
            document.getElementById('borrarA').href = 'borrar.php?id=' + int;
            $('#myModal').modal('toggle');
            document.getElementById('borrarBtn').style.display = 'inline';
        }
    };
    xmlhttp.open("GET", "interno.php?id="+int, true);
    xmlhttp.send();
}

function buscar(){
  var valor = document.getElementById('buscar').value;
  valor = cadenaSimple(valor);
  filtro = valor.toUpperCase();
  var intBool, userBool, sedeBool, obsBool;
  var tr = document.getElementsByTagName('tr');
  for (var i = 1; i < tr.length; i++) {
    internoVar  = tr[i].getElementsByTagName('td')[0];
    usuario     = tr[i].getElementsByTagName('td')[1];
    sede        = tr[i].getElementsByTagName('td')[2];
    observacion = tr[i].getElementsByTagName('td')[3];
    intBool  = filtroBoolean(internoVar);
    userBool = filtroBoolean(usuario);
    sedeBool = filtroBoolean(sede);
    obsBool  = filtroBoolean(observacion);
    if (intBool || userBool || sedeBool || obsBool) {
      tr[i].style.display = "";
    } else {
      tr[i].style.display = "none";
    }
  }
}

function filtroBoolean(obj){
    var cadena = obj.innerHTML;
    cadena = cadenaSimple(cadena);
    if (cadena.toUpperCase().indexOf(filtro) > -1) {
      return true;
    } else {
      return false;
    }
}

function cadenaSimple(texto){
  texto = texto.replace(/á/gi,"a");
  texto = texto.replace(/é/gi,"e");
  texto = texto.replace(/í/gi,"i");
  texto = texto.replace(/ó/gi,"o");
  texto = texto.replace(/ú/gi,"u");
  texto = texto.replace(/ñ/gi,"n");
  return texto;
}

function borrar() {
  $('#myModal').modal('hide');
  $('#modalBorrar').modal('toggle');
}

function borrarCancelar() {
  $('#modalBorrar').modal('hide');
  $('#myModal').modal('toggle');
}
