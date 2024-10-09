<?php 
    session_start();
    include '../resoc_n1/database-connection.php';
    include "utilities.php";
    $mysqli = dataBaseConnexion();

    $wall_id = $_GET["user_id"];
    $session_id = $_SESSION["connected_id"];

    if (!checkFollower($wall_id, $session_id)) {
         $followQuery = $mysqli->query("INSERT INTO followers
        (id, followed_user_id, following_user_id)
        VALUES (NULL, " . $wall_id . ", ". $session_id . ")");
    } else {
        $unfollowQuery = $mysqli->query("DELETE FROM followers
        WHERE followed_user_id = " . $wall_id . "
        AND following_user_id = " . $session_id);
    }
    header("Location: ./wall.php?user_id=" . $wall_id);
?>