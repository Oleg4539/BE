<?php
header("Content-Type: application/json");
require_once "db.php";

$user_id = intval($_GET['user_id']);

$result = $conn->query("SELECT * FROM notes WHERE user_id = $user_id ORDER BY created_at DESC");
$notes = [];

while ($row = $result->fetch_assoc()) {
    $notes[] = $row;
}

echo json_encode($notes);
?>