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

// Обработка запроса на удаление заказа
if(isset($_POST['delete'])) {
    $id_to_delete = $_POST['delete_id'];
    $sql_delete = "DELETE FROM traffic_payments WHERE id = $id_to_delete";
    if ($conn->query($sql_delete) === TRUE) {
        echo "Запись успешно удалена";
    } else {
        echo "Ошибка при удалении записи: " . $conn->error;
    }
}

// Обработка запроса на изменение статуса оплаты
if(isset($_POST['update_payment'])) {
    $id_to_update = isset($_POST['update_id']) ? $_POST['update_id'] : ''; // Проверка наличия значения
    $new_payment_status = isset($_POST['new_payment_status']) ? $_POST['new_payment_status'] : ''; // Проверка наличия значения
    
    // Проверяем корректность значений
    if (empty($id_to_update) || !is_numeric($id_to_update)) {
        echo "Ошибка: неверный ID для обновления статуса оплаты";
        exit();
    }

    if (empty($new_payment_status)) {
        echo "Ошибка: значение для статуса оплаты отсутствует";
        exit();
    }
    
    // Проверяем корректность значения для статуса оплаты
    if ($new_payment_status !== 'Оплачено' && $new_payment_status !== 'Не оплачено') {
        echo "Ошибка: недопустимое значение для статуса оплаты";
        exit();
    }
    
    // Выполняем запрос на обновление статуса оплаты
    $sql_update = "UPDATE traffic_payments SET payment = '$new_payment_status' WHERE id = $id_to_update";
    if ($conn->query($sql_update) === TRUE) {
        echo "Статус оплаты успешно обновлен";
    } else {
        echo "Ошибка при обновлении статуса оплаты: " . $conn->error;
    }
}

// Обработка запроса на удаление всех неоплаченных записей
if(isset($_POST['delete_all_unpaid'])) {
    $sql_delete_all_unpaid = "DELETE FROM traffic_payments WHERE payment = 'Не оплачено'";
    if ($conn->query($sql_delete_all_unpaid) === TRUE) {
        echo "Все неоплаченные записи успешно удалены";
    } else {
        echo "Ошибка при удалении неоплаченных записей: " . $conn->error;
    }
}

// Получение данных из таблицы traffic_payments
$sql_select = "SELECT * FROM traffic_payments";
$result = $conn->query($sql_select);

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Таблица заказов</title>
</head>
<body>

<h2>Таблица заказов</h2>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Имя пользователя</th>
        <th>Дата</th>
        <th>Сумма</th>
        <th>Оплата</th>
        <th>Действия</th>
    </tr>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['customer_name'] . "</td>";
            echo "<td>" . $row['date'] . "</td>";
            echo "<td>" . $row['amount'] . "</td>";
            echo "<td>" . $row['payment'] . "</td>";
            echo "<td>
                <form method='post' action=''>
                    <input type='hidden' name='delete_id' value='" . $row['ID'] . "'>
                    <button type='submit' name='delete'>Удалить</button>
                </form>
                <form method='post' action=''>
                    <input type='hidden' name='update_id' value='" . $row['id'] . "'>
                    <select name='new_payment_status'>
                        <option value='Оплачено'>Оплачено</option>
                        <option value='Не оплачено'>Не оплачено</option>
                    </select>
                    <button type='submit' name='update_payment'>Изменить статус оплаты</button>
                </form>
            </td>";
            echo "</tr>";
        }
    } else {
        echo "0 результатов";
    }
    ?>

</table>

<form method="post" action="">
    <button type="submit" name="delete_all_unpaid">Удалить все неоплаченные</button>
</form>

</body>
</html>

<?php
// Закрываем соединение с базой данных
$conn->close();
?>
