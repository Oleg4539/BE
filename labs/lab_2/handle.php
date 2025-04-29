<?php
session_start();

// Збереження даних у сесію
$_SESSION['login'] = $_POST['login'];
$_SESSION['gender'] = $_POST['gender'];
$_SESSION['city'] = $_POST['city'];
$_SESSION['games'] = isset($_POST['games']) ? $_POST['games'] : [];
$_SESSION['about'] = $_POST['about'];

// Перевірка паролю (опціонально)
$passMessage = ($_POST['password'] === $_POST['confirm_password']) ? "✓" : "не співпадає (перший - 5 символів, другий - 7 символів)";

// Завантаження фотографії
$uploadDir = 'uploads/';
$photoName = '';

if (!is_dir($uploadDir)) {
    mkdir($uploadDir);
}

if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
    $photoName = basename($_FILES['photo']['name']);
    move_uploaded_file($_FILES['photo']['tmp_name'], $uploadDir . $photoName);
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Дані користувача</title>
</head>
<body>
    <p><strong>Логін:</strong> <?= htmlspecialchars($_SESSION['login']) ?></p>
    <p><strong>Пароль:</strong> <?= $passMessage ?></p>
    <p><strong>Стать:</strong> <?= htmlspecialchars($_SESSION['gender']) ?></p>
    <p><strong>Місто:</strong> <?= htmlspecialchars($_SESSION['city']) ?></p>
    <p><strong>Улюблені ігри:</strong> <?= implode(', ', $_SESSION['games']) ?></p>
    <p><strong>Про себе:</strong><br><?= nl2br(htmlspecialchars($_SESSION['about'])) ?></p>

    <?php if ($photoName): ?>
        <p><strong>Фотографія:</strong><br>
            <img src="<?= $uploadDir . $photoName ?>" alt="Фото" width="300">
        </p>
    <?php endif; ?>

    <p><a href="index.php">Повернутися на головну сторінку</a></p>
</body>
</html>
