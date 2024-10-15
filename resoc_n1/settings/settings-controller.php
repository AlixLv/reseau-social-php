<?php
    include '../main/header.php';
    include '../main/main-utilities.php';
    include "./settings-query.php";
    $mysqli = dataBaseConnexion();
    $userId = intval($_GET['user_id']);

    $postsData = getQueryResponse(getPostsQuery($userId), $mysqli);
    $user = $postsData->fetch_assoc();
?>  