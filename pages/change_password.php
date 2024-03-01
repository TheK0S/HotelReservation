<?php
session_start();

// Подключение к базе данных
$mysqli = new mysqli("localhost", "root", "", "hotelDb");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Проверка, авторизован ли пользователь
if (!isset($_SESSION['user_id'])) {
    header("Location: /HotelReservation/pages/login.php");
    exit();
}

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
// Закрытие соединения с базой данных
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Смена пароля</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    body{
        min-height: 100vh;
    }
    footer{
    background-color: rgb(52, 52, 73);
    position: absolute;
    bottom: 0;
    left: 0;
    min-width: 100%;
    }
</style>
<body>
    <?php include '../components/nav.php' ?>
    <div class="container mb-5">
            <div class="mb-3">
                <label for="currentPassword" class="form-label">Ваш Email</label>
                <p type="password" class="form-control" id="currentPassword"><?php echo $user_row['email'] ?></p>
            </div>
        <form id="passwordChangeForm" action="/HotelReservation/handlers/change_password_handler.php" method="POST">
            <div class="mb-3">
                <label for="currentPassword" class="form-label">Введите текущий пароль</label>
                <input type="password" class="form-control" id="currentPassword" name="currentPassword" required>
            </div>
            <div class="mb-3">
                <label for="newPassword" class="form-label">Введите новый пароль</label>
                <input type="password" class="form-control" id="newPassword" name="newPassword" oninput="checkPasswordMatch()" required>
            </div>
            <div class="mb-3">
                <label for="confirmNewPassword" class="form-label">Повторите новый пароль</label>
                <input type="password" class="form-control" id="confirmNewPassword" oninput="checkPasswordMatch()" name="confirmNewPassword" required>
                <span id="passwordMatch" style="color: red;"></span>
            </div>
            <div class="mb-3">
                <input type="submit" class="btn btn-success" value="Подтвердить смену пароля">
            </div>
        </form>
        <a href="/HotelReservation/index.php" class="btn btn-primary mt-5">На главную</a>
    </div>
    <?php include '../components/footer.php' ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="/HotelReservation/scripts/change-password.js"></script>
</body>
</html>