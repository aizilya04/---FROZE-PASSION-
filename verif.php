<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Поиск товара</title>
</head>
<body>
    <h1>Поиск товара</h1>
    <?php
    if (!isset($_POST['Submit'])) {
        // Форма для ввода данных о товаре
        echo "<form name=\"FORM1\" action=\"verif.php\" method=\"POST\">";
        echo "<label for=\"name\">Название:</label>";
        echo "<input type=\"text\" name=\"name\" id=\"name\" required><br>";
        echo "<input type=\"submit\" name=\"Submit\" value=\"Поиск\">";
        echo "</form>";
    } else {
        // Получение данных из формы
        $name = $_POST['name'];

        // Подключение к базе данных
        include "baz_ini.php";

        // Преобразование введенного названия для использования в запросе
        $search_term = '%' . $name . '%';

        // Выполнение запроса к базе данных
        $query = "SELECT * FROM menu_items WHERE name LIKE ?";
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, "s", $search_term);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result) {
            // Проверяем количество результатов
            $rows = mysqli_num_rows($result);
            if ($rows > 0) {
                echo "Результаты поиска:<br>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "ID: " . $row['id'] . "<br>";
                    echo "Название: " . $row['name'] . "<br>";
                    echo "Описание: " . $row['description'] . "<br>";
                    echo "Цена: " . $row['price'] . "<br>";
                    echo "Категория: " . $row['category'] . "<br>";
                    echo "<hr>";
                }
            } else {
                echo "Товары не найдены<br>";
            }
        } else {
            echo "Ошибка выполнения запроса: " . mysqli_error($link);
        }

        // Закрываем соединение с базой данных
        mysqli_close($link);
    }
    ?>
</body>
</html>


