    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавление новых данных в menu_items</title>
<?php
// Подключение к базе данных
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "restaurant_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получение последнего ID
function getLastId($conn) {
    $sql = "SELECT MAX(id) AS max_id FROM menu_items";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['max_id'];
    } else {
        return 0;
    }
}

// Обработка запроса на добавление данных
if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    // Получаем последний ID и увеличиваем его на 1
    $last_id = getLastId($conn);
    $new_id = $last_id + 1;

    // Вставка новой записи с новым ID
    $sql = "INSERT INTO menu_items (id, name, description, price, category) VALUES ($new_id, '$name', '$description', '$price', '$category')";

    if ($conn->query($sql) === TRUE) {
        echo "Новая запись успешно добавлена";
    } else {
        echo "Ошибка при добавлении новой записи: " . $conn->error;
    }
}

// Обработка запроса на удаление выбранных записей
if(isset($_POST['delete'])) {
    if(!empty($_POST['selected_items'])) {
        foreach($_POST['selected_items'] as $selected) {
            $sql = "DELETE FROM menu_items WHERE id = $selected";
            if ($conn->query($sql) !== TRUE) {
                echo "Ошибка при удалении записи с ID $selected: " . $conn->error;
            }
        }
        echo "Выбранные записи успешно удалены";
    } else {
        echo "Не выбраны записи для удаления";
    }
}

// Форма для добавления новой записи
?>
<form method="post" action="">
    <label for="name">Название:</label><br>
    <input type="text" id="name" name="name"><br>
    <label for="description">Описание:</label><br>
    <textarea id="description" name="description"></textarea><br>
    <label for="price">Цена:</label><br>
    <input type="text" id="price" name="price"><br>
    <label for="category">Категория:</label><br>
    <input type="text" id="category" name="category"><br>
    <input type="submit" name="submit" value="Добавить запись">
</form>
<?php

// Код для выполнения запроса на получение всех записей из таблицы menu_items
$query = "SELECT * FROM menu_items";
$result = mysqli_query($conn, $query);

// Проверяем успешность выполнения запроса
if ($result) {
    // Форма для выбора и удаления записей
    echo "<form method='post' action=''>";

    // Отображаем таблицу с данными
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Name</th><th>Description</th><th>Price</th><th>Category</th><th>Выбрать</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['description'] . "</td>";
        echo "<td>" . $row['price'] . "</td>";
        echo "<td>" . $row['category'] . "</td>";
        echo "<td><input type='checkbox' name='selected_items[]' value='" . $row['id'] . "'></td>";
        echo "</tr>";
    }
    echo "</table>";

    // Кнопка для удаления выбранных записей
    echo "<input type='submit' name='delete' value='Удалить выбранные записи'>";

    echo "</form>";
} else {
    echo "Ошибка при получении данных из базы данных: " . mysqli_error($conn);
}

// Закрываем соединение с базой данных
mysqli_close($conn);
?>

