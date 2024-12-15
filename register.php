<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->execute([$username, $password]);

    echo "Регистрация успешна! <a href='login.php'>Войти</a>";
}
?>

<form method="post">
    Логин: <input type="text" name="username" required>
    Пароль: <input type="password" name="password" required>
    <button type="submit">Зарегистрироваться</button>
</form>