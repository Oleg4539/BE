<?php
header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"), true);
require_once "db.php";

$email = $conn->real_escape_string($data['email']);
$password = $data['password'];

$result = $conn->query("SELECT * FROM users WHERE email='$email'");
$user = $result->fetch_assoc();

if ($user && password_verify($password, $user['password'])) {
    echo json_encode(["message" => "Вхід успішний!", "user" => [
        "id" => $user["id"],
        "name" => $user["name"],
        "email" => $user["email"]
    ]]);
} else {
    echo json_encode(["message" => "Невірний email або пароль."]);
}
?>