<?php
// Подключение к базе данных
$mysqli = new mysqli("localhost", "root", "", "hotelDb");

// Проверка соединения
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Получение данных из формы
$user_id = $_POST['userId'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$patronomic = $_POST['patronomic'];
$phoneNumber = $_POST['phoneNumber'];
$birthdate = $_POST['birthdate'];

// Подготовка SQL запроса для обновления данных пользователя
$sql = "UPDATE users SET 
        firstName='$firstName', 
        lastName='$lastName', 
        patronomic='$patronomic', 
        phoneNumber='$phoneNumber', 
        birthdate='$birthdate'
        WHERE id=$user_id";

// Выполнение запроса
if ($mysqli->query($sql) === TRUE) {
    echo "Данные пользователя успешно обновлены";
} else {
    echo "Ошибка при обновлении данных пользователя: " . $mysqli->error;
}

// Закрытие соединения с базой данных
$mysqli->close();
?>
