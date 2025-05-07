<?php
//IP та час запиту в лог
$ip = $_SERVER['REMOTE_ADDR'];
$timestamp = time();

$logFile = 'requests.log';

//читання логу
$requests = file_exists($logFile) ? json_decode(file_get_contents($logFile), true) : [];

//застарілі записи
foreach ($requests as $key => $request) {
    if ($timestamp - $request['time'] > 60) {
        unset($requests[$key]);
    }
}

// Перевірка
$userRequests = array_filter($requests, function($request) use ($ip) {
    return $request['ip'] == $ip;
});

//обмежуємо доступ
if (count($userRequests) >= 5) {
    http_response_code(429);
    echo "Занадто багато запитів. Спробуйте пізніше.";
    exit;
}

//поточний запит
$requests[] = ['ip' => $ip, 'time' => $timestamp];

file_put_contents($logFile, json_encode($requests));

http_response_code(200);
echo "Запит дозволено.";
?>