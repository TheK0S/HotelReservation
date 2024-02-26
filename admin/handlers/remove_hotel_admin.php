<?php
// Подключение к базе данных
$mysqli = new mysqli("localhost", "root", "", "hotelDb");

// Проверка соединения с базой данных
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Проверяем, был ли передан ID отеля для удаления
if(isset($_GET['hotel_id'])) {
    // Получаем ID отеля из строки запроса
    $hotelId = $_GET['hotel_id'];

    // Подготовка SQL запроса на удаление отеля
    $sql = "DELETE FROM hotels WHERE id = $hotelId";

    // Выполняем SQL запрос
    if ($mysqli->query($sql) === TRUE) {
        echo "Отель успешно удален";
    } else {
        echo "Ошибка при удалении отеля: " . $mysqli->error;
    }
} else {
    echo "ID отеля не был передан для удаления";
}

// Закрываем соединение с базой данных
$mysqli->close();
?>
