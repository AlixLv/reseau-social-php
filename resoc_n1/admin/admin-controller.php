<?php 
        include '../main/header.php';
        include_once '../main/main-utilities.php';
        include './admin-query.php';

        $mysqli = dataBaseConnexion();
        $tagsData = getQueryResponse(getTagsQuery(), $mysqli);
        $usersData = getQueryResponse(getUsersQuery(), $mysqli);               
?>