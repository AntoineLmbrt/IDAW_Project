// DÉSAFFICHAGE DE LA DIVISION PROFIL DU MENU
$('.profile').remove()

// CHARGEMENT DES VALEURS POSSIBLES DU CHAMP SEXE
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
}
    
// CREATION DU NOUVEAU COMPTE
function onFormSubmit() {
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
                'function':'ADD',
                'user':{
                    'login':$("#inputEmail").val(),
                    'password':$("#inputPassword").val(),
                    'nom': $("#inputNom").val(),
                    'prenom':$("#inputPrenom").val(),
                    'date':$("#inputDate").val(),
                    'sexe':$("#inputSexe").val(),
                }
            }
        }).done(function(data){
            console.log("REQUETE AJAX SUCCED");
            console.log(data);
            if(data['Valide']=='Email déjà utilisé '){
                $("#signup-form ul").prepend('<div class="textError">Cette adresse email a déjà été utlisée !</div>');
            }
            else{
                window.location.replace("index.php?home");
            }

        }).fail(function(){
            console.log('REQUETE AJAX FAILED');
        })
    } else {
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