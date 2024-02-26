<?php
// Подключение к базе данных
$mysqli = new mysqli("localhost", "root", "", "hotelDb");

// Проверка соединения
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Получение данных из формы
$hotelId = $_POST['hotelId'];
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

// Запрос на обновление данных отеля
$sql = "UPDATE hotels SET 
        name='$name', 
        address='$address', 
        grade=$grade, 
        phoneNumber='$phoneNumber', 
        roomsCount=$roomsCount, 
        beachLine=$beachLine, 
        birthdate='$birthdate', 
        reconstructionDate='$reconstructionDate', 
        imagePath='$imagePath', 
        title='$title', 
        text='$text' 
        WHERE id=$hotelId";

if ($mysqli->query($sql) === TRUE) {
    echo "Данные об отеле успешно обновлены";
} else {
    echo "Ошибка при обновлении данных об отеле: " . $mysqli->error;
}

// Закрытие соединения с базой данных
$mysqli->close();
?>
