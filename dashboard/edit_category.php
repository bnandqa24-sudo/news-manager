<?php
require_once "database.php";

$db = new Database();
$connection = $db->connect();

/* 1️⃣ التأكد إن في id جاي من الرابط */
if (!isset($_GET['id'])) {
    die("Category ID not found");
}

$id = $_GET['id'];

/* 2️⃣ جلب بيانات الفئة */
$result = $connection->query("SELECT * FROM categories WHERE id = $id");

if ($result->num_rows == 0) {
    die("Category not found");
}

$category = $result->fetch_assoc();

/* 3️⃣ تنفيذ التحديث */
if (isset($_POST['update_category'])) {
    $name = $_POST['name'];

    $connection->query("UPDATE categories SET name = '$name' WHERE id = $id");

    header("Location: categories.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Category</title>
</head>
<body>

<h2>Edit Category</h2>

<form method="POST">
    <input 
        type="text" 
        name="name" 
        value="<?php echo $category['name']; ?>" 
        required
    >
    <br><br>
    <button type="submit" name="update_category">Update</button>
</form>

</body>
</html>