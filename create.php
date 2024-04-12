<HTML>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Создание таблицы</title>
<BODY> <br> Кафедра Бизнес-информатика<br> <br> <hr>
<b>Научно-исследовательская работа</b><br>
<?php
$key1 =0;
echo "<b> Создание базы данных на сервере MySQL </b> "."<br>"."<hr>";
$sdb_name = "localhost";
$user_name="root";
$user_pass = "";
$db_name = "restaurant_db";
// Соединение с сервером
$link=mysql_connect($sdb_name,$user_name,$user_pass);
echo "Report MySQL-server"."<br>";
if (!$link)
{ echo "Нет соединения с MySQL-server <br>";
exit();}
echo "Есть соединение с MySQL-server <br> <hr>";
// Создание базы данных
$str_sql_query = "CREATE DATABASE $db_name";
echo " Message: ".$str_sql_query;
if (!mysql_query($str_sql_query, $link))
{ echo " <br> Не создали новую базу (уже существует) <br>";}
// Выбор базы данных
if (!mysql_select_db($db_name,$link))
{echo " Не выбрали базу данных - не нашли."."<br>";
exit();}
echo "<br> Выбрали и открыли базу данных <br>";
// Создание таблицы
mysql_query("CREATE TABLE menu_items(nom TEXT(20), fam TEXT(50))") or die ("
<br> Ошибка создания таблицы <br> ".mysql_error());
mysql_close($link);
?>
</BODY>
</HTML>