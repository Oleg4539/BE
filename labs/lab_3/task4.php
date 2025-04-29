<form method="post" enctype="multipart/form-data">
    Виберіть зображення для завантаження:
    <input type="file" name="image">
    <input type="submit" value="Завантажити">
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $targetDir = "uploads/";
    if (!file_exists($targetDir)) mkdir($targetDir);
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        echo "Файл завантажено: " . htmlspecialchars(basename($_FILES["image"]["name"]));
    } else {
        echo "Помилка при завантаженні.";
    }
}
?>