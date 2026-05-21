<?php
session_start();
require_once "../config/Database.php";
require_once "../classes/User.php";

$db = new Database();
$conn = $db->connect();
$user = new User($conn);

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($user->register($name, $email, $password)) {
        echo "Registered successfully";
    } else {
        echo "Registration failed";
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
    <input type="text" name="name" placeholder="Name" required><br><br>
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <button type="submit" name="register">Register</button>
</form>


 
</center>
    </body>



</html>
