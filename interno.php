<?php
if (!isset($_GET['id'])) {
  die("No se paso ningún parámetro");

}
require 'config.php';
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM internos WHERE id=".$_GET['id'];
    $result = $conn->query($sql);
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

foreach ($result as $value) {
  $json[] = array('interno'=>utf8_encode($value['interno']),
                  'usuario'=>utf8_encode($value['usuario']),
                  'sede'=>utf8_encode($value['sede']),
                  'observaciones'=>utf8_encode($value['observaciones']),
  );
};
$json_data = json_encode($json);
echo $json_data;
 ?>
