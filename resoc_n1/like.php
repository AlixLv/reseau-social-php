<?php 
    session_start();
    include '../resoc_n1/database-connection.php';

    $session_id = $_SESSION["connected_id"];
    $post_id = $post["post_id"];
    echo $post_id;

    $checkIfLikedQuery = "SELECT * FROM likes
    WHERE user_id =" . $session_id . "
    AND post_id =" . $post_id ;

    $checkedLikedQuery = $mysqli->query($checkIfLikedQuery);

    if ($checkedLikedQuery->num_rows == 0) {
        $likedQuery = "INSERT INTO likes
        (id, user_id, post_id)
        VALUES (NULL, " . $session_id . ", ". $post_id .")";

        $ok = $mysqli->query($likedQuery);
        header("Location: ./wall.php?user_id=3");
    }
    

?>