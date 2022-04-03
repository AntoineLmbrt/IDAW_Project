<?php

    require('config.php');

    switch($_SERVER['REQUEST_METHOD']){
        case 'GET':
            listeSports($conn);
        break;

        case 'POST':
            
            if(isset($_POST['function'])){
                switch($_POST['function']){
                    case 'EDIT':
                        modifierSport($conn);
                    break;

                    case 'ADD':
                        ajouterSport($conn);
                    break;
                }
            }
        break;
        
        case 'DELETE':
            supprSport($conn);
        break;

    }

    //Obtenir la liste des sprts !
    function listeSports($conn){
        $sql = "SELECT * FROM sport";
        $result = $conn->query($sql);

        $response=array();

        while($row = $result->fetch_assoc()){
            $rows[] = $row;
        }
        $rows = mb_convert_encoding($rows,'UTF-8', 'CP1252');
        $response["draw"]= 1;

        // On recherche le nombre d'entrée (utile pour dataTables)
        $row=$conn -> query("SELECT COUNT(*) FROM sport");
        $row=$row->fetch_assoc();
        $response["recordsTotal"]= $row['COUNT(*)'];
        $response["recordsFiltered"]= $row['COUNT(*)'];
        $response['data']=$rows;
        echo json_encode($response);
    }

    function modifierSport($conn){
        $sql='';
        foreach($_POST['sport'] as $key => $value){
            if($key == 'nb_calories'){
                $sql=$sql.$key."=".$value;
            }elseif($key == 'id'){
            }else{
                $sql=$sql.$key."='".$value."',";
            }
        }
        $sql="UPDATE sport SET ".$sql." WHERE id_sport = ".$_POST['sport']['id'];
        $sql = mb_convert_encoding($sql, 'CP1252','UTF-8');
        if($conn->query($sql)==TRUE){;
            $response='success sql';
        }
        else{
            $response='failed sql';
        }
        echo json_encode($response);
    }

    function ajouterSport($conn){
        $sql='';
        foreach($_POST['sport'] as $key => $value){
            if($key == 'nb_calories'){
                $sql=$sql.",".$value;
            }else{
                $sql=$sql.",'".$value."'";
            }
        }
        
        $sql="INSERT INTO sport VALUES(NULL".$sql.")";
        $sql = mb_convert_encoding($sql, 'CP1252','UTF-8');
        if($conn->query($sql) === TRUE){
            $id_sport=$conn->insert_id;
            $response['resultat']="success";
        };
        

        $response['id']=$id_sport;
        echo json_encode($response);
    }

    function supprSport($conn){
        $sql="DELETE FROM sport WHERE id_sport=".$_GET['id_sport'];
        if($conn->query($sql)==TRUE){
            $response['resultat']='success';
        }else{
            $response['resultat']='failed';
        }
        echo json_encode($response);
    }
?>