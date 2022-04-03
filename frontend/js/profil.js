// CHARGEMENT DES DONNÉES DU PROFIL
$('body').ready(chargementDonneeProfil());

function chargementDonneeProfil(){
    $.ajax({
        url:"../backend/utilisateur.php?function=profil",
        dataType:"json",
    }).done(function(data){
        console.log("REQ AJAX SUCCED");
        console.log(data);
    }).fail(function(){
        console.log("REQ AJAX FAILED");
    })
}