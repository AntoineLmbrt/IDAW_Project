<?php
    $auth = file_get_contents("identification.json");
    $auth = json_decode($auth,true);
    $auth['dataBase']["username"]; 
    $conn = new mysqli($auth['dataBase']["servername"],$auth['dataBase']["username"], $auth['dataBase']["password"], $auth['dataBase']["dbname"]);

    switch($_SERVER('REQUEST_METHOD')){
        case 'GET':
            listeAliments($conn);
        break;

        case 'POST':
            if(isset($_POST['function'])){
                switch($_POST['function']){
                    case 'UPDATE':
                        changerAliment($conn);
                    break;

                    case 'ADD':
                        ajouterAliment($conn);
                    break;
                }
            }
    }

    function listeAliments($conn){
        $sql = "SELECT * FROM aliment";
        $result = $conn->query($sql);

        $response=array();
        while($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        
        $rows = mb_convert_encoding($rows,'UTF-8', 'CP1252');
        $response["draw"]= 1;
        $response["recordsTotal"]= 3185;
        $response["recordsFiltered"]= 3185;
        $response['data']=$rows;
        echo json_encode($response);
    }

    function modifierAliment($conn){
        foreach($_POST as $key => $value){
            if($key == 'nb_calories'){
                $sql=$sql.$key."=".$value;
            }elseif($key == 'id_aliment'){
            }else{
                $sql=$sql.$key."='".$value."',";
            }
        }
        $sql="UPDATE aliment SET ".$sql."WHERE aliment.id = ".$_POST['id_aliment'];
        $conn->query($sql);
        $response='success';
        echo json_encode($response);
    }

    function ajouterAliment($conn){
        foreach($_POST as $key => $value){
            if($key == 'nb_calories'){
                $sql=$sql.",".$value;
            }else{
                $sql=$sql.",'".$value."'";
            }
        }
        $sql="INSERT INTO aliment VALUES(NULL".$sql.")";
        $conn->query($sql);
        $response='success';
        echo json_encode($response);
    }
?>