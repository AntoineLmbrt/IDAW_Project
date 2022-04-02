<?php
    function renderMenuToHTML($currentPageId) {
        $myMenu = array(
            'home' => array('Home'),
            'profil' => array('Profil'),
            'journal' => array('Journal'),
            'aliments' => array('Aliments')
        );
        
        echo('
            <nav class="menu">
                <div class="logo">
                    <img src="imgs/logos/logo_light">
                    <div class="logo_name">iMANGERMIEUX</div>
                </div>
                <ul>
        ');


        foreach($myMenu as $pageId => $pageParameters) {
            if ($pageId === $currentPageId) {
                echo('<li><a id="currentpage" href="index.php?page='.$pageId.'">'.$pageParameters[0].'</a></li>');
            }
            else {
                echo('<li><a href="index.php?page='.$pageId.'">'.$pageParameters[0].'</a></li>');
            }
        }

        echo('
                </ul>
                <div class="profile">
                    <div class ="details">
                        <div class="name"></div>
                        <div class="btn" id="logout">Déconnexion</div>
                    </div>
                </div>
            </nav>
        ');
    }
?>
<script>
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
</script>