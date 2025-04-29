<?php
$file = "file1.txt";
if (file_exists($file)) {
    $words = preg_split('/\s+/', file_get_contents($file));
    sort($words, SORT_STRING | SORT_FLAG_CASE);
    echo implode("<br>", $words);
} else {
    echo "Файл не знайдено.";
}
?>