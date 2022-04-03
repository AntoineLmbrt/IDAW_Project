<?php
// Requete pour avoir les 3 derniers repas manger et le nombre de Calorie:

// SELECT aliment.nom, aliment.nb_calories*repas.quantite*2 FROM repas 
// LEFT JOIN aliment ON aliment.id_aliment=repas.id_aliment 
// WHERE repas.login = "alexis.poirot@etu.imt-lille-douai.fr" 
// ORDER BY repas.date ASC LIMIT 3

    session_start();

    require('config.php');

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

                    case 'all':
                        repasJournal($conn);
                    break;
                }
            }
        break;
        case 'POST':
            switch($_POST['function']){
                case 'ADD':
                    ajoutRepas($conn);
                break;

        break;
        case 'DELETE':
            supprRepas($conn);
        break;
        }
    }
    

    function Repas_Calorie_day($conn){
        // Gets repas du jour
        
        $sql="SELECT aliment.nb_calories*repas.quantite FROM repas 
        LEFT JOIN aliment ON aliment.id_aliment=repas.id_aliment 
        WHERE repas.login = '".$_SESSION['login']."'  AND repas.date >='".date('Y-m-d H:i:s', strtotime("today"))."' AND repas.date <='".date('Y-m-d', strtotime("today"))." 23:59:59'";
        echo $sql;
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
        $date_ajd=date('Y-m-d H:i:s', strtotime("today"));
        $date_db_semaine=date('Y-m-d H:i:s', strtotime("this week"));
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
        $date_ajd=date('Y-m-d H:i:s', strtotime("today"));
        $date_db_month=date('Y-m-d H:i:s', strtotime("first day of this month"));

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

    function repasJournal($conn){
        $sql="SELECT repas.date,aliment.nom, repas.quantite, aliment.nb_calories*repas.quantite FROM repas 
        LEFT JOIN aliment ON aliment.id_aliment=repas.id_aliment 
        WHERE repas.login = '".$_SESSION['login']."'";

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

    function Repas_jour($conn){
        $sql="SELECT aliment.nom, repas.quantite, aliment.nb_calories*repas.quantite, repas.date FROM repas 
        LEFT JOIN aliment ON aliment.id_aliment=repas.id_aliment
        WHERE repas.login = '".$_SESSION['login']."' ORDER BY repas.date DESC LIMIT 2";

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


    //ajouter une Pratique
    function ajoutRepas($conn){

        //On cherche l'id du sport
        $sql="SELECT id_aliment FROM aliment WHERE nom ='".mb_convert_encoding($_POST['nom'], 'CP1252', 'UTF-8')."'";
        $res = $conn -> query($sql);
        $res2 = $res->fetch_assoc();
        $_POST['nom']=$res2['id_aliment'];
        
        //On créer la req SQL
        $sql='';
        foreach($_POST as $key=>$value){
            if($key=='date'){
                $timestamp = strtotime($value); 
                $newDate = date("Y-m-d H:i:s", $timestamp );
                $sql=$sql.",'".$newDate."'";
            }
            else{
                $sql=$sql.",".$value;
            }

        }
        $sql="INSERT INTO repas VALUE('".$_SESSION['login']."'".$sql.")";
        if($conn->query($sql)==TRUE){;
            $response['resultat']='success';
        }
        else{
            $response['resultat']='failed';
        }
        echo json_encode($response,0);
    }

    function supprRepas($conn){
        $sql='SELECT id_aliment FROM aliment WHERE nom ="'.mb_convert_encoding($_GET['nom'], 'CP1252', 'UTF-8').'"';
        $res=$conn->query($sql);
        $res=$res->fetch_assoc();

        $sql='DELETE FROM repas WHERE id_aliment="'.$res['id_aliment'].'" AND login="'.$_GET['login'].'" AND date="'.$_GET['date'];
        if($conn -> query($sql)==TRUE){
            $response = "success";
        }
        else{
            $response = "failed";
        }
        echo json_encode($response,0);
    }
?>