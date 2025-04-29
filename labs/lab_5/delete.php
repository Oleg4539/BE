<?php
session_start();
try {
    $pdo = new PDO('mysql:host=localhost;dbname=lab_5;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Помилка підключення: ' . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Отримуємо ID товару для видалення
    $id = $_POST['id'];

    // Видаляємо товар з таблиці
    $stmt = $pdo->prepare("DELETE FROM tov WHERE id = ?");
    $stmt->execute([$id]);

    // Перенаправлення назад на головну сторінку
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Видалити товар</title>
</head>
<body>

<h2>Видалити товар</h2>
<form method="POST">
    <input type="number" name="id" placeholder="ID товару для видалення" required><br>
    <button type="submit">Видалити</button>
</form>

</body>
</html>
