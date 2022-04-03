<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "imangermieux";

    $conn = new mysqli($servername, $username, $password, $dbname);

    //Vérification de la connexion
    if($conn->connect_error){
        die('Erreur : ' .$conn->connect_error);
    }
?>