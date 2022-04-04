// CHARGEMENT DES DONNÉES DU PROFIL
$('body').ready(chargementDonneeProfil());

function chargementDonneeProfil(){
    $.ajax({
        url:"../backend/utilisateur.php?function=profil",
        dataType:"json",
    }).done(function(data){
        console.log("REQ AJAX SUCCED");
        $("#nom").append(data["nom"]);
        $("#prenom").append(data["prenom"]);
        $("#date_naissance").append(data["date_naissance"]);
        $("#login").append(data["login"]);
        $("#sexe_libelle").append(data["libelle"])
    }).fail(function(){
        console.log("REQ AJAX FAILED");
    })
}

let editing = false;
function profileEdit() {
    if (!editing) {
        $('.notEditable').remove();
        $('#nom').replaceWith('<input type="text" id="inputNom" value="' + $('#nom').html() + '">');
        $('#prenom').replaceWith('<input type="text" id="inputPrenom" value="' + $('#prenom').html() + '">');
        $('#date_naissance').replaceWith('<input type="date" id="inputDate" value="' + + $('#date_naissance').html() + '">');
        $('#sexe_libelle').replaceWith('<select id="inputSexe"></select>');
        $('#profile-buttons button').html('Modifier');
        chargementSexe();
        editing = true;
    } else {
        event.preventDefault();
        if ($(".textError") != null) {
            $(".textError").detach();
        }
        if( $("#inputNom").val()!='' && $("#inputPrenom").val()!='' &&$("#inputDate").val()!='' && $("#inputSexe").val()!='') {
            $.ajax({
                url:'../backend/utilisateur.php',
                method: 'POST',
                dataType:'json',
                data:{
                    'function':'EDIT',
                    'user':{
                        'nom':$("#inputNom").val(),
                        'prenom':$("#inputPrenom").val(),
                        'date_naissance':$("#inputDate").val(),
                        'id_sexe':$("#inputSexe").val(),
                    }
                }
            }).done(function(data){
                console.log("REQUETE AJAX SUCCED");
                console.log(data);
                document.location.reload();
            }).fail(function(){
                console.log("REQ AJAX FAILED");
            })
        } else {
            $("#profile .box").prepend('<div class="textError">Veuillez renseignez les champs.</div>');
            console.log('Loupé');
        }
    }
}

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