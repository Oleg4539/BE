<form method="post">
    Логін: <input type="text" name="login"><br>
    Пароль: <input type="password" name="password"><br>
    <input type="submit" value="Видалити папку">
</form>
<?php
function deleteDir($dir) {
    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') continue;
        $path = "$dir/$item";
        is_dir($path) ? deleteDir($path) : unlink($path);
    }
    return rmdir($dir);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    if (file_exists($login)) {
        deleteDir($login);
        echo "Папка $login видалена.";
    } else {
        echo "Папка не знайдена.";
    }
}
?>