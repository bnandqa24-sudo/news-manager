<?php


require_once "../config/database.php";
require_once "header.php";

$db = new Database();
$connection = $db->connect();

$categories = $connection->query("SELECT * FROM categories");

if (isset($_POST['add_news'])) {

    $title = $_POST['title'];
    $content = $_POST['content'];
    $category_id = $_POST['category_id'];
    $user_id = $_SESSION['user_id'];

    // image upload
    $imageName = $_FILES['image']['name'];
    $imageTmp = $_FILES['image']['tmp_name'];

    $uniqueName = time() . "_" . $imageName;
    $uploadPath = "../uploads/" . $uniqueName;

    move_uploaded_file($imageTmp, $uploadPath);

    // insert
    $stmt = $connection->prepare("
        INSERT INTO news (title, content, image, category_id, user_id, status)
        VALUES (?, ?, ?, ?, ?, 'active')
    ");

    $stmt->bind_param("sssii", $title, $content, $uniqueName, $category_id, $user_id);
    $stmt->execute();

    echo "<p style='color:green'>News added successfully</p>";
}
?>

<h2>Add News</h2>

<form method="POST" enctype="multipart/form-data">

    <input type="text" name="title" placeholder="News title" required>
    <br><br>

    <textarea name="content" placeholder="News content" required></textarea>
    <br><br>

    <input type="file" name="image" required>
    <br><br>

    <select name="category_id" required>
        <option value="">Select Category</option>
        <?php while ($cat = $categories->fetch_assoc()) { ?>
            <option value="<?php echo $cat['id']; ?>">
                <?php echo $cat['name']; ?>
            </option>
        <?php } ?>
    </select>

    <br><br>

    <button type="submit" name="add_news">Add News</button>
</form>

<?php require_once "footer.php"; ?>