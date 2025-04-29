<?php
session_start();
try {
    $pdo = new PDO('mysql:host=localhost;dbname=lab_5;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Помилка підключення: ' . $e->getMessage());
}

// запит для вибірки всіх товарів з таблиці tov
$sql = "SELECT * FROM tov";
$result = $pdo->query($sql);
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Головна</title>
</head>
<body>

<?php if (isset($_SESSION['user'])): ?>
    <h2>Привіт, <?= $_SESSION['user']['name'] ?>!</h2>
    <a href="update.php">Змінити дані</a> |
    <a href="deleteacc.php">Видалити профіль</a> |
    <a href="logout.php">Вийти</a>

    <h2>Список товарів</h2>

    <a href="insert.php">Додати товар</a><br>
    <a href="delete.php">Видалити товар</a><br><br>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Назва</th>
            <th>Ціна</th>
            <th>Кількість</th>
            <th>Дата</th>
        </tr>
        <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['cost'] ?></td>
                <td><?= $row['kol'] ?></td>
                <td><?= $row['date'] ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

<?php else: ?>
    <form method="POST" action="login.php">
        <input type="text" name="login" placeholder="Логін"><br>
        <input type="password" name="password" placeholder="Пароль"><br>
        <button type="submit">Увійти</button>
    </form>
    <a href="register.php">Реєстрація</a>
<?php endif; ?>

</body>
</html>
