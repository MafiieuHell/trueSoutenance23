<?php
if ( isset($_GET["id"])){
    $id = $_GET["id"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "myshop";
   
    // connextion a la base de donnée
    $connection = new mysqli($servername, $username, $password,$database);

    $sql ="DELETE FROM clients WHERE id = $id";
    $connection->query($sql);
    header("location: /myshop/index.php");
    exit;
}



?>