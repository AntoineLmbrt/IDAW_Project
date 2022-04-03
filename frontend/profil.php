<h1 id="title">Profil</h1>
<div id="profile">
    <div class="box">
        <table>
            <tr>
                <td class="profile-key">Nom :</td>
                <td class="profile-value">POIROT</td>
            </tr>
            <tr>
                <td class="profile-key">Prénom :</td>
                <td class="profile-value">Alexis</td>
            </tr>
            <tr>
                <td class="profile-key">Email :</td>
                <td class="profile-value">alexis.poirot@blablabla.com</td>
            </tr>
            <tr>
                <td class="profile-key">Date de naissance :</td>
                <td class="profile-value">01/01/0101</td>
            </tr>
            <tr>
                <td class="profile-key">Genre :</td>
                <td class="profile-value">Homme</td>
            </tr>
        </table>
    </div>
</div>

<script>

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
</script>