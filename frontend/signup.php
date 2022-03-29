<form id="signup-form" action="" onSubmit="onFormSubmit()">
    <ul>
        <li>
            <label>Nom et Prénom</label>
            <input type="text" name="inputNom" id="inputNom" class="two-fields" placeholder="Nom">
            <input type="text" name="inputPrenom" id="inputPrenom" class="two-fields" placeholder="Prénom">
        </li>
        <li>
            <label>Email</label>
            <input type="email" name="inputLogin" id="inputEmail" class="one-field" placeholder="Email">
        </li>
        <li>
            <label>Mot de passe</label>
            <input type="password" name="inputPassword" id="inputPassword" class="one-field" placeholder="Mot de passe">
        </li>
        <li>
            <label>Date de naissance</label>
            <input type="date" name="inputBirthday" id="inputDate">
        </li>
        <li>
            <label>Sexe</label>
            <select name="sexe" id="inputSexe"></select>
        </li>
        <li>
            <input type="submit" value="S'inscrire" />
        </li>
    </ul>
</form>
<script>
    $('inputSexe').ready(chargementSexe());
    function chargementSexe(){
        $.ajax({
            url:"../backend/sexe.php?function=read",
            method: "GET",
            dataType: "json",
        })
        .done(function(data){
                for(let i in data['data']){
                    $("#inputSexe").append(`<option value="${data["data"][i]}"> ${data["data"][i]} </option>`);
                }
            
        })
        .fail(function(){
            console.log('REQ AJAX FAILED ...');
        })
    };
    // Création du nouveau compte
    function onFormSubmit(){
        event.preventDefault();
        console.log('Test');
        if( $("#inputNom").val()!='' && $("#inputPrenom").val()!='' && $("#inputEmail").val()!='' && $("#inputPassword").val()!='' &&$("#inputDate").val()!='' && $("#inputSexe").val()!='' ){
            $.ajax({
                url:"../backend/utilisateur.php",
                method:'POST',
                dataType:"json",
                data:{
                    'login':$("#inputEmail").val(),
                    'password':$("#inputPassword").val(),
                    'nom': $("#inputNom").val(),
                    'prenom':$("#inputPrenom").val(),
                    'date':$("#inputDate").val(),
                    'sexe':$("#inputSexe").val(),
                }
            }).done(function(data){
                console.log("REQUETE AJAX SUCCED");
                console.log(data);
                if(data['Valide']=='Email déjà utilisé '){
                    // -----> ENTRER CODE SI LOGIN DEJA UTILISE
                }
                else{
                    window.location.replace("http://project/frontend/index.php?home");
                }

            }).fail(function(){
                console.log('REQUETE AJAX FAILED');
            })
        } else{
            // -----> ENTRER CODE POUR RENSEIGNER TOUT LES CHAMPS
            console.log('Loupé');
        }
    }
</script>