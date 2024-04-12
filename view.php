<HTML>
<BODY>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Таблицы</title>
 Кафедра Бизнес-информатика<br> <br>
<b> Научно-исследовательская работа <br> </b><br>
<?php
$key1 = 0;
echo "<b> Работа с данными на сервере MySQL </b> "."<br>"."<br>";
$sdb_name = "localhost";
$user_name = "root";
$user_pass = "";
$db_name = "restaurant_db";

// Соединение с сервером MySQL
$link = mysql_connect($sdb_name, $user_name, $user_pass);
echo "Отчет о сервере MySQL"."<br>"."<br>";
if (!$link) { 
    echo "Не удалось подключиться к серверу MySQL"."<br>";
    exit();
} 
echo "Подключение к серверу MySQL - Успешно"."<br>";

// Выбор базы данных restaurant_db
if (!mysql_select_db($db_name, $link)) {
    echo "Не удалось выбрать базу данных"."<br>"; 
    exit();
}
echo "База данных открыта успешно"."<br>";

// Запрос к таблице menu_items
$str_sql_query_menu = "SELECT * FROM menu_items";
if (!$result_menu = mysql_query($str_sql_query_menu, $link)) {
    echo "Не удалось выполнить запрос к таблице menu_items"."<br>"; 
    exit();
}
echo "Запрос к таблице menu_items выполнен успешно"."<br>";

// Вывод данных из таблицы menu_items
echo "<H2 ALIGN=CENTER> <b> Вывод из таблицы menu_items базы данных restaurant_db </b> </H2>";
echo "<table cols=5 border=1 WIDTH=600 CELLPADDING=5 ALIGN=CENTER>\n";
echo "<tr> <td> ID </td> <td> Название блюда </td> <td> Описание </td> <td> Цена </td> <td> Категория </td> </tr>";

// Формирование HTML-таблицы с данными из таблицы menu_items
while ($row_menu = mysql_fetch_assoc($result_menu)) {
    echo "<tr>";
    echo "<td>".$row_menu['id']."</td>";
    echo "<td>".$row_menu['name']."</td>";
    echo "<td>".$row_menu['description']."</td>";
    echo "<td>".$row_menu['price']."</td>";
    echo "<td>".$row_menu['category']."</td>";
    echo "</tr>";
}
echo "</table>";

// Запрос к таблице traffic_payments
$str_sql_query_traffic = "SELECT * FROM traffic_payments";
if (!$result_traffic = mysql_query($str_sql_query_traffic, $link)) {
    echo "Не удалось выполнить запрос к таблице traffic_payments"."<br>"; 
    exit();
}
echo "Запрос к таблице traffic_payments выполнен успешно"."<br>";

// Вывод данных из таблицы traffic_payments
echo "<H2 ALIGN=CENTER> <b> Вывод из таблицы traffic_payments базы данных restaurant_db </b> </H2>";
echo "<table cols=4 border=1 WIDTH=600 CELLPADDING=5 ALIGN=CENTER>\n";
echo "<tr> <td> ID </td> <td> Дата </td> <td> Сумма </td> <td> Оплата </td> </tr>";

// Формирование HTML-таблицы с данными из таблицы traffic_payments
while ($row_traffic = mysql_fetch_assoc($result_traffic)) {
    echo "<tr>";
    echo "<td>".$row_traffic['id']."</td>";
    echo "<td>".$row_traffic['date']."</td>";
    echo "<td>".$row_traffic['amount']."</td>";
    echo "<td>".$row_traffic['payment']."</td>";
    echo "</tr>";
}
echo "</table>";

// Закрытие соединения с сервером MySQL
mysql_close($link);
?>
</BODY>
</HTML>
