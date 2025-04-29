<form method="post">
    Логін: <input type="text" name="login"><br>
    Пароль: <input type="password" name="password"><br>
    <input type="submit" value="Створити папку">
</form>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $dir = $login;
    if (!file_exists($dir)) {
        mkdir("$dir/video", 0777, true);
        mkdir("$dir/music", 0777, true);
        mkdir("$dir/photo", 0777, true);
        file_put_contents("$dir/video/demo.txt", "video");
        file_put_contents("$dir/music/demo.txt", "music");
        file_put_contents("$dir/photo/demo.txt", "photo");
        echo "Папка створена.";
    } else {
        echo "Папка вже існує.";
    }
}
?>