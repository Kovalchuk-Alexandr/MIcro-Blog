<?php
// Старт сессии
session_start();

// Очистка всех данных из сессии
$_SESSION = [];

// Удалить сессионные куки
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        "",
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"],
    );
}

// Уничтожение сессии
session_destroy();

// Перенаправление на главную и выход
header('Location: ./index.php');
exit;
