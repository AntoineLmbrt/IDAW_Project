<?php
    require('config.php');

    switch($_SERVER['REQUEST_METHOD']){
        case 'GET':
            listeAliments($conn);
        break;

        case 'POST':
            
            if(isset($_POST['function'])){
                switch($_POST['function']){
                    case 'EDIT':
                        modifierAliment($conn);
                    break;

                    case 'ADD':
                        ajouterAliment($conn);
                    break;
                }
            }
        break;
        
        case 'DELETE':
            supprAliment($conn);
        break;

    }

    //Obtenir la liste des aliments et leurs nutriments !
    function listeAliments($conn){
        $sql = "SELECT * FROM aliment";
        $result = $conn->query($sql);

        // $nb_nutriment=$conn->query("SELECT COUNT(*) FROM nutriment");
        // $nb_nutriment=$nb_nutriment->fetch_assoc();
        // $nb_nutriment=$nb_nutriment['COUNT(*)'];

        $response=array();

        while($row = $result->fetch_assoc()){
            $rows[] = $row;
        }
            //On ajoute les nutriments 
                // On récupère le ratio du nutriment et le nom
                // $res1=$conn->query('SELECT contient.ratio, nutriment.nom FROM contient LEFT JOIN nutriment ON contient.id_nutriment=nutriment.id_nutriment WHERE id_aliment='.$row['id_aliment']);
                // while($res=$res1->fetch_assoc()){
                //     $ratio=$res['ratio'];
                //     $nom_nutriment=$res['nom'];
                //     // On l'ajoute à la colonne
                //     $row2[$nom_nutriment]=$ratio;
                // }
        $rows = mb_convert_encoding($rows,'UTF-8', 'CP1252');
        $response["draw"]= 1;

        // On recherche le nombre d'entrée (utile pour dataTables)
        $row=$conn -> query("SELECT COUNT(*) FROM aliment");
        $row=$row->fetch_assoc();
        $response["recordsTotal"]= $row['COUNT(*)'];
        $response["recordsFiltered"]= $row['COUNT(*)'];
        $response['data']=$rows;
        echo json_encode($response);
    }

    function modifierAliment($conn){
        $sql='';
        foreach($_POST['aliment'] as $key => $value){
            if($key == 'nb_calories'){
                $sql=$sql.$key."=".$value;
            }elseif($key == 'id'){
            }else{
                $sql=$sql.$key."='".$value."',";
            }
        }
        $sql="UPDATE aliment SET ".$sql." WHERE id_aliment = ".$_POST['aliment']['id'];
        $sql = mb_convert_encoding($sql, 'CP1252','UTF-8');
        if($conn->query($sql)==TRUE){;
            $response='success sql';
        }
        else{
            $response='failed sql';
        }
        echo json_encode($response);
    }

    function ajouterAliment($conn){
        $sql='';
        foreach($_POST['aliment'] as $key => $value){
            if($key == 'nb_calories'){
                $sql=$sql.",".$value;
            }else{
                $sql=$sql.",'".$value."'";
            }
        }
        
        $sql="INSERT INTO aliment VALUES(NULL".$sql.")";
        $sql = mb_convert_encoding($sql, 'CP1252','UTF-8');
        if($conn->query($sql) === TRUE){
            $id_aliment=$conn->insert_id;
            $response['resultat']="success";
        };
        

        $response['id']=$id_aliment;
        echo json_encode($response);
    }

    function supprAliment($conn){
        $sql="DELETE FROM aliment WHERE id_aliment=".$_GET['id_aliment'];
        if($conn->query($sql)==TRUE){
            $response['resultat']='success';
        }else{
            $response['resultat']='failed';
        }
        echo json_encode($response);
    }
?>