<?php
header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"), true);
require_once "db.php";

$id = intval($data['id']);
$conn->query("DELETE FROM users WHERE id=$id");

echo json_encode(["message" => "Користувача видалено."]);
?>