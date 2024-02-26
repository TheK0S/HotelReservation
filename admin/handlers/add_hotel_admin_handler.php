<?php
// Подключение к базе данных
$mysqli = new mysqli("localhost", "root", "", "hotelDb");

// Проверка соединения
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Получение данных из формы
$name = $_POST['name'];
$address = $_POST['address'];
$grade = $_POST['grade'];
$phoneNumber = $_POST['phoneNumber'];
$roomsCount = $_POST['roomsCount'];
$beachLine = $_POST['beachLine'];
$birthdate = $_POST['birthdate'];
$reconstructionDate = $_POST['reconstructionDate'];
$imagePath = $_POST['imagePath'];
$title = $_POST['title'];
$text = $_POST['text'];

// Подготовка SQL запроса для добавления отеля
$sql = "INSERT INTO hotels (name, address, grade, phoneNumber, roomsCount, beachLine, birthdate, reconstructionDate, imagePath, title, text) 
        VALUES ('$name', '$address', $grade, '$phoneNumber', $roomsCount, $beachLine, '$birthdate', '$reconstructionDate', '$imagePath', '$title', '$text')";

// Выполнение SQL запроса
if ($mysqli->query($sql) === TRUE) {
    echo "Отель успешно добавлен";
} else {
    echo "Ошибка при добавлении отеля: " . $mysqli->error;
}

// Закрытие соединения с базой данных
$mysqli->close();
?>
