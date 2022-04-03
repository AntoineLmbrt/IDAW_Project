GET : 
    function = auth :
        url : /utilisateur.php?function=auth&login=[login entré]&password[password entré]
        description : Vérifie l'authentification de l'utilisateur
        format réponse : json

    function = objectif :
        url : /utilisateur.php?function=objectif
        description : Renvois l'objectif de l'utilisateur
        format réponse : json

    function = profil :
        url : /utilisateur.php?function=profil
        description : Renvois les données de l'utilisateur
        format réponse : json

POST :
    url : /utilisateur.php
    description : Ajoute un utilisateur en vérifier que son login est unique
    format réponse : json
    payload :{
        login :
        password :
        nom :
        prenom :
        date :
        sexe
    }