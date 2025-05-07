<?php
// rgf дозволяє зареєструвати функцію, яка буде виконана після завершення скрипта.
register_shutdown_function(function() {
    $error = error_get_last();
    if ($error && $error['type'] == E_ERROR) {
        ob_clean();
        http_response_code(500); //statu
        echo "<h1>Щось пішло не так. Ми працюємо над вирішенням проблеми. Спробуйте пізніше.</h1>";
        exit;
    }
});

nonExistentFunction();//помилка
?>