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

    switch($_SERVER['REQUEST_METHOD']){
        case 'GET':
            if(isset($_GET['time'])){
                switch($_GET['time']){
                    case 'day':
                        Sport_Calorie_day($conn);
                    break;
                    case '3days':
                        Sport_Jour($conn);
                    break;
                    case 'week':
                        Sport_Calorie_week($conn);
                    break;

                    case 'month':
                        Sport_Calorie_month($conn);
                    break;
                }
            }
        break;
    }
    

    function Sport_Calorie_day($conn){
        // Gets sport du jour
        
        $sql="SELECT sport.nb_calories*pratique.temps/60 FROM pratique 
        LEFT JOIN sport ON sport.id_sport=pratique.id_sport 
        WHERE pratique.login = '".$_SESSION['login']."'  AND pratique.date='".date('Y-m-d')."'";

        $res=$conn -> query($sql);
        $rows = array();
        $nbCalSport=0;
        while($row = $res->fetch_assoc()) { 
            $nbCalSport= $nbCalSport + $row['sport.nb_calories*pratique.temps/60'];
        }
        echo $nbCalSport;  
    }

    function Sport_Calorie_week($conn){
        // Gets sport de la semaine

        $date_ajd=date('Y-m-d');
        $date_db_semaine=date('Y-m-d', strtotime("this week"));

        $sql="SELECT sport.nb_calories*pratique.temps/60 FROM pratique 
        LEFT JOIN sport ON sport.id_sport=pratique.id_sport 
        WHERE pratique.login = '".$_SESSION['login']."'  AND pratique.date <= '".$date_ajd."' AND pratique.date >= '".$date_db_semaine."'";

        $res=$conn -> query($sql);
        $rows = array();
        $nbCalSport=0;
        while($row = $res->fetch_assoc()) { 
            $nbCalSport= $nbCalSport + $row['sport.nb_calories*pratique.temps/60'];
        }
        echo $nbCalSport;  
    }
    function Sport_Calorie_month($conn){
        // Gets sport du mois

        $date_ajd=date('Y-m-d');
        $date_db_month=date('Y-m-d', strtotime("first day of this month"));

        $sql="SELECT sport.nb_calories*pratique.temps/60 FROM pratique 
        LEFT JOIN sport ON sport.id_sport=pratique.id_sport 
        WHERE pratique.login = '".$_SESSION['login']."'  AND pratique.date <= '".$date_ajd."' AND pratique.date >= '".$date_db_month."'";

        $res=$conn -> query($sql);
        $rows = array();
        $nbCalSport=0;
        while($row = $res->fetch_assoc()) { 
            $nbCalSport= $nbCalSport + $row['sport.nb_calories*pratique.temps/60'];
        }
        echo $nbCalSport;  
    }

    function Sport_jour($conn){
        $sql="SELECT sport.nom, pratique.temps, sport.nb_calories*pratique.temps/60 FROM pratique 
        LEFT JOIN sport ON sport.id_sport=pratique.id_sport 
        WHERE pratique.login = '".$_SESSION['login']."' AND pratique.date='".date('Y-m-d')."'";
        

        $res=$conn -> query($sql);
        $rows = array();
        while($row = $res->fetch_assoc()) {
            foreach($row as $key=>$value){
                $result = mb_convert_encoding($value,'UTF-8', 'CP1252');
                $row[$key]=$result;
            }
            array_push($rows, $row);
        }
        echo json_encode($rows);
        
    }

?>