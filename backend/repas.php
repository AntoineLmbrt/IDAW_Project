<?php
// Requete pour avoir les 3 derniers repas manger et le nombre de Calorie:

// SELECT aliment.nom, aliment.nb_calories*repas.quantite*2 FROM repas 
// LEFT JOIN aliment ON aliment.id_aliment=repas.id_aliment 
// WHERE repas.login = "alexis.poirot@etu.imt-lille-douai.fr" 
// ORDER BY repas.date ASC LIMIT 3

    session_start();
    $auth = file_get_contents("identification.json");
    $auth = json_decode($auth,true);
    $auth['dataBase']["username"]; 
    $conn = new mysqli($auth['dataBase']["servername"],$auth['dataBase']["username"], $auth['dataBase']["password"], $auth['dataBase']["dbname"]);

    //On vérifie la connection
    if($conn->connect_error){
        die('Erreur : ' .$conn->connect_error);
    }
    

    function Repas_Calorie_day($conn){

        // 3 GETs calorie consommé, utilisé, total du jour
        // Gets repas du jour
        $sql="SELECT aliment.nb_calories*repas.quantite FROM repas 
        LEFT JOIN aliment ON aliment.id_aliment=repas.id_aliment 
        WHERE repas.login = '".$_GET['login']."'  AND repas.date='".date('Y-m-d')."'";

        $res=$conn -> query($sql);
        $rows = array();
        $nbCalRepas=0;
        while($row = $res->fetch_assoc()) { 
            $nbCalRepas= $nbCalRepas + $row['aliment.nb_calories*repas.quantite'];
        }
        echo $nbCalRepas;  
    
    }
?>