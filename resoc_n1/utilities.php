<?php

function dataBaseConnexion(){
    $mysqli = new mysqli("localhost", "root", "", "socialnetwork");
        if ($mysqli->connect_errno)
        {
            echo "<article>";
            echo("Échec de la connexion : " . $mysqli->connect_error);
            echo("<p>Indice: Vérifiez les parametres de <code>new mysqli(...</code></p>");
            echo "</article>";
            exit();
        }
    return $mysqli;
}


function checkFollower($followedUser, $followingUser) {
    $mysqli = dataBaseConnexion();

    $checkQuery = $mysqli->query("SELECT * FROM followers
    WHERE following_user_id =" . $followingUser . "
    AND followed_user_id =" . $followedUser);

    if ($checkQuery->num_rows==0) {
        return false;
    } else {
        return true;
    }
}



?>