<?php
session_start();
try {
    $pdo = new PDO('mysql:host=localhost;dbname=lab_5;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Помилка підключення: ' . $e->getMessage());
}

$login = $_POST['login'] ?? '';
$password = $_POST['password'] ?? '';

if ($login && $password) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE login = ?");
    $stmt->execute([$login]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Успішна автентифікація
        $_SESSION['user'] = $user;
        header('Location: index.php');
        exit;
    } else {
        echo "Невірний логін або пароль.";
    }
} else {
    echo "Введіть логін і пароль.";
}
?>
