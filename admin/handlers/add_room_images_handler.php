<?php
$mysqli = new mysqli("localhost", "root", "", "hotelDb");

// Проверка соединения
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Получение данных из формы
$hotelId = $_POST['hotelId'];
$title = $_POST['title'];
$imagePath = $_POST['imagePath'];

// Подготовка SQL-запроса для вставки данных
$sql = "INSERT INTO hotelImagePath (hotelId, title, imagePath) VALUES (?, ?, ?)";

// Подготовка выражения SQL
$stmt = $mysqli->prepare($sql);

// Привязка параметров к выражению SQL
$stmt->bind_param("iss", $hotelId, $title, $imagePath);

// Выполнение запроса
if ($stmt->execute()) {
    echo "Изображение успешно добавлено"; // Возвращаем сообщение об успехе
} else {
    echo "Ошибка при добавлении изображения: " . $mysqli->error; // Возвращаем сообщение об ошибке
}

// Закрытие соединения с базой данных
$stmt->close();
$mysqli->close();
?>
