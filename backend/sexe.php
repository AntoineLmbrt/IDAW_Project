<?php
    
    require('config.php');

    switch($_SERVER["REQUEST_METHOD"]) {
        case "GET":
            if(isset($_GET["function"])){
                switch($_GET["function"]){
                    case "read":
                        read($conn);
                    break;
                }
            }
            break;
    }

    function Read($conn){
        $sql="SELECT libelle FROM sexe";
        $res=$conn->query($sql);
        $response=[];
        if($res->num_rows>0){
            for($i=0; $i<$res->num_rows; $i++){
                array_push($response,$res->fetch_assoc());
            }
        }
        $resultat['data']=[];
        foreach($response as $value){
            array_push($resultat['data'],$value['libelle']);
        }
        echo json_encode($resultat,0);
    }
?>