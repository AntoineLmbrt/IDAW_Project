<h1 id="title">Connexion</h1>
<form id="login-form" onSubmit="connection()">
    <ul>
        <li>
            <label>Login :</label>
            <input type="text" name="login" id="inputLogin">
        </li>
        <li>
            <label>Mot de passe :</label>
            <input type="password" name="password" id="inputPassword">
        </li>
        <li>
            <input type="submit" value="Connexion">
        </li>
    </ul>
</form>
<script>
    function connection(){
        champsObligatoires = ["#inputLogin", "#inputPassword"]
        event.preventDefault();
        console.log('Test');
        if ($(".textError") != null) {
            $(".textError").detach();
        }
        if( $("#inputLogin").val()!='' && $("#inputPassword").val()!='' ){
            $.ajax({
                url:"../backend/utilisateur.php?function=auth&login="+$("#inputLogin").val()+"&password="+$("#inputPassword").val(),
                method:'GET',
                dataType:"json",
            }).done(function(data){
                console.log("REQUETE AJAX SUCCED");
                console.log(data);
                if(data['resultat']=='true'){
                    window.location.replace("index.php?home");
                }
                else{
                    $("#login-form ul").prepend('<div class="textError">Login et/ou mot de passe incorrect</div>');
                }

            }).fail(function(){
                console.log('REQUETE AJAX FAILED');
            });
            champsObligatoires.forEach(element => { 
                $(element).css("border", "1px solid #18A585");
            });
        } else {
            $("#login-form ul").prepend('<div class="textError">Veuillez renseignez les champs.</div>');
            console.log('Loupé');
            champsObligatoires.forEach(element => {
                if ($(element).val() == "")
                    $(element).css("border", "2px solid #E83333");
                else
                    $(element).css("border", "1px solid #18A585");    
            });
        }
    }
</script>