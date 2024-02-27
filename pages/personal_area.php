<?php
session_start();

// Подключение к базе данных
$mysqli = new mysqli("localhost", "root", "", "hotelDb");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Проверка, авторизован ли пользователь
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
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

// Получение информации о резервациях пользователя
$reservation_query = "SELECT * FROM reservations WHERE userId = $user_id";
$reservation_result = $mysqli->query($reservation_query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    .reservation-wrapper{
        gap: 20px;
        justify-content: center;
    }
    .card{
        min-width: 280px;
        box-shadow: 3px 3px 15px gray;
    }
    footer{
    background-color: rgb(52, 52, 73);
    }
</style>
<body>
    <?php include '../components/nav.php' ?>
    <div class="container mb-5">
        <h1 class="mt-2 text-center">Личный кабинет</h1>
        <div class="mt-5">
            <h2 class="text-center mb-5">Информация о пользователе:</h2>
            <p><strong>Имя:</strong> <?php echo $user_row['firstName']; ?></p>
            <p><strong>Фамилия:</strong> <?php echo $user_row['lastName']; ?></p>
            <p><strong>Отчество:</strong> <?php echo $user_row['patronomic']; ?></p>
            <p><strong>Email:</strong> <?php echo $user_row['email']; ?></p>
            <p><strong>Номер телефона:</strong> <?php echo $user_row['phoneNumber']; ?></p>
            <p><strong>Дата рождения:</strong> <?php echo $user_row['birthdate']; ?></p>
            <p><strong>Дата регистрации:</strong> <?php echo $user_row['registerDate']; ?></p>
        </div>
        <div class="mt-3">
            <h2 class="text-center mb-5">Мои заказы:</h2>
            <div class="d-flex flex-wrap reservation-wrapper">
                <?php if ($reservation_result->num_rows > 0): ?>
                    <?php while ($reservation_row = $reservation_result->fetch_assoc()): ?>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Отель: <?php echo getHotelName($mysqli, $reservation_row['hotelId']); ?></h5>
                                <p class="card-text"><strong>Дата заезда:</strong> <?php echo $reservation_row['dateIn']; ?></p>
                                <p class="card-text"><strong>Дата выезда:</strong> <?php echo $reservation_row['dateOut']; ?></p>
                                <p class="card-text"><strong>Дата бронирования:</strong> <?php echo $reservation_row['reservationDate']; ?></p>
                                <p class="card-text"><strong>Цена бронирования:</strong> <?php echo $reservation_row['reservationPrice']; ?></p>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>У вас нет активных резерваций.</p>
                <?php endif; ?>
            </div>
        </div>
        <a href="/HotelReservation/index.php" class="btn btn-primary mt-5">На главную</a>
    </div>
    <?php include '../components/footer.php' ?>
</body>
</html>

<?php
// Закрытие соединения с базой данных
$mysqli->close();

function getHotelName($mysqli, $hotelId) {
    $hotel_query = "SELECT name FROM hotels WHERE id = $hotelId";
    $hotel_result = $mysqli->query($hotel_query);
    if ($hotel_result->num_rows == 1) {
        $hotel_row = $hotel_result->fetch_assoc();
        return $hotel_row['name'];
    } else {
        return "Неизвестный отель";
    }
}
?>
