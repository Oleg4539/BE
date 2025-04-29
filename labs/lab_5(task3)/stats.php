<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=company_db;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Помилка підключення: " . $e->getMessage());
}

$avgStmt = $pdo->query("SELECT AVG(salary) AS avg_salary FROM employees");
$avgSalary = $avgStmt->fetch(PDO::FETCH_ASSOC)['avg_salary'];

$posStmt = $pdo->query("SELECT position, COUNT(*) AS count FROM employees GROUP BY position");
$positions = $posStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Статистика працівників</title>
</head>
<body>
    <h2>Статистика</h2>

    <p><strong>Середня заробітна плата:</strong> <?= number_format($avgSalary, 2) ?> грн</p>

    <h3>Кількість працівників за посадами:</h3>
    <table border="1">
        <tr>
            <th>Посада</th>
            <th>Кількість</th>
        </tr>
        <?php foreach ($positions as $pos): ?>
            <tr>
                <td><?= htmlspecialchars($pos['position']) ?></td>
                <td><?= $pos['count'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <br>
    <a href="employees.php">← Назад до працівників</a>
</body>
</html>
