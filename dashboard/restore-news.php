<?php

require_once "../config/database.php";
require_once "header.php";



if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

$db = new Database();
$connection = $db->connect();

$id = $_GET['id'];

$stmt = $connection->prepare("UPDATE news SET status = 'active' WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: deleted-news.php");
exit();