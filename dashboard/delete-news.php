<?php
require_once "../config/database.php";


$db = new Database();
$connection = $db->connect();

$id = $_GET['id'];

$stmt = $connection->prepare("UPDATE news SET status = 'deleted' WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: view-news.php");
exit;

?>

<a href="delete-news.php?id=<?= $row['id']; ?>" 
   onclick="return confirm('Are you sure you want to delete this news?');">
   Delete
</a>