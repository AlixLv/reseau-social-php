<?php 
    include '../main/main-utilities.php';
    include '../main/header.php';
    include './feed-query.php';
    
    $mysqli = dataBaseConnexion();
    $userId = intval($_SESSION['connected_id']);
    $userIdInfos = getQueryResponse(getUserIdInfos($userId), $mysqli);
    $user = $userIdInfos->fetch_assoc();
    $end_url = getUrl($_SERVER['REQUEST_URI']);
    $connected_id = $_SESSION['connected_id'];


    
?>



