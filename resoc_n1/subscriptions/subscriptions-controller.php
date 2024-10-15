<?php
    include '../main/header.php';
    include './subscriptions-query.php';
    include_once '../main/main-utilities.php';

    $mysqli = dataBaseConnexion();
    $connected_id = $_SESSION['connected_id'];                
    $userId = intval($_GET['user_id']); 
    $followingData = getQueryResponse(getFollowingQuery($userId), $mysqli);
?>