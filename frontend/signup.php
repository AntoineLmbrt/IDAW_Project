<form id="signup-form" action="inscription.php" method="POST" onload="chargementSexe()">
    <ul>
        <li>
            <label>Nom et Prénom</label>
            <input type="text" name="inputNom" class="two-fields" placeholder="Nom">
            <input type="text" name="inputPrenom" class="two-fields" placeholder="Prénom">
        </li>
        <li>
            <label>Email</label>
            <input type="email" name="inputLogin" class="one-field" placeholder="Email">
        </li>
        <li>
            <label>Mot de passe</label>
            <input type="passeword" name="inputPassword" class="one-field" placeholder="Mot de passe">
        </li>
        <li>
            <label>Date de naissance</label>
            <input type="date" name="inputBirthday">
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

</script>