<style>
    .message-wrapper{
        height: 100vh;
        width: 100vw;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .error{
        color: red;
    }
    .message{
        font-weight: bold;
        font-size: 1.2em;
        text-align: center;
    }
</style>

<?php 
session_start();

if (isset($_GET['hotelId'])
 && isset($_GET['hotelName'])
 && isset($_GET['roomId'])
 && isset($_GET['price'])) {
    $hotelId = $_GET['hotelId'];
    $hotelName = $_GET['hotelName'];
    $roomId = $_GET['roomId'];
    $price = $_GET['price'];
} else {
    echo '<div class="message-wrapper">';
    echo '<p class="message error"><b>Не переданы необходимые данные из страницы отеля. Обратитесь к администратору</p>';
    echo '</div>';
    exit();
}


if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    header("Location: ../pages/login.php?error_message='Неавторизованный пользователь не может забронировать номер, пожалуйста авторизуйтесь или зарегестрируйтесь на сайте и повторите попытку.'");
    exit();
}

if(isset($_GET['dateIn']) && $_GET['dateIn'] !== '0000-00-00'){
    $dateIn = $_GET['dateIn'];
}else{
    echo '<div class="message-wrapper">';
    echo '<p class="message error"><b>Не указана дата заселения, укажите дату начала резервирования и повторите попытку.</b></p>';
    echo '</div>';
    exit();
}

if(isset($_GET['dateOut']) && $_GET['dateOut'] !== '0000-00-00'){
    $dateOut = $_GET['dateOut'];
}else{
    echo '<div class="message-wrapper">';
    echo '<p class="message error"><b>Не указана дата выселения, укажите дату окончания резервации и повторите попытку.</b></p>';
    echo '</div>';
    exit();
}


//Определяем суммарную цену резервации
$dateTimeIn = !empty($dateIn)? new DateTime($dateIn) : null;
$dateTimeOut = !empty($dateOut)? new DateTime($dateOut) : null;
$dateInterval = $dateTimeIn !== null && $dateTimeOut !== null? $dateTimeIn->diff($dateTimeOut) : 0;

$sumPrice = $dateInterval !== 0? ($dateInterval->days + 1) * $price : 0;

// Подключение к базе данных
$mysqli = new mysqli("localhost", "root", "", "hotelDb");

// Проверка соединения с базой данных
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$sql = "INSERT INTO reservations (hotelId, roomId, userId, dateIn, dateOut, reservationDate, reservationPrice)
    VALUES ('$hotelId', '$roomId', '$user_id', '$dateIn', '$dateOut', CURDATE(), '$sumPrice')";

if ($mysqli->query($sql) === TRUE) {
    echo '<div class="message-wrapper">';
    echo '<p class="message"><b>Вы успешно зарезервировали номер '. $roomId .' в отеле '. $hotelName .' Сумма к оплате: '. $sumPrice .'</p>';
    echo '<p class="message"><b>С вами свяжется менеджер для подтверждения информации</p>';
    echo '</div>';
} else {
    echo '<div class="message-wrapper">';
    echo '<p class="message error"><b>Ошибка при добавлении брони: ' . $mysqli->error . '</p>';
    echo '</div>';
    exit();
}

// Закрываем соединение с базой данных
$mysqli->close();


?>