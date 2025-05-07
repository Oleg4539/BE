<?php
ob_start();

http_response_code(200);
echo "<h1>Це моя сторінка</h1>";

$content = ob_get_contents(); //вміст сторінки з буфера

//в кеш, якщо статус 200
if (http_response_code() == 200) {
    file_put_contents('cache.html', $content);
} elseif (http_response_code() == 404) {
    // якщо статус 404, видаляємо
    if (file_exists('cache.html')) {
        unlink('cache.html');
    }
}

//вміст із кешу
if (file_exists('cache.html')) {
    echo file_get_contents('cache.html');
} else {
    echo $content;
}

ob_end_flush();
?>