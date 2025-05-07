<?php
header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"), true);
require_once "db.php";

$user_id = intval($data['user_id']);
$title = $conn->real_escape_string($data['title']);
$content = $conn->real_escape_string($data['content']);

$conn->query("INSERT INTO notes (user_id, title, content) VALUES ($user_id, '$title', '$content')");

echo json_encode(["message" => "Нотатку створено."]);
?>