<?php 
        include '../main/header.php';
        include '../main/main-utilities.php';
        include './followers-query.php';

        $mysqli = dataBaseConnexion();
        $userId = intval($_GET['user_id']);
        $followersData = getQueryResponse(getFollowersQuery($userId), $mysqli);
    ?>