<h1 id="title">Inscription</h1>
<form id="signup-form" onSubmit="onFormSubmit()">
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
            <input type="date" name="inputDate" id="inputDate">
        </li>
        <li>
            <label>Sexe</label>
            <select name="sexe" id="inputSexe"></select>
        </li>
        <li>
            <input type="submit" value="Inscription" />
        </li>
    </ul>
</form>
<script>
    $('.profile').remove()
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
       
    };     console.log('REQ AJAX FAILED ...');
        })
    // Création du nouveau compte
    function onFormSubmit(){
        champsObligatoires = ["#inputNom", "#inputPrenom", "inputEmail", "inputPassword", "inputDate", "inputSexe"];
        event.preventDefault();
        console.log('Test');
        if ($(".textError") != null) {
            $(".textError").detach();
        }
        if( $("#inputNom").val()!='' && $("#inputPrenom").val()!='' && $("#inputEmail").val()!=undefined && $("#inputPassword").val()!=undefined &&$("#inputDate").val()!=undefined && $("#inputSexe").val()!=undefined ){
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
                    $("#signup-form ul").prepend('<div class="textError">Cette adresse email a déjà été utlisée !</div>');
                }
                else{
                    window.location.replace("http://project/frontend/index.php?home");
                }

            }).fail(function(){
                console.log('REQUETE AJAX FAILED');
            })
        } else{
            $("#signup-form ul").prepend('<div class="textError">Veuillez renseignez les champs.</div>');
            console.log('Loupé');
            champsObligatoires.forEach(element => {
                console.log($(element).val());
                if ($(element).val() == "" || $(element).val() === undefined)
                    $(element).css("border", "2px solid #E83333");
                else
                    $(element).css("border", "1px solid #18A585");    
            });
            console.log('Loupé');
        }
    }
</script>