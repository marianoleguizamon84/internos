<?php
require 'config.php';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname; charset=UTF8", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE internos SET interno='". $_POST['interno'] ."', usuario='". $_POST['usuario'] ."', sede='". $_POST['sede'] ."', observaciones='". $_POST['observaciones'] ."' WHERE id=" . $_GET['id'];

    // Prepare statement
    $stmt = $conn->prepare($sql);

    // execute the query
    $stmt->execute();

    // echo a message to say the UPDATE succeeded
    echo $stmt->rowCount() . " records UPDATED successfully";
    $conn = null;
    header("Location: index.php");
    die();
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

?>
