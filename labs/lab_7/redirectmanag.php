<?php
ob_start();

$filename = 'redirects.json';

//перевірка існування конфігураційного файлу
if (!file_exists($filename)) {
    http_response_code(500);
    echo "<h1>Помилка сервера</h1><p>Файл перенаправлень не знайдено.</p>";
    exit;
}

$redirects = json_decode(file_get_contents($filename), true);

if (!is_array($redirects)) {
    http_response_code(500);
    echo "<h1>Помилка сервера</h1><p>Невірний формат redirects.json.</p>";
    exit;
}

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$scriptName = dirname($_SERVER['SCRIPT_NAME']);
$relativeUri = '/' . ltrim(str_replace($scriptName, '', $requestUri), '/');

//перевірка відповідності
if (array_key_exists($relativeUri, $redirects)) {
    $target = $redirects[$relativeUri];

    if ($target === "/404") {
        http_response_code(404);
        echo "<h1>Сторінка не знайдена</h1><p>Ця сторінка більше не існує.</p>";
    } else {
        header("Location: $target", true, 301);
        exit;
    }
} else {
    echo "<h1>Ласкаво просимо</h1><p>Це сторінка без перенаправлень.</p>";
}
//http://localhost/labs/lab_7/redirectmanag.php/deprecated