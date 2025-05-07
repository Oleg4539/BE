<?php
$pdo = new PDO("mysql:host=localhost;dbname=traffic_db", "root", "");

$since = date('Y-m-d H:i:s', strtotime('-1 day'));

$total = $pdo->query("SELECT COUNT(*) FROM requests WHERE request_time >= '$since'")->fetchColumn();

$errors404 = $pdo->query("SELECT COUNT(*) FROM requests WHERE http_status = 404 AND request_time >= '$since'")->fetchColumn();

// %
$percent = $total > 0 ? ($errors404 / $total) * 100 : 0;

echo "<h1>Статистика за останню добу</h1>";
echo "<p>Загальна кількість запитів: $total</p>";
echo "<p>404 помилок: $errors404</p>";
echo "<p>Відсоток 404: " . round($percent, 2) . "%</p>";

if ($percent > 10) {
    echo "<p style='color:red;'> Увага: більше 10% запитів — 404.</p>";
}
?>