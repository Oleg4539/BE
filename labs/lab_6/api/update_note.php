<?php
header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"), true);
require_once "db.php";

$id = intval($data['id']);
$title = $conn->real_escape_string($data['title']);
$content = $conn->real_escape_string($data['content']);

$conn->query("UPDATE notes SET title='$title', content='$content' WHERE id=$id");

echo json_encode(["message" => "Нотатку оновлено."]);
?>