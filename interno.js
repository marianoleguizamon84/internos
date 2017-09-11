window.onload = function(event){
  var tabla = document.getElementsByTagName('tbody');
  var largo = window.innerHeight - 160;
  tabla[0].style.height = largo + "px";
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
            $('#myModal').modal('toggle');
        }
    };
    xmlhttp.open("GET", "interno.php?id="+int, true);
    xmlhttp.send();
}

function buscar(){
  var valor = document.getElementById('buscar');
  filtro = valor.value.toUpperCase();
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
  if (obj) {
    if (obj.innerHTML.toUpperCase().indexOf(filtro) > -1) {
      return true;
    } else {
      return false;
    }
  }
}
