<?php
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