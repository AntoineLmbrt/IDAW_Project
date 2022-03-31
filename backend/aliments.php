<?php
    $auth = file_get_contents("identification.json");
    $auth = json_decode($auth,true);
    $auth['dataBase']["username"]; 
    $conn = new mysqli($auth['dataBase']["servername"],$auth['dataBase']["username"], $auth['dataBase']["password"], $auth['dataBase']["dbname"]);

    $sql = "SELECT * FROM aliment";
    $result = $conn->query($sql);

    $response=array();
    while($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    
    $rows = mb_convert_encoding($rows,'UTF-8', 'CP1252');
    $response["draw"]= 2;
    $response["recordsTotal"]= 3185;
    $response["recordsFiltered"]= 3185;
    $response['data']=$rows;
    echo json_encode($response);
?>