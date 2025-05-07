<?php
header("Content-Type: application/json");
require_once "db.php";

$result = $conn->query("SELECT id, name, email FROM users");
$users = [];

while($row = $result->fetch_assoc()) {
    $users[] = $row;
}

echo json_encode($users);
?>