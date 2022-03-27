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
                }
            }
        break;
        
        case "POST":
            User($conn);
    }




    function authentification($login,$password, $conn){
        $query = "SELECT * FROM utilisateur WHERE login='".$login."' AND password='".$password."'";
        $res=$conn->query($query);
        if($res->num_rows ==1){
            $resultat["resultat"]='true';
            echo json_encode($resultat,0);
            session_start();
            $_SESSION["login"]=$login;
            $_SESSION["password"]=$password;
            session_destroy();
        }
        else{
            $resultat["resultat"]='false';
            echo json_encode($resultat,0);
        }
    }

    function User($conn){
        // On regarde si le login est unique.
        $sql = "SELECT login FROM utilisateur WHERE login='".$_POST['email']."'";
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
            $sql="INSERT INTO utilisateur VALUES(".$sql."NULL)";
            session_start();
            $_SESSION["login"]=$_POST['email'];
            $_SESSION["password"]=$_POST['password'];
            session_destroy();

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