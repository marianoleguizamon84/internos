<?php
require 'config.php';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname; charset=UTF8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO internos (interno, usuario, sede, observaciones) VALUES ('". $_POST['interno'] ."','". $_POST['usuario'] ."','". $_POST['sede'] ."','". $_POST['observaciones'] ."')";
    $result = $conn->query($sql);
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
    $conn = null;
    header("Location: index.php");
    die();
 ?>
