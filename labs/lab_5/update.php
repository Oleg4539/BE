<?php
session_start();
require 'db.php';
$user = $_SESSION['user'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $stmt = $pdo->prepare("UPDATE users SET name = ?, email = ?, updated_at = NOW() WHERE id = ?");
    $stmt->execute([$name, $email, $user['id']]);
    $_SESSION['user']['name'] = $name;
    header("Location: index.php");
} else {
?>
<form method="POST">
    <input name="name" value="<?= $user['name'] ?>"><br>
    <input name="email" value="<?= $user['email'] ?>"><br>
    <button>Оновити</button>
</form>
<?php } ?>
