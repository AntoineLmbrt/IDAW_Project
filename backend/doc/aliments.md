GET:
    url : /aliments.php
    description: renvoie la liste des aliments
    format réponse : json

POST:
    function = ADD :
        url : /aliments.php
        description : Ajoute un aliment dans la table sql
        format réponse : json
        payload : {
            function : "ADD",
            "aliment":{
                nom :
                type :
                nb_calorie :
            }
        }

    function = EDIT :
        url : /aliments.php
        description : Modifie l'aliment demandé dans la table sql
        format réponse : json
        payload : {
            function : "EDIT",
            "aliment" : {
                id:
                nom:
                type:
                nb_calories:
            }
        }

DELETE :
    url : /aliments.php?id_aliment=[id_aliment à supprimer]
    description : Supprime l'aliment demandé dans la table sql
    format réponse : json
