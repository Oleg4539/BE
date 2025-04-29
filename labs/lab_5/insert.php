<?php
session_start();
try {
    $pdo = new PDO('mysql:host=localhost;dbname=lab_5;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Помилка підключення: ' . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Отримуємо дані з форми
    $name = $_POST['name'];
    $cost = $_POST['cost'];
    $kol = $_POST['kol'];
    $date = $_POST['date'];

    // Вставляємо новий запис
    $stmt = $pdo->prepare("INSERT INTO tov (name, cost, kol, date) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $cost, $kol, $date]);

    // Перенаправлення назад на головну сторінку
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Додати товар</title>
</head>
<body>

<h2>Додати товар</h2>
<form method="POST">
    <input type="text" name="name" placeholder="Назва товару" required><br>
    <input type="number" name="cost" placeholder="Ціна" required><br>
    <input type="number" name="kol" placeholder="Кількість" required><br>
    <input type="date" name="date" required><br>
    <button type="submit">Додати</button>
</form>

</body>
</html>
