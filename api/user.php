<?php
header("Access-Control-Allow-Origin: *");

$url = isset($_GET['url']) ? $_GET['url'] : '';

switch ($url) {
    case 'user':
        echo 'Это эндпоинт для работы с пользователями';
        break;
    case 'post':
        echo 'Это эндпоинт для работы с постами';
        break;
    default:
        echo 'Неизвестный эндпоинт';
        break;
}
?>
