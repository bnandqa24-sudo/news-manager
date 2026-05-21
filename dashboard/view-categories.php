<?php

require_once "../config/Database.php";
require_once "../classes/Category.php";
require_once "header.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

$db = new Database();
$conn = $db->connect();
$category = new Category($conn);

$categories = $category->getAll();
?>

<h2>Categories</h2>

<table class="data-table">
    <tr>
        <th>ID</th>
        <th>Category Name</th>
        <th>Actions</th>
    </tr>

    <?php while ($row = $categories->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td>
    <a href="edit_category.php?id=<?php echo $row['id']; ?>">Edit</a>
</td>
        </tr>
    <?php } ?>
</table>

<?php require_once "footer.php"; ?>