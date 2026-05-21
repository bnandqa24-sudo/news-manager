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

$stmt = $connection->prepare("SELECT * FROM news WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

$news = $result->fetch_assoc();


$categories = $connection->query("SELECT * FROM categories");


if (isset($_POST['update_news'])) {

    $title = $_POST['title'];
    $content = $_POST['content'];
    $category_id = $_POST['category_id'];

    if (!empty($_FILES['image']['name'])) {

        $imageName = $_FILES['image']['name'];
        $imageTmp = $_FILES['image']['tmp_name'];

        $uniqueName = time() . "_" . $imageName;
        $uploadPath = "../uploads/" . $uniqueName;

        move_uploaded_file($imageTmp, $uploadPath);

        $stmt = $connection->prepare("
            UPDATE news 
            SET title = ?, content = ?, category_id = ?, image = ?
            WHERE id = ?
        ");

        $stmt->bind_param("ssisi", $title, $content, $category_id, $uniqueName, $id);

    } else {

        $stmt = $connection->prepare("
            UPDATE news 
            SET title = ?, content = ?, category_id = ?
            WHERE id = ?
        ");

        $stmt->bind_param("ssii", $title, $content, $category_id, $id);
    }

    $stmt->execute();

    header("Location: view-news.php");
    exit();
}
?>

<h2>Edit News</h2>

<form method="POST" enctype="multipart/form-data">

    <input type="text" name="title"
           value="<?php echo $news['title']; ?>" required>
    <br><br>

    <textarea name="content" required><?php echo $news['content']; ?></textarea>
    <br><br>

    <select name="category_id">
        <?php while ($cat = $categories->fetch_assoc()) { ?>
            <option value="<?php echo $cat['id']; ?>"
                <?php if ($cat['id'] == $news['category_id']) echo "selected"; ?>>
                <?php echo $cat['name']; ?>
            </option>
        <?php } ?>
    </select>

    <br><br>

 
    <?php if (!empty($news['image'])) { ?>
        <img src="../uploads/<?php echo $news['image']; ?>" width="100">
        <br><br>
    <?php } ?>

    <input type="file" name="image">

    <br><br>

    <button type="submit" name="update_news">Update</button>

</form>

<?php require_once "footer.php"; ?>