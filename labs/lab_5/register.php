<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $name = $_POST['name'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE login = ?");
    $stmt->execute([$login]);
    if ($stmt->fetch()) {
        echo "Користувач з таким логіном вже існує!";
    } else {
        $stmt = $pdo->prepare("INSERT INTO users (login, password, email, name, created_at) VALUES (?, ?, ?, ?, NOW())");
        $stmt->execute([$login, $password, $email, $name]);
        echo "Реєстрація успішна! <a href='index.php'>Увійти</a>";
    }
} else {
?>
<form method="POST">
    <input name="login" placeholder="Логін"><br>
    <input type="password" name="password" placeholder="Пароль"><br>
    <input name="email" placeholder="Email"><br>
    <input name="name" placeholder="Ім’я"><br>
    <button>Зареєструватися</button>
</form>
<?php } ?>
