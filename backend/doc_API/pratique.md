GET : 
    time = day :
        url : /pratique.php?time=day
        description : renvois le nombre de calorie dépensées aujourd'hui
        format réponse : json
    
    time = 3days :
        url : /pratique.php?time=3days
        description : renvois les deux derniers pratique de l'utilisateur
        format réponse : json
    
    time = week :
        url : /pratique.php?time=week
        description : renvois le nombre de calorie dépensées cette semaine
        format réponse : json

    time = month :
        url : /pratique.php?time=month
        description : renvois le nombre de calorie dépensées ce mois
        format réponse : json
    
    time = all :
        url : /pratique.php?time=all
        description : renvois tout les pratiques enregistrées par l'utilisateur
        format réponse : json

POST :
    url : /pratique.php
    description : Ajoute un pratique dans la table sql
    format réponse : json
    payload : {
        nom :
        date :
        temps :
    }