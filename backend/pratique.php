<?php

    // Requete pour les 3 derniers sports pratiqués et le nombre de calorie: 

    // SELECT sport.nom, sport.nb_calories*pratique.temps FROM pratique 
    // LEFT JOIN sport ON sport.id_sport=pratique.id_sport 
    // WHERE pratique.login = "alexis.poirot@etu.imt-lille-douai.fr" 
    // ORDER BY pratique.date ASC LIMIT 3

    session_start();

    require('config.php');

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

                    case 'all':
                        pratiqueJournal($conn);
                    break;
                }
            }
        break;

        case 'POST':
            ajoutPratique($conn);
            break;
    }
    

    function Sport_Calorie_day($conn){
        // Gets sport du jour
        
        $sql="SELECT sport.nb_calories*pratique.temps/60 FROM pratique 
        LEFT JOIN sport ON sport.id_sport=pratique.id_sport 
        WHERE pratique.login = '".$_SESSION['login']."'  AND pratique.date >='".date('Y-m-d H:i:s', strtotime("today"))."' AND pratique.date <='".date('Y-m-d H:i:s', strtotime("tomorrow"))."'";
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

        $date_ajd=date('Y-m-d H:i:s', strtotime("today"));
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

        $date_ajd=date('Y-m-d H:i:s', strtotime("today"));
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
    // Get journal des pratiques
    function Sport_jour($conn){
        $sql="SELECT sport.nom, pratique.temps, sport.nb_calories*pratique.temps/60, pratique.date FROM pratique 
        LEFT JOIN sport ON sport.id_sport=pratique.id_sport 
        WHERE pratique.login = '".$_SESSION['login']."' ORDER BY pratique.date DESC LIMIT 2";
        

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

    function pratiqueJournal($conn){
        $sql="SELECT pratique.date, sport.nom, pratique.temps, sport.nb_calories*pratique.temps/60 FROM pratique
        LEFT JOIN sport ON sport.id_sport=pratique.id_sport
        WHERE pratique.login = '".$_SESSION['login']."'";

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
    function ajoutPratique($conn){

        //On cherche l'id du sport
        $sql="SELECT id_sport FROM sport WHERE nom ='".mb_convert_encoding($_POST['nom'], 'CP1252', 'UTF-8')."'";
        $res = $conn -> query($sql);
        $res2 = $res->fetch_assoc();
        $_POST['nom']=$res2['id_sport'];
        
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
        $sql="INSERT INTO pratique VALUE('".$_SESSION['login']."'".$sql.")";
        if($conn->query($sql)==TRUE){;
            $response['resultat']='success';
        }
        else{
            $response['resultat']='failed';
        }
        echo json_encode($response,0);
    }

?>