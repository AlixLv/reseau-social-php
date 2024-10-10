<?php
session_start();

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

function isLoggedIn() {
    return isset($_SESSION["connected_id"]) ? true : false;
}

function getQueryResponse($sqlQuery, $mysqli) {
    $response = $mysqli->query($sqlQuery);
    if ( ! $response)
    {
        echo("Échec de la requete : " . $mysqli->error);
        exit();
    }
    return $response;
}


?>