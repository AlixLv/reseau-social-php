<?php
include_once 'main-utilities.php';
function isLoggedIn($session_id) {
    return isset($session_id) ? true : false;
}
session_start();
$currentUrl = getUrl($_SERVER['REQUEST_URI']);


function logout() {
    echo 'logout';
    session_destroy();
    header("Refresh:0");
}

if (isset($_POST['logout'])){
    logout();
} 
?>

<header>
    <img src="../images/resoc.jpg" alt="Logo de notre réseau social" />
    <nav id="menu">
        <a href="../news/news-display.php">Actualités</a>
        <?php 
        if (isset($_SESSION['connected_id'])){
           echo "<a href='../wall/wall-display.php?user_id=" .  $_SESSION['connected_id']. "'>Mur</a>";
            echo "<a href='../feed/feed-display.php?user_id=" . $_SESSION['connected_id'] . "'>Flux</a>";

        }
        else {
           echo "<a href='../login/login-display.php'>Mur</a>";
           echo  "<a href='../login/login-display.php'>Flux</a>";
        }
        ?>
        <a href="../tags/tags-display.php?tag_id=1">Mots-clés</a>
        

        
    </nav>
    <nav id="user">
        <?php
            if (isset($_SESSION['connected_id'])) {
                echo "<a href='#'>Profil</a>";
                echo "<ul>";
                echo "<li><a href='../settings/settings-display.php?user_id=" . $_SESSION['connected_id'] . "'>Paramètres</a></li>";
                echo "<li><a href='../followers/followers-display.php?user_id=" . $_SESSION['connected_id'] . "'>Mes suiveurs</a></li>";
                echo "<li><a href='../subscriptions/subscriptions-display.php?user_id=" . $_SESSION['connected_id'] . "'>Mes abonnements</a></li>";
                echo "<form action='../login/login-display.php' method='post'><li><input type='submit' value='Déconnexion' name='logout'/></li></form>";
                echo "</ul>";

            }
            else {
                echo "<a href='../login/login-display.php'>Login</a>";
            }
        ?>
    </nav>
</header>