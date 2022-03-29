<?php
    $auth = file_get_contents("identification.json");
    $auth = json_decode($auth,true);
    $auth['dataBase']["username"]; 
    $conn = new mysqli($auth['dataBase']["servername"],$auth['dataBase']["username"], $auth['dataBase']["password"], $auth['dataBase']["dbname"]);

    $sql = "SELECT * FROM aliment";
    $result = $conn->query($sql);

    $rows = array();
    while($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    echo json_encode($rows);
?>