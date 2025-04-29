<?php
$file1 = "file1.txt";
$file2 = "file2.txt";

if (!file_exists($file1) || !file_exists($file2)) {
    exit("Один або обидва файли відсутні.");
}

$f1 = file($file1, FILE_IGNORE_NEW_LINES);
$f2 = file($file2, FILE_IGNORE_NEW_LINES);

$unique1 = array_diff($f1, $f2);
$common = array_intersect($f1, $f2);
$allWords = array_merge($f1, $f2);
$counts = array_count_values($allWords);
$moreThanTwice = array_keys(array_filter($counts, fn($count) => $count > 2));

file_put_contents("only_in_file1.txt", implode("\n", $unique1));
file_put_contents("common.txt", implode("\n", $common));
file_put_contents("more_than_twice.txt", implode("\n", $moreThanTwice));

echo "Файли створено.";
?>