<?php
header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"), true);
require_once "db.php";

$id = intval($data['id']);
$name = $conn->real_escape_string($data['name']);
$email = $conn->real_escape_string($data['email']);

$conn->query("UPDATE users SET name='$name', email='$email' WHERE id=$id");

echo json_encode(["message" => "Користувача оновлено."]);
?>