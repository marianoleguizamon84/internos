<?php
require 'config.php';
require 'function.php';
session_start();
$admin = false;

if (isset($_SESSION['user'])) {
  $admin = true;
}

// die($admin);

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname; charset=UTF8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM internos ORDER BY usuario";
    $result = $conn->query($sql);
    // $internos = $result->fetch_assoc();
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <script src="jquery-3.2.1.min.js" charset="utf-8"></script>
    <link rel="icon" href="phone-icon-946.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="internos.css">
    <script src="interno.js" charset="utf-8"></script>
    <title>Listado Internos</title>
  </head>
  <body>
    <h1><a href="index.php">Listado Internos</a></h1>
    <div class="botonera">
      <input type="text" class="form-control" placeholder="Buscar interno, usuario, etc." onkeyup="buscar()" id="buscar">
      <?php if ($admin): ?>
        <button type="button" class="btn btn-default btn-lg" onclick="nuevo()" id="nuevo">Nuevo</button>
        <a href="cerrar.php" class="btn btn-danger cerrar">Cerrar Session</a>
      <?php endif; ?>
    </div>
    <table class='table table-striped'>
      <thead>
        <tr>
          <th class="interno">Interno</th>
          <th class="usuario">Usuario</th>
          <th class="sede movil">Sede</th>
          <th class="obs movil">Observaciones</th>
        </tr>
      </thead>
      <?php
      foreach ($result as $value) {
        if ($admin) {
          $click = 'onclick="interno(' . $value['id'] . ')"';
        } else {
          $click = '';
        }
        if ($value['sede'] == 'Bs As') {
          echo '<tr class="BsAs" '. $click .'>';
        } else {
          echo '<tr class="Pilar" '. $click .'>';
        }
        echo '<td class="filterable-cell interno">' . $value['interno'] . '</td>';
        echo '<td class="filterable-cell usuario">' . $value['usuario'] . '</td>';
        echo '<td class="filterable-cell movil sede">' . $value['sede'] . '</td>';
        echo '<td class="filterable-cell movil obs">' . $value['observaciones'] . '</td>';
        echo '</tr>';
    };
    ?>
    </table>

    <!-- Modal -->
    <?php if ($admin) { ?>
      # code...
   <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
     <div class="modal-dialog" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           <h4 class="modal-title" id="myModalLabel">Interno Nuevo</h4>
         </div>
         <div class="modal-body">
           <form class="formu" action="" method="post" id="formu">
             <div class="form-group">
               <label for="interno">Interno*</label>
               <input type="number" class="form-control" placeholder="Interno" name="interno" value="" id="interno" min="1000" max="9999" required <?php echo !$admin ? "readonly" : "" ?>>
             </div>
             <div class="form-group">
               <label for="usuario">Usuario*</label>
               <input type="text" class="form-control" placeholder="Usuario" name="usuario" value="" id="usuario" required <?php echo !$admin ? "readonly" : "" ?>>
             </div>
             <div class="form-group">
               <label for="sede">Sede*</label>
               <select class="form-control" name="sede" id="sede" required <?php echo !$admin ? "readonly" : "" ?>>
                 <option value="Bs As" <?php echo !$admin ? 'disabled' : '' ?>>Bs As</option>
                 <option value="Pilar" <?php echo !$admin ? 'disabled' : '' ?>>Pilar</option>
                 <option value="FCB" <?php echo !$admin ? 'disabled' : '' ?>>FCB</option>
                 <option value="Rosario" <?php echo !$admin ? 'disabled' : '' ?>>Rosario</option>
               </select>
             </div>
             <div class="form-group">
               <label for="observaciones">Observaciones</label>
               <input type="" class="form-control" placeholder="Observaciones" name="observaciones" value="" id="observaciones" <?php echo !$admin ? "readonly" : "" ?>>
             </div>
         </div>
         <div class="modal-footer">
             <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
             <button type="submit" class="btn btn-primary">Guardar</button>
         </div>
       </form>
       </div>
     </div>
   </div>
 <?php } ?>
  </body>
</html>
