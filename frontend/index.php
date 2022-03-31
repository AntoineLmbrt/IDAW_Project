<?php
    session_start();
    require_once('blank.php');
    require_once('navigation.php');

    $currentPageId = 'home';
    if(isset($_GET['page'])) {
        $currentPageId = $_GET['page'];
    }

    require_once('header.php');
    renderMenuToHTML($currentPageId);
?>

<div class="content">
    <?php

        if (!isset($_SESSION['login'])) {
            if (isset($_GET['signup'])) {
                require_once('signup.php');
                echo "<a href = 'index.php'><h6>Déjà inscrit ? Connectez-vous !</h6></a>";
            } else {
                require_once('login.php');
                echo "<a href = 'index.php?signup'><h6>S'inscrire</h6></a>";
            }
        } else if (isset($_GET['logout'])) {
            session_unset();
            session_destroy();
            unset($_GET['logout']);
            header('Location: index.php');
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