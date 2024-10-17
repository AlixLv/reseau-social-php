<?php 
        include '../main/header.php';
        include_once '../main/main-utilities.php';
        include './followers-query.php';

        $mysqli = dataBaseConnexion();
        $userId = intval($_GET['user_id']);
        $followersData = getQueryResponse(getFollowersQuery($userId), $mysqli);
    ?>