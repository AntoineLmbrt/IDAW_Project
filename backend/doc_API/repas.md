GET : 
    time = day :
        url : /repas.php?time=day
        description : renvois le nombre de calorie consommées aujourd'hui
        format réponse : json
    
    time = 3days :
        url : /repas.php?time=3days
        description : renvois les deux derniers repas de l'utilisateur
        format réponse : json
    
    time = week :
        url : /repas.php?time=week
        description : renvois le nombre de calorie consommées cette semaine
        format réponse : json

    time = month :
        url : /repas.php?time=month
        description : renvois le nombre de calorie consommées ce mois
        format réponse : json
    
    time = all :
        url : /repas.php?time=all
        description : renvois tout les repas enregistrées par l'utilisateur
        format réponse : json

POST :
    url : /repas.php
    description : Ajoute un repas dans la table sql
    format réponse : json
    payload : {
        nom :
        quantite :
        date :
    }