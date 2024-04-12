<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавление записей (фоновый режим)</title>
</head>
<body>
<?php
echo "<b> Работа с данными на сервере MySQL </b> <br>";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "restaurant_db";

// Создание подключения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Подключение к серверу MySQL - успешно<br>";

// Выборка данных из таблицы
$sql_select = "SELECT * FROM menu_items";
$result = $conn->query($sql_select);

// Вывод таблицы существующих записей
if ($result->num_rows > 0) {
    echo "<h2>Таблица существующих записей</h2>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Name</th><th>Description</th><th>Price</th><th>Category</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['description'] . "</td>";
        echo "<td>" . $row['price'] . "</td>";
        echo "<td>" . $row['category'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 результатов";
}

// Данные для добавления записи
$newname = 'Суп Сливочный с лососем';
$newdescription = 'Изысканное блюдо, объединяющее нежность кремовой текстуры сливок с изысканным вкусом свежего лосося.';
$newprice = '700';
$newcategory = 'Супы';

// Запрос на добавление записи
$sql_insert = "INSERT INTO menu_items (name, description, price, category) VALUES ('$newname', '$newdescription', '$newprice', '$newcategory')";

if ($conn->query($sql_insert) === TRUE) {
    echo "Новая запись успешно добавлена<br>";
} else {
    echo "Ошибка при добавлении новой записи: " . $conn->error . "<br>";
}

// Закрытие подключения
$conn->close();
?>
</body>
</html>



