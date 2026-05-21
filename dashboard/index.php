<?php
session_start();

// حماية الصفحة
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body {
            margin: 0;
            font-family: Arial;
        }
        .container {
            display: flex;
        }
        .sidebar {
            width: 220px;
            background: #2c3e50;
            height: 100vh;
            padding: 20px;
            color: white;
        }
        .sidebar h3 {
            color: #ecf0f1;
        }
        .sidebar a {
            display: block;
            color: #ecf0f1;
            text-decoration: none;
            margin: 10px 0;
        }
        .sidebar a:hover {
            background: #34495e;
            padding-left: 5px;
        }
        .content {
            padding: 20px;
            width: 100%;
        }

        
    </style>
</head>

<body>

<div class="container">

    <!-- Sidebar -->
    <div class="sidebar">
        <h3>News System</h3>
        <p>Welcome, <?php echo $_SESSION['user_name']; ?></p>

        <a href="index.php">Dashboard</a>
        <a href="add-category.php">Add Category</a>
        <a href="view-categories.php">View Categories</a>
        <a href="add_news.php">Add News</a>
        <a href="view-news.php">View News</a>
        <a href="deleted-news.php">Deleted News</a>
        <a href="../auth/logout.php">Logout</a>
    </div>

    <!-- Main Content -->
    <div class="content">
        <h2>Dashboard</h2>
        <p>This is the main dashboard page.</p>
    </div>

</div>

</body>
</html>