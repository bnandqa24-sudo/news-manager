<?php
session_start();
require_once "../config/Database.php";
require_once "../classes/User.php";

$db = new Database();
$conn = $db->connect();
$user = new User($conn);

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($user->login($email, $password)) {
        header("Location: ../dashboard/index.php");
        exit();
    } else {
        echo "Invalid email or password";
    }
}
?>

<html>
    <head>
        <title>login</title>
    </head>
    <body>
        <center>
            <h1>Hello!</h1>
    <form method="POST">
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <button type="submit" name="login">Login</button>
</form>

</center>
    </body>



</html>
