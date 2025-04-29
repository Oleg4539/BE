<?php
$filename = "comments.txt";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $comment = htmlspecialchars($_POST['comment']);
    $entry = $name . "||" . $comment . PHP_EOL;
    file_put_contents($filename, $entry, FILE_APPEND);
}

$comments = file_exists($filename) ? file($filename, FILE_IGNORE_NEW_LINES) : [];
?>
<form method="post">
    Ім’я: <input type="text" name="name"><br>
    Коментар: <textarea name="comment"></textarea><br>
    <input type="submit" value="Надіслати">
</form>
<table border="1">
    <tr><th>Ім’я</th><th>Коментар</th></tr>
    <?php foreach ($comments as $line): list($n, $c) = explode("||", $line); ?>
    <tr><td><?= $n ?></td><td><?= $c ?></td></tr>
    <?php endforeach; ?>
</table>