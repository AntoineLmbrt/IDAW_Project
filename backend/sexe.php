<?php
    $auth = file_get_contents("identification.json");
    $auth = json_decode($auth,true);
    $auth['dataBase']["username"]; 
    $conn = new mysqli($auth['dataBase']["servername"],$auth['dataBase']["username"], $auth['dataBase']["password"], $auth['dataBase']["dbname"]);

    //On vérifie la connection
    if($conn->connect_error){
        die('Erreur : ' .$conn->connect_error);
    }
    echo 'Connexion réussie <br></br>';

    switch($_SERVER["REQUEST_METHOD"]) {
        case "GET":
            if(isset($_GET["function"])){
                switch($_GET["function"]){
                    case "read":
                        read($conn);
                    break;
                }
            }
            break;
    }

    function Read($conn){
        $sql="SELECT libelle FROM sexe";
        $res=$conn->query($sql);
        $response=[];
        if($res->num_rows>0){
            for($i=0; $i<$res->num_rows; $i++){
                array_push($response,$res->fetch_assoc());
            }
        }
        $resultat['data']=[];
        foreach($response as $value){
            array_push($resultat['data'],$value['libelle']);
        }
        echo json_encode($resultat,0);
    }
?>