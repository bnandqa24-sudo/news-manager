<?php

require_once "../config/database.php";
require_once "header.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

$db = new Database();
$connection = $db->connect();

$query = "
    SELECT news.id, news.title, news.content, categories.name AS category_name
    FROM news
    JOIN categories ON news.category_id = categories.id
    WHERE news.status = 'deleted'
";

$result = $connection->query($query);

?>

<div class="content">
    <h2>Deleted News (Archive)</h2>

    <table class="data-table">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Category</th>
            <th>Content</th>
            <th>Actions</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['category_name']; ?></td>
                <td><?php echo $row['content']; ?></td>
                <td>
            <a href="restore-news.php?id=<?php echo $row['id']; ?>"
               onclick="return confirm('Restore this news?');">
               Restore
            </a>
        </td>
  
            </tr>
        <?php } ?>
    </table>
</div>

<?php require_once "footer.php"; ?>