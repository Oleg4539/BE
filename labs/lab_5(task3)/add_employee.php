<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=company_db;charset=utf8", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $name = $_POST['name'];
        $position = $_POST['position'];
        $salary = $_POST['salary'];

        $sql = "INSERT INTO employees (name, position, salary) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $position, $salary]);

        header("Location: employees.php");
        exit;
    } catch (PDOException $e) {
        die("Помилка: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="uk">
<head><meta charset="UTF-8"><title>Додати працівника</title></head>
<body>
<h2>Додати працівника</h2>
<form method="POST">
    <label>Ім’я: <input type="text" name="name" required></label><br><br>
    <label>Посада: <input type="text" name="position" required></label><br><br>
    <label>Зарплата: <input type="number" step="0.01" name="salary" required></label><br><br>
    <button type="submit">Додати</button>
</form>
<a href="employees.php">Назад до списку</a>
</body>
</html>
