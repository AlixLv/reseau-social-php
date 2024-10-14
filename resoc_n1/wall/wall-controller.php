<?php 

include 'wall-queries.php';
include '../main/header.php';
include '../main/main-utilities.php';

$mysqli = dataBaseConnexion();
$connected_id = $_SESSION['connected_id'];
$userId =intval($_GET['user_id']);
$end_url = getUrl($_SERVER['HTTPS'], $_SERVER['REQUEST_URI']);
var_dump($end_url);
$wall_user_id = getUserName($mysqli, $userId);

?>