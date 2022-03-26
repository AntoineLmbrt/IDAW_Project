<form id="inscription" action="inscription.php" method="POST" onSubmit="submitInscription()">
    <table>
        <tr>
            <th>Nom :</th>
            <td><input type="text" id="inputNom"></td>
            <th>Prénom :</th>
            <td><input type="text" id="inputPrenom"></td>
        <tr>
            <th>Adresse mail :</th>
            <td><input type="text" id="inputLogin"></td>
        </tr>
        <tr>
            <th>Mot de passe :</th>
            <td><input type="password" name="inputPassword"></td>
        </tr>
        <tr>
            <th>Date de Naissance :</th>
            <td><input type="date" name="inputBirthday"></td>
        </tr>
        <tr>
            <th>Sexe :</th>
            <td>
            <select name="sexe" id="inputSexe">
                </select>
            </td>
        </tr>
        <tr>
            <th></th>
            <td><input type="submit" value="S'inscrire" /></td>
        </tr>
    </table>
</form>
<script>
    document.getElementById('inputSexe').addEventListener('load',chargementSexe());
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

</script>