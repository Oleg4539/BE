<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "lab_6";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Помилка підключення: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");
?>