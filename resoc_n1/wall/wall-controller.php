<?php 

include 'wall-queries.php';
include '../main/header.php';
include_once '../main/main-utilities.php';

$mysqli = dataBaseConnexion();
if (isset($_SESSION['connected_id'])) {
    $connected_id = $_SESSION['connected_id'];
} else {
    $connected_id = null;
}
$userId =intval($_GET['user_id']);
$end_url = getUrl($_SERVER['REQUEST_URI']);
$wall_user_id = getUserName($mysqli, $userId);

?>