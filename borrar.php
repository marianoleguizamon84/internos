<?php
require 'config.php';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname; charset=UTF8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM internos WHERE id=" . $_GET['id'];
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
