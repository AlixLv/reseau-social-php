<?php 
    session_start();
    include  'database-connection.php';
    $mysqli = dataBaseConnexion();
    $session_id = $_SESSION["connected_id"];

    $post_id = $_POST["post_id"];

    $checkedIfLikedQuery = $mysqli->query("SELECT * FROM likes
    WHERE user_id =" . $session_id . "
    AND post_id =" . $post_id);

    if ($checkedIfLikedQuery->num_rows == 0) {
        $likedQuery = $mysqli->query("INSERT INTO likes
        (id, user_id, post_id)
        VALUES (NULL, " . $session_id . ", ". $post_id .")");
    } else {
        $dislikedQuery = $mysqli->query("DELETE FROM likes
        WHERE user_id = " . $session_id . " 
        AND post_id = ". $post_id);
    }
    header("Location: ./wall.php?user_id=" . $_GET['user_id']);

?>