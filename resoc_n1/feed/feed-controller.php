<?php 
    include '../main/main-utilities.php';
    include '../main/header.php';
    include '../queries.php';
    
    $mysqli = dataBaseConnexion();
    $userId = intval($_SESSION['connected_id']);
    $userIdInfos = getQueryResponse(getUserIdInfos($userId), $mysqli);
    $user = $userIdInfos->fetch_assoc();
    $feedPosts = getQueryResponse(getFeedPosts($userId), $mysqli);
    $end_url = getUrl($_SERVER['REQUEST_URI']);
    $connected_id = $_SESSION['connected_id'];
?>



