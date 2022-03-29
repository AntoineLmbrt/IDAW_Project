<form id="login-form" action="" onSubmit="connection()">
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
            <input type="submit" value="Se connecter...">
        </li>
    </ul>
</form>
<script>
    function connection(){
        event.preventDefault();
        console.log('Test');
        if( $("#inputLogin").val()!='' && $("#inputPassword").val()!='' ){
            $.ajax({
                url:"../backend/utilisateur.php?function=auth&login="+$("#inputLogin").val()+"&password="+$("#inputPassword").val(),
                method:'GET',
                dataType:"json",
            }).done(function(data){
                console.log("REQUETE AJAX SUCCED");
                console.log(data);
                if(data['resultat']=='true'){
                    window.location.replace("http://project/frontend/index.php?home");
                }
                else{
                    //-----> ENTRER CODE MAUVAUS LOGIN/MDP
                }

            }).fail(function(){
                console.log('REQUETE AJAX FAILED');
            })
        } else{
            // -----> ENTRER CODE MAUVAIS LOGIN/MDP
            console.log('Loupé');
        }
    }
</script>