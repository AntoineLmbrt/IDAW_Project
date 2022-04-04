GET:
    url : /sports.php
    description: renvoie la liste des sports
    format réponse : json

POST:
    function = ADD :
        url : /sports.php
        description : Ajoute un sport dans la table sql
        format réponse : json
        payload : {
            function : "ADD",
            "sport":{
                nom :
                nb_calorie :
            }
        }

    function = EDIT :
        url : /sports.php
        description : Modifie le sport demandé dans la table sql
        format réponse : json
        payload : {
            function : "EDIT",
            "sport" : {
                id:
                nom:
                nb_calories:
            }
        }

DELETE :
    url : /aliments.php?id_sport=[id_sport à supprimer]
    description : Supprime le sport demandé dans la table sql
    format réponse : json