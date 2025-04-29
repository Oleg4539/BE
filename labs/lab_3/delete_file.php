<form method="post">
    Введіть ім’я файлу для видалення: <input type="text" name="filename">
    <input type="submit" value="Видалити">
</form>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $file = $_POST['filename'];
    if (file_exists($file)) {
        unlink($file);
        echo "Файл $file видалено.";
    } else {
        echo "Файл $file не знайдено.";
    }
}
?>