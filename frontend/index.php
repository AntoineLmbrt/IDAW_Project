<?php
    session_start();

    require_once('header.php');

    // NAVIGATION
    require_once('navigation.php');

    $currentPageId = 'home';
    if(isset($_GET['page'])) {
        $currentPageId = $_GET['page'];
    }
    
    renderMenuToHTML($currentPageId);

?>

<div class="content">
    <?php

        // PAS DE SESSION : REDIRECTION VERS LA PAGE DE LOGIN AVEC POSSIBILITÉ DE S'INSCRIRE
        if (!isset($_SESSION['login'])) {
            if (isset($_GET['signup'])) {
                require_once('signup.php');
                echo "<a class='form-link' href = 'index.php'><h6>Déjà inscrit ? Connectez-vous !</h6></a>";
            } else {
                require_once('login.php');
                echo "<a class='form-link' href = 'index.php?signup'><h6>S'inscrire</h6></a>";
            }


        // DECONNEXION ET REDIRECTION VERS LA PAGE INDEX.PHP (LOGIN)
        } else if (isset($_GET['logout'])) {
            session_unset();
            session_destroy();
            unset($_GET['logout']);
            header('Location: index.php');

        
        // SESSION EN COURS : CONTENU DE LA PAGE SOUHAITÉE
        } else {
            $pageToInclude = $currentPageId . ".php";
            if(is_readable($pageToInclude))
                require_once($pageToInclude);
            else
                require_once("error.php");
        }

    ?>
</div>

<script>
    $('#logout').on("click", () => {
        console.log('test');
        $(location).prop('href', 'index.php?logout')
    });
</script>