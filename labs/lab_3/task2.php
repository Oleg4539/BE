<?php
session_start();
$login = $_POST['login'] ?? '';
$password = $_POST['password'] ?? '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($login === 'Admin' && $password === 'password') {
        $_SESSION['logged_in'] = true;
        echo "Добрий день, Admin!";
    } else {
        echo "Невірний логін або пароль.";
    }
} elseif (!empty($_SESSION['logged_in'])) {
    echo "Добрий день, Admin!";
} else {
?>
<form method="post">
    Логін: <input type="text" name="login"><br>
    Пароль: <input type="password" name="password"><br>
    <input type="submit" value="Увійти">
</form>
<?php } ?>