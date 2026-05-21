<?php

session_start();


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
        body { margin: 0; font-family: Arial; }
        .container { display: flex; }
        .sidebar {
            width: 220px;
            background: #2c3e50;
            height: 100vh;
            padding: 20px;
            color: white;
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
        .content { padding: 20px; width: 100%; }
        .form-box {
    max-width: 400px;
    background: #f4f6f7;
    padding: 20px;
    border-radius: 5px;
}

.form-box label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

.form-box input {
    width: 100%;
    padding: 8px;
    margin-bottom: 15px;
}

.form-box button {
    padding: 8px 15px;
    background: #2c3e50;
    color: white;
    border: none;
    cursor: pointer;
}

.form-box button:hover {
    background: #34495e;
}
.data-table {
    width: 100%;
    border-collapse: collapse;
    background: #ffffff;
}

.data-table th {
    background: #2c3e50;
    color: white;
    padding: 10px;
    text-align: left;
}

.data-table td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
}

.data-table tr:hover {
    background: #f2f2f2;
}
    </style>
</head>
<body>

<div class="container">
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

<div class="content">