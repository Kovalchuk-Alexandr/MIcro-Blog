<?php
//DB SETTINGS
define("DB_HOST","database");
define("DB_NAME","microblog");
define("DB_USER","root");
define("DB_PASS","tiger");

//SITE SETTINGS
// Корневой каталог
define('ROOT', dirname(__FILE__) . '/');
// Глобальный массив $_SERVER[], 'HTTP_HOST' - имя текущуго хоста (localhost:443)
define('HOST', 'http://' . $_SERVER['HTTP_HOST']);


// Максимальный размер файла для загрузки
define('MAX_UPLOAD_FILE_SIZE',10 * 1024 * 1024);    // 10 Mb

// echo ROOT;  // /var/www/html/
// echo "<br>";
// echo HOST;  // http://localhost:443/
// echo "<br>";

// Поддерживаемые типы изображений
$allowed_file_types = [
    'image/jpeg',
    'image/png',
    'image/gif',
    'image/webp',
    'image/avif'
];

// Поддерживаемые расширения изображений
$allowed_extensions = [
    'jpeg',
    'jpg',
    'png',
    'gif',
    'webp',
    'avif'
];

// Поддерживаемые типы изображений для кропа
$allowed_resize_file_types = [
    'image/jpeg',
    'image/png',
    'image/gif',
];

// Старт сессии, чтобы можно было работать с $_SESSION
session_start();
?>