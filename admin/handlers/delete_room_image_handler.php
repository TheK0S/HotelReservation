<?php
// Подключение к базе данных
$mysqli = new mysqli("localhost", "root", "", "hotelDb");

// Проверка соединения
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Получение ID изображения для удаления
if(isset($_GET['id'])){
    $imageId = $_GET['id'];
} else {
    echo "Не передан id изображения $imageId";
    exit();
}

// Подготовка SQL-запроса для удаления изображения
$sql = "DELETE FROM hotelImagePath WHERE id=$imageId";

// Выполнение SQL-запроса
if ($mysqli->query($sql) === TRUE) {
    echo "Изображение успешно удалено";
} else {
    echo "Ошибка удаления изображения: " . $mysqli->error;
}

// Закрытие соединения с базой данных
$mysqli->close();
?>
