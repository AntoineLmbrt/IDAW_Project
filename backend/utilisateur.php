<?php
    $auth = file_get_contents("identification.json");
    $auth = json_decode($auth,true);
    $auth['dataBase']["username"]; 
    $conn = new mysqli($auth['dataBase']["servername"],$auth['dataBase']["username"], $auth['dataBase']["password"], $auth['dataBase']["dbname"]);
    
    //On vérifie la connection
    if($conn->connect_error){
        die('Erreur : ' .$conn->connect_error);
    }
    echo 'Connexion réussie <br></br>';

    // On cherche ce que demande le front
    switch($_SERVER["REQUEST_METHOD"]) {
        case "GET":
            if(isset($_GET["function"])){
                switch($_GET["function"]){
                    case "auth":
                        print_r($_GET);
                        authentification($_GET['login'], $_GET['password'],$conn);
                    break;
                }
            }
        break;
        
        case "PUT":
            newUser($_GET["data"]);
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
        }
        else{
            $resultat["resultat"]='false';
            echo json_encode($resultat,0);
        }
    }

    function newUser($data){
        foreach($data as $key => $value){
            
        }
    }
?>