<?php
session_start();
$admin = false;

if (isset($_SESSION['user'])) {
  header('Location: ./index.php');
  die();
}

if (isset($_POST['user']) && isset($_POST['pass'])) {
  if ($_POST['user'] == 'admin' && $_POST['pass'] == 'admin') {
    $admin = true;
  } else {
    $admin = false;
  }
  if ($admin) {
    $_SESSION['user'] = $_POST['user'];
    header('Location: ./index.php');
    die();
  }
}
 ?>

 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <title>Internos</title>
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <script src="jquery-3.2.1.min.js" charset="utf-8"></script>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
     <link rel="stylesheet" href="internos.css">
   </head>
   <body>
     <div class="">
       <form class="registro" action="admin.php" method="post">
         <div class="form-group">
           <label for="">Usuario:</label>
           <input class="form-control" type="text" name="user">
         </div>
         <div class="form-group">
           <label for="">Contraseña:</label>
           <input class="form-control" type="password" name="pass">
         </div>
         <a href="index.php" class="btn btn-default">Volver</a>
         <button class="btn btn-default" type="submit">Entrar</button>
       </form>
     </div>
   </body>
 </html>
