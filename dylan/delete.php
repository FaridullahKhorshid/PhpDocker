<?php

if(isset($_GET["id"])){
    $id = $_GET["id"];

    $servername = "mariadb-test";
    $username = "root";
    $password = "root";
    $database = "test";
    
    $connection = new mysqli($servername, $username, $password, $database);
    
    $sql = "DELETE FROM employee WHERE id=$id";
    $connection->query($sql);



}

header("location: index.php");
exit;




?>