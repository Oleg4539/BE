<?php
// Підключення до бази даних
try {
    $pdo = new PDO('mysql:host=localhost;dbname=company_db;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Помилка підключення: " . $e->getMessage());
}

// Отримуємо список працівників
$stmt = $pdo->query("SELECT * FROM employees ORDER BY id ASC");
$employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Список працівників</title>
    <style>
        table { border-collapse: collapse; width: 80%; margin-top: 10px; }
        th, td { border: 1px solid #999; padding: 8px; text-align: center; }
        th { background-color: #eee; }
        a { text-decoration: none; color: blue; }
    </style>
</head>
<body>
    <h2>Список працівників</h2>

    <!-- Посилання -->
    <a href="add_employee.php">Додати працівника</a> |
    <a href="stats.php">Переглянути статистику</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Ім’я</th>
            <th>Посада</th>
            <th>Зарплата</th>
            <th>Дії</th>
        </tr>
        <?php if ($employees): ?>
            <?php foreach ($employees as $emp): ?>
                <tr>
                    <td><?= $emp['id'] ?></td>
                    <td><?= htmlspecialchars($emp['name']) ?></td>
                    <td><?= htmlspecialchars($emp['position']) ?></td>
                    <td><?= $emp['salary'] ?> грн</td>
                    <td>
                        <a href="edit_employee.php?id=<?= $emp['id'] ?>">Редагувати</a> |
                        <a href="delete_employee.php?id=<?= $emp['id'] ?>" onclick="return confirm('Ви впевнені, що хочете видалити цього працівника?')">Видалити</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="5">Працівників не знайдено.</td></tr>
        <?php endif; ?>
    </table>
</body>
</html>
