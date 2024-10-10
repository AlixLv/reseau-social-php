<?php 
    include '../../resoc_n1/main/main-utilities.php';
    include '../../resoc_n1/main/header.php';
    include '../../resoc_n1/queries.php';
    

    $mysqli = dataBaseConnexion();
    $userId = intval($_SESSION['connected_id']);
    $userIdInfos = getQueryResponse(getUserIdInfos($userId), $mysqli);
    $user = $userIdInfos->fetch_assoc();
    $feedPosts = getQueryResponse(getFeedPosts($userId), $mysqli);
?>



