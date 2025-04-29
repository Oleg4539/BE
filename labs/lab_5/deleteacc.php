<?php
session_start();
require 'db.php';
$id = $_SESSION['user']['id'];

$stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
$stmt->execute([$id]);

session_destroy();
header("Location: index.php");
