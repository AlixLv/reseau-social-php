<?php
    session_start();
?>
<header>
    <img src="resoc.jpg" alt="Logo de notre réseau social" />
    <nav id="menu">
        <a href="../resoc_n1/news.php">Actualités</a>
        <a href="../resoc_n1/wall.php?user_id=5">Mur</a>
        <a href="../resoc_n1/feed.php?user_id=5">Flux</a>
        <a href="../resoc_n1/tags.php?tag_id=1">Mots-clés</a>
    </nav>
    <nav id="user">
        <a href="#">Profil</a>
        <ul>
            <li><a href="../resoc_n1/settings.php?user_id=5">Paramètres</a></li>
            <li><a href="../resoc_n1/followers.php?user_id=5">Mes suiveurs</a></li>
            <li><a href="../resoc_n1/subscriptions.php?user_id=5">Mes abonnements</a></li>
        </ul>
    </nav>
</header>