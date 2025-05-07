<?php
ob_start();
$startTime = microtime(true);

$pdo = new PDO("mysql:host=localhost;dbname=traffic_db", "root", "");

// Отримуємо дані
$ip = $_SERVER['REMOTE_ADDR'];
$time = date('Y-m-d H:i:s');
$url = $_SERVER['REQUEST_URI'];

register_shutdown_function(function() use ($pdo, $ip, $time, $url) {
    $status = http_response_code(); //HTTP статус

    $stmt = $pdo->prepare("INSERT INTO requests (ip_address, request_time, url, http_status) VALUES (?, ?, ?, ?)");
    $stmt->execute([$ip, $time, $url, $status]);
});
?>