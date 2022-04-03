// CHARGEMENT DES DONNÉES DU PROFIL
$("body").ready(chargementDonneeProfil());

function chargementDonneeProfil() {
  $.ajax({
    url: "../backend/utilisateur.php?function=profil",
    dataType: "json",
  })
    .done(function (data) {
        console.log("REQ AJAX SUCCED");
        $("#nom").append(data["nom"]);
        $("#prenom").append(data["prenom"]);

        $("#date_naissance").append(data["date_naissance"]);
        $("#login").append(data["login"]);
        $("#libelle").append(data["libelle"]);
    })
    .fail(function () {
      console.log("REQ AJAX FAILED");
    });
}
