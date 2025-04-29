<?php
class FileManager {
    public static $dir = 'text';
    public static function readFile($filename) {
        $path = self::$dir . '/' . $filename;
        if (file_exists($path)) {
            return file_get_contents($path);
        } else {
            return "Файл не знайдено.\n";
        }
    }
    public static function writeFile($filename, $content) {
        $path = self::$dir . '/' . $filename;
        file_put_contents($path, $content, FILE_APPEND);
    }
    public static function clearFile($filename) {
        $path = self::$dir . '/' . $filename;
        file_put_contents($path, '');
    }
}
