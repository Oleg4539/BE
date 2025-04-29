<?php
if (isset($_GET['size'])) {
    setcookie("fontsize", $_GET['size'], time() + 3600, "/");//встановлено на всьому сайті
    header("Location: task1.php");
}
$fontsize = $_COOKIE['fontsize'] ?? 'medium';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Font Size</title>
</head>
<body style="font-size: <?= htmlspecialchars($fontsize) ?>;">
    <a href="?size=large">Великий шрифт</a> |
    <a href="?size=medium">Середній шрифт</a> |
    <a href="?size=small">Маленький шрифт</a>
    <p>Цей текст змінює розмір шрифту.</p>
</body>
</html>