<?php
function isLoggedIn($session_id) {
    return isset($session_id) ? true : false;
}
session_start();
?>

<header>
    <img src="../images/resoc.jpg" alt="Logo de notre réseau social" />
    <nav id="menu">
        <a href="../news/news-display.php">Actualités</a>
        <a href="../wall/wall-display.php?user_id=5">Mur</a>
        <a href="../feed/feed-display.php">Flux</a>
        <a href="../tags/tags-display.php?tag_id=1">Mots-clés</a>
    </nav>
    <nav id="user">
        <?php
            if (isset($_SESSION['connected_id'])) {
                echo "<a href='#'>Profil</a>";
                echo "<ul>";
                echo "<li><a href='../settings/settings-display.php?user_id=5'>Paramètres</a></li>";
                echo "<li><a href='../followers/followers-display.php?user_id=5'>Mes suiveurs</a></li>";
                echo "<li><a href='../subscriptions/subscriptions-display.php?user_id=5'>Mes abonnements</a></li>";
                echo "</ul>";

            }
            else {
                echo "<a href='../login/login-display.php'>Login</a>";
            }
        ?>
    </nav>
</header>