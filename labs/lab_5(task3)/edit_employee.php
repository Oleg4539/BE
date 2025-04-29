<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=company_db;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Помилка підключення: " . $e->getMessage());
}

$id = $_GET['id'] ?? null;

if (!$id) {
    die("ID не вказано!");
}

// Отримуємо дані працівника
$stmt = $pdo->prepare("SELECT * FROM employees WHERE id = ?");
$stmt->execute([$id]);
$employee = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$employee) {
    die("Працівник не знайдений!");
}

// Якщо була відправлена форма
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $position = $_POST['position'];
    $salary = $_POST['salary'];

    if ($name && $position && $salary) {
        $stmt = $pdo->prepare("UPDATE employees SET name = ?, position = ?, salary = ? WHERE id = ?");
        $stmt->execute([$name, $position, $salary, $id]);
        header("Location: employees.php");
        exit;
    } else {
        echo "Усі поля обов’язкові!";
    }
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Редагування працівника</title>
</head>
<body>
    <h2>Редагувати працівника #<?= $employee['id'] ?></h2>
    <form method="POST">
        <input type="text" name="name" value="<?= htmlspecialchars($employee['name']) ?>" placeholder="Ім’я"><br>
        <input type="text" name="position" value="<?= htmlspecialchars($employee['position']) ?>" placeholder="Посада"><br>
        <input type="number" step="0.01" name="salary" value="<?= $employee['salary'] ?>" placeholder="Зарплата"><br>
        <button type="submit">Зберегти зміни</button>
    </form>
    <br>
    <a href="employees.php">Назад до списку</a>
</body>
</html>
