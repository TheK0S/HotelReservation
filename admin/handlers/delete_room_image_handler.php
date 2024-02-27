<?php
// Подключение к базе данных
$mysqli = new mysqli("localhost", "root", "", "hotelDb");

// Проверка соединения
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Проверяем, был ли получен запрос типа DELETE
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Получаем ID изображения для удаления из параметров запроса
    $imageId = $_GET['id'];

    // Подготовка SQL-запроса для удаления изображения
    $sql = "DELETE FROM hotelImagePath WHERE id = $imageId";

    // Выполнение запроса
    if ($mysqli->query($sql) === TRUE) {
        // Возвращаем успешный ответ с кодом 200
        http_response_code(200);
        echo json_encode(array("message" => "Изображение успешно удалено"));
    } else {
        // Возвращаем ошибку с кодом 500
        http_response_code(500);
        echo json_encode(array("error" => "Ошибка удаления изображения: " . $mysqli->error));
    }
} else {
    // Возвращаем ошибку, если запрос не типа DELETE
    http_response_code(405);
    echo json_encode(array("error" => "Метод не разрешен"));
}

// Закрытие соединения с базой данных
$mysqli->close();
?>
