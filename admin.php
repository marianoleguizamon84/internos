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
     <script type="text/javascript">
       window.onload = function () {
         document.getElementById('user').focus();
       }
     </script>
     <style media="screen">
      body{
        font-size: 2em;
        height: 90vh;
        display: flex;
        justify-content: center;
        align-items: center;
        /*background-color: grey;*/
      }
      .formu{
        width: 350px;
        background-color: rgb(221, 221, 221);
        padding: 25px;
        border-radius: 5px;
      }
      .form-horizontal{
        margin-left: 25px;
        margin-right: 25px;
      }
      .botonesAdmin{
        display: flex;
        justify-content: flex-end;
      }
      .botonesAdmin .btn-danger{
        margin-right: 5px;
      }
     </style>
   </head>
   <body>
     <div class="formu">
       <h2>Iniciar Session</h2>
       <form class="form-horizontal" action="admin.php" method="post">
         <div class="form-group">
           <label for="">Usuario:</label>
           <input class="form-control" type="text" name="user" id="user">
         </div>
         <div class="form-group">
           <label for="">Contraseña:</label>
           <input class="form-control" type="password" name="pass" id="pass">
         </div>
         <div class="botonesAdmin">
           <a href="index.php" class="btn btn-danger">Volver</a>
           <button class="btn btn-primary" type="submit">Entrar</button>
         </div>
       </form>
     </div>
   </body>
 </html>
