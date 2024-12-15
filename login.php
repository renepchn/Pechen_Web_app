<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $username;

        setcookie("username", $username, time() + (86400 * 30), "/"); 

        header("Location: welcome.php");
        exit;
    } else {
        echo "Неверный логин или пароль!";
    }
}
?>

<form method="post">
    Логин: <input type="text" name="username" required>
    Пароль: <input type="password" name="password" required>
    <button type="submit">Войти</button>
</form>