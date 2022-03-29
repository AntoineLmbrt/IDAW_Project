<?php
    session_start();
    require_once('blank.php');
    require_once('header.php');
?>

<div class="content">
    <?php

        if (!isset($_SESSION['login'])) {
            if (isset($_GET['signup'])) {
                require_once('signup.php');
                echo "<a href = 'index.php'><h6>Déjà inscrit ? Connectez-vous !</h6></a>";
                addBlank('50px');
            } else {
                addBlank('50px');
                require_once('login.php');
                echo "<a href = 'index.php?signup'><h6>S'inscrire</h6></a>";
                addBlank('100px');
            }
        } else {

            if(isset($_GET['home'])){
                require_once('home.php');
            }
        
            if(isset($_GET['profil'])){
                require_once('profil.php');
            }
        
            if(isset($_GET['aliments'])){
                require_once('aliments.php');
            }

            if(isset($_GET['journal'])){
                require_once('journal.php');
            }
        }
    ?>

</div>

<?php
    require_once('footer.php');
?>

