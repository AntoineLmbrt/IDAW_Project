<?php
    $auth = file_get_contents("identification.json");
    $auth = json_decode($auth,true);
    $auth['dataBase']["username"]; 
    $conn = new mysqli($auth['dataBase']["servername"],$auth['dataBase']["username"], $auth['dataBase']["password"], $auth['dataBase']["dbname"]);
    
    //On vérifie la connection
    if($conn->connect_error){
        die('Erreur : ' .$conn->connect_error);
    }
    // On cherche ce que demande le front
    switch($_SERVER["REQUEST_METHOD"]) {
        case "GET":
            if(isset($_GET["function"])){
                switch($_GET["function"]){
                    case "auth":
                        authentification($_GET['login'], $_GET['password'],$conn);
                    break;
                    case "objectif":
                        objectif($conn);
                    break;
                    case 'profil':
                        profil($conn);
                    break;
                }
            }
        break;
        
        case "POST":
            ajouterUser($conn);
    }



    //Vérifier les accès de l'utilisateur
    function authentification($login,$password, $conn){
        $query = "SELECT * FROM utilisateur WHERE login='".$login."' AND password='".$password."'";
        $res=$conn->query($query);
        if($res->num_rows ==1){
            $resultat["resultat"]='true';
            session_start();
            $_SESSION["login"]=$login;
            $_SESSION["password"]=$password;
            echo json_encode($resultat,0);
            
        }
        else{
            $resultat["resultat"]='false';
            echo json_encode($resultat,0);
        }
    };


    // Obtenir l'objectif de l'utilisateur
    function objectif($conn){
        session_start();
        $sql = "SELECT objectif.nb_calories FROM utilisateur
                LEFT JOIN objectif ON utilisateur.id_objectif=objectif.id_objectif
                WHERE utilisateur.login='".$_SESSION['login']."'";
        $res=$conn -> query($sql);
        $row = $res->fetch_assoc();
        echo json_encode($row['nb_calories']);
    }
    // Obtenir le profil de l'utilisateur
    function profil($conn){
        session_start();
        $sql="SELECT utilisateur.*, sexe.libelle FROM utilisateur
        LEFT JOIN sexe ON sexe.id_sexe=utilisateur.id_sexe
        WHERE login='".$_SESSION['login']."'";
        $res=$conn -> query($sql);
        $row = $res->fetch_assoc();
        $row = mb_convert_encoding($row,'UTF-8', 'CP1252');
        echo json_encode($row);
    }


    // Ajouter ou modifier un utilisateur
    function ajouterUser($conn){
        // On regarde si le login est unique.
        $sql = "SELECT login FROM utilisateur WHERE login='".$_POST['login']."'";
        $res = $conn -> query($sql);

        // Si il retourne une ligne c'est qu'il n'est pas unique
        if($res->num_rows > 0){
            $response['Valide']='Email déjà utilisé';
            echo json_encode($response,0);
        }
        // Sinon, on l'ajoute dans la table SQL
        else {

            $sql = '';
            $response['Valide']='Inscription réussie';

            // On change l'id du sexe en fonction de notre table
            $sql="SELECT id_sexe FROM sexe WHERE libelle = '".$_POST['sexe']."'";
            $res = $conn->query($sql);
            $res=$res->fetch_assoc();
            $_POST['sexe']=$res['id_sexe'];

            // Reset sql et création de la requete PUT
            $sql='';
            foreach($_POST as $key => $value){
                if($key == 'sexe'){
                    $sql=$sql.$value.",";
                }
                elseif($key == 'date'){
                    $sql=$sql.age($value).",";
                }
                else{
                  $sql=$sql."'".$value."',";
                }
            }

            // On ditribue l'objectif selon le sexe et l'age (ici de manière brute)
            // Code compliqué a faire évoluer
            if(age($_POST['date'])<11){
                if($_POST['sexe']==2){
                    $sql=$sql."2";
                }
                else{
                    $sql=$sql."1";
                }
            }
            elseif(age($_POST['date'])<19){
                if($_POST['sexe']==2){
                    $sql=$sql."4";
                }
                else{
                    $sql=$sql."3";
                }
            }
            else{
                if($_POST['sexe']==2){
                    $sql=$sql."6";
                }
                else{
                    $sql=$sql."5";
                }
            }

            // On envoit les données dans mySQL
            $sql="INSERT INTO utilisateur VALUES(".$sql.")";
            $response='success';
            $conn -> query($sql);

            //On lance la session
            session_start();
            $_SESSION["login"]=$_POST['login'];
            $_SESSION["password"]=$_POST['password'];
            echo json_encode($response,0);
        }


    }


    // FONCTION UTILES
    function age($date) { 
        $annee = date('Y', strtotime($date));
        $age = date('Y') - $annee; 
        if (date('md') < date('md', strtotime($date))) { 
           return $age - 1; 
        } 
        return $age; 
   } 
    
?>