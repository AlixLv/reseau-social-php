<?php 
    session_start();
    include '../resoc_n1/database-connection.php';
    
    $wall_id = $_GET["user_id"];
    $session_id = $_SESSION["connected_id"];

    $checkIfFollowedQuery = "SELECT * FROM followers
    WHERE following_user_id =" . $session_id . "
    AND followed_user_id =" . $wall_id ;

    $checkedFollowQuery = $mysqli->query($checkIfFollowedQuery);

    if ($checkedFollowQuery->num_rows == 0) {
        $followQuery = "INSERT INTO followers
        (id, followed_user_id, following_user_id)
        VALUES (NULL, " . $wall_id . ", ". $session_id .")";

        $ok = $mysqli->query($followQuery);
    }
    header("Location: ./wall.php?user_id=" . $wall_id);
?>