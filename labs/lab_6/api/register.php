<?php
header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"), true);
require_once "db.php";

$name = $conn->real_escape_string($data['name']);
$email = $conn->real_escape_string($data['email']);
$password = $data['password'];

if (strlen($password) < 6) {
    echo json_encode(["message" => "Пароль має містити мінімум 6 символів."]);
    exit();
}

$check = $conn->query("SELECT id FROM users WHERE email='$email'");
if ($check->num_rows > 0) {
    echo json_encode(["message" => "Email вже зареєстрований."]);
    exit();
}

$hash = password_hash($password, PASSWORD_DEFAULT);
$conn->query("INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hash')");

echo json_encode(["message" => "Користувач успішно зареєстрований!"]);
?>
