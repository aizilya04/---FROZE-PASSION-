<?php
$sdb_host = "localhost";
$user_name = "root";
$user_pass = ""; // Пароль к базе данных, если есть
$db_name = "restaurant_db"; // Имя вашей базы данных

$link = mysqli_connect($sdb_host, $user_name, $user_pass, $db_name);

// Проверяем соединение
if (!$link) {
    die("Ошибка соединения: " . mysqli_connect_error());
}
?>
