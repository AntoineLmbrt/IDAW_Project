<?php

    // Requete pour les 3 derniers sports pratiqués et le nombre de calorie: 

    // SELECT sport.nom, sport.nb_calories*pratique.temps FROM pratique 
    // LEFT JOIN sport ON sport.id_sport=pratique.id_sport 
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
    

    function Calorie_sport_day($conn){}

        
        // Gets repas du jour
        
        $sql="SELECT sport.nb_calories*pratique.temps/60 FROM pratique 
        LEFT JOIN sport ON sport.id_sport=pratique.id_sport 
        WHERE pratique.login = '".$_GET['login']."'  AND pratique.date='".date('Y-m-d')."'";

        $res=$conn -> query($sql);
        $rows = array();
        $nbCalSport=0;
        while($row = $res->fetch_assoc()) { 
            $nbCalSport= $nbCalSport + $row['sport.nb_calories*pratique.temps/60'];
        }
        echo $nbCalSport;  
?>