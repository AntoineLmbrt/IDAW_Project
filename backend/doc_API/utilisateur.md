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
    function = ADD :
        url : /utilisateur.php
        description : Ajoute un utilisateur en vérifiant que son login est unique
        format réponse : json
        payload :{
            login :
            password :
            nom :
            prenom :
            date :
            sexe :
        }

    function = EDIT
        url : /utilisateur.php
        description: Modifie un utilisateur
        format réponse : json
        payload : {
            function : "EDIT"
            user:{    
                nom :
                prenom :
                date :
                id_sexe : [mettre le libelle ( le back le transforme en id)]
            }
        }
