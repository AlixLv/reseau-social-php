<?php

// include '../../resoc_n1/main/main-utilities.php';

function isLoggedIn($session_id) {
    return isset($session_id) ? true : false;
}

?>

<header>
    <img src="../images/resoc.jpg" alt="Logo de notre réseau social" />
    <nav id="menu">
        <a href="../../resoc_n1/news/news-display.php">Actualités</a>
        <a href="../../resoc_n1/wall/wall-display.php?user_id=5">Mur</a>
        <a href="../../resoc_n1/feed/feed-display.php">Flux</a>
        <a href="../../resoc_n1/tags/tags-display.php?tag_id=1">Mots-clés</a>
    </nav>
    <nav id="user">
        <?php
        
        ?>
        <a href="#">Profil</a>
        <ul>
            <li><a href="../../resoc_n1/settings/settings-display.php?user_id=5">Paramètres</a></li>
            <li><a href="../../resoc_n1/followers/followers-display.php?user_id=5">Mes suiveurs</a></li>
            <li><a href="../../resoc_n1/subscriptions/subscriptions-display.php?user_id=5">Mes abonnements</a></li>
        </ul>
    </nav>
</header>