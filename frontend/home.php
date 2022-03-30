<?php
print_r($_SESSION);
?>
<div id='graphCalorie'>
</div>

<div id="journalRepas"></div>

<div id="journalSport"></div>

<script>
    $('body').ready(chargementDonnee());
    var nbCalorie = 0;
    var objectif=0
    function chargementDonnee(){
        // Dashboard
        $.ajax({
            url:'http://project/backend/utilisateur.php?function=objectif',
            dataType:'json',
        }).done(function(data){
            console.log("REQ AJAX SUCCED");
            nbCalorie+=parseInt(data);
            objectif=parseInt(data);
            // On récupère les calorie mangé
            $.ajax({
                url:'http://project/backend/repas.php?time=day',
                dataType:'json',
            }).done(function(data){
                console.log('REQ AJAX SUCCED');
                nbCalorie-=parseInt(data);
                // On récupère les calories dépensé
                $.ajax({
                    url:'http://project/backend/pratique.php?time=day',
                    dataType:'json',
                }).done(function(data){
                    console.log('REQ AJAX SUCCED');
                    nbCalorie+=parseInt(data);

                    $('#graphCalorie').append(`${nbCalorie}/${objectif}`)
                }).fail(function(){
                    console.log("REQ AJAX FAILED");
                })


            }).fail(function(){
                console.log("REQ AJAX FAILED");
            })

        }).fail(function(){
            console.log("REQ AJAX FAILED");
        })


        //Journal Repas
        journalRepas();
        //Journal Sport
        journalSport();
    }


    function journalRepas(){
        $.ajax({
            url:'http://project/backend/repas.php?time=3days',
            dataType:'json',
        }).done(function(data){
            console.log('REQ AJAX SUCCED');
            console.log(data);
            
        }).fail(function(){
            console.log('REQ AJAX FAILED')
        })
    }

    function journalSport(){
        $.ajax({
            url:'http://project/backend/pratique.php?time=3days',
            dataType:'json',
        }).done(function(data){
            console.log('REQ AJAX SUCCED');
            console.log(data);
            
        }).fail(function(){
            console.log('REQ AJAX FAILED')
        })
    }
</script>