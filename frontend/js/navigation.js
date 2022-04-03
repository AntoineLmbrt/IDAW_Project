// CHARGEMENT DES DONNEES DU PROFIL POUR AFFICHER LE NOM ET LE PRENOM
$('document').ready(chargementProfil());

function chargementProfil(){
    $.ajax({
        url:'../backend/utilisateur.php?function=profil',
        dataType:'json',

    }).done(function(donnée){
        $('.name').append(`${donnée["prenom"]} ${donnée['nom']}`);
    }).fail(function(){

    })
}