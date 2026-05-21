<?php

require_once "../config/Database.php";
require_once "../classes/Category.php";
require_once "header.php";


// حماية الصفحة
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

$db = new Database();
$conn = $db->connect();
$category = new Category($conn);

if (isset($_POST['add_category'])) {
    $name = $_POST['name'];

    if ($category->add($name)) {
        echo "Category added successfully";
    } else {
        echo "Failed to add category ";
    }
}
?>

<h2>Add Category</h2>

<form method="POST" class="form-box">
    <label>Category Name</label>
    <input type="text" name="name" placeholder="Enter category name" required>

    <button type="submit" name="add_category">Add Category</button>
</form>

<?php require_once "footer.php"; ?>