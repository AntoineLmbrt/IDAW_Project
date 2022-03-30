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

    switch($_SERVER['REQUEST_METHOD']){
        case 'GET':
            if(isset($_GET['time'])){
                switch($_GET['time']){
                    case 'day':
                        Repas_Calorie_day($conn);
                    break;
                    
                    case '3days':
                        Repas_jour($conn);
                    break;
                    case 'week':
                        Repas_Calorie_week($conn);
                    break;

                    case 'month':
                        Repas_Calorie_month($conn);
                    break;
                }
            }
        break;
    }
    

    function Repas_Calorie_day($conn){
        // Gets repas du jour
        $sql="SELECT aliment.nb_calories*repas.quantite FROM repas 
        LEFT JOIN aliment ON aliment.id_aliment=repas.id_aliment 
        WHERE repas.login = '".$_SESSION['login']."'  AND repas.date='".date('Y-m-d')."'";

        $res=$conn -> query($sql);
        $rows = array();
        $nbCalRepas=0;
        while($row = $res->fetch_assoc()) { 
            $nbCalRepas= $nbCalRepas + $row['aliment.nb_calories*repas.quantite'];
        }
        echo json_encode($nbCalRepas,0);  
    
    }

    function Repas_Calorie_week($conn){
        // gestion de la date
        $date_ajd=date('Y-m-d');
        $date_db_semaine=date('Y-m-d', strtotime("this week"));

        $sql="SELECT aliment.nb_calories*repas.quantite FROM repas 
        LEFT JOIN aliment ON aliment.id_aliment=repas.id_aliment 
        WHERE repas.login = '".$_SESSION['login']."'  AND repas.date <= '".$date_ajd."' AND repas.date >= '".$date_db_semaine."'";

        $res=$conn -> query($sql);
        $rows = array();
        $nbCalRepas=0;
        while($row = $res->fetch_assoc()) { 
            $nbCalRepas= $nbCalRepas + $row['aliment.nb_calories*repas.quantite'];
        }
        echo $nbCalRepas;
    }

    function Repas_Calorie_month($conn){
        $date_ajd=date('Y-m-d');
        $date_db_month=date('Y-m-d', strtotime("first day of this month"));

        $sql="SELECT aliment.nb_calories*repas.quantite FROM repas 
        LEFT JOIN aliment ON aliment.id_aliment=repas.id_aliment 
        WHERE repas.login = '".$_SESSION['login']."'  AND repas.date <= '".$date_ajd."' AND repas.date >= '".$date_db_month."'";

        $res=$conn -> query($sql);
        $rows = array();
        $nbCalRepas=0;
        while($row = $res->fetch_assoc()) { 
            $nbCalRepas= $nbCalRepas + $row['aliment.nb_calories*repas.quantite'];
        }
        echo $nbCalRepas;
    }


    function Repas_jour($conn){
        $sql="SELECT aliment.nom, repas.quantite, aliment.nb_calories*repas.quantite FROM repas 
        LEFT JOIN aliment ON aliment.id_aliment=repas.id_aliment 
        WHERE repas.login = '".$_SESSION['login']."' AND repas.date='".date('Y-m-d')."'";

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