<?php
class Response {
    public function setStatus($code) { //встановлюєм статус
        http_response_code($code);
    }

    public function addHeader($header) { //заголовки до відповіді
        header($header);
    }

    public function send($content) { //очищення буфера
        ob_clean();
        echo $content;
    }
}

$response = new Response();
$response->setStatus(200);
$response->addHeader("Content-Type: text/html");
$response->send("<h1>Вітаємо!</h1><p>відповідь.</p>");
?>