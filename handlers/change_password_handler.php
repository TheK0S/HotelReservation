<?php
session_start();

// Проверка, авторизован ли пользователь
if (!isset($_SESSION['user_id'])) {
    header("Location: /HotelReservation/pages/login.php");
    exit();
}

$mysqli = new mysqli("localhost", "root", "", "hotelDb");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем данные из формы
    $currentPassword = $_POST["currentPassword"];
    $newPassword = $_POST["newPassword"];
    $confirmNewPassword = $_POST["confirmNewPassword"];

    // Получение информации о пользователе
    $user_id = $_SESSION['user_id'];
    $user_query = "SELECT * FROM users WHERE id = $user_id";
    $user_result = $mysqli->query($user_query);
    if ($user_result->num_rows == 1) {
        $user_row = $user_result->fetch_assoc();
    } else {
        echo "Ошибка: Пользователь не найден.";
        exit();
    }

    // Проверяем, совпадают ли новый пароль и его подтверждение
    if ($newPassword !== $confirmNewPassword) {
        echo "Новый пароль и его подтверждение не совпадают";
        exit();
    }

    if(password_verify($currentPassword, $user_row['password'])){
        $hash = password_hash($newPassword, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password = '$hash' WHERE id = $user_id";
        
        if($mysqli->query($sql) === TRUE){
            echo 'Пароль успешно изменен';
        } else {
            echo 'Ошибка! Не удалось изменить пароль';
        }
    } else {
        echo "Ошибка: Неверный текущий пароль.";
        exit();
    }
} else {
    // Если запрос не является POST, перенаправляем пользователя на другую страницу или выводим сообщение об ошибке
    echo "Недопустимый метод запроса";
}
?>
