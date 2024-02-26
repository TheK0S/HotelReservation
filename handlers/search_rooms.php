<?php
// Подключение к базе данных
$mysqli = new mysqli("localhost", "root", "", "hotelDb");

// Проверка соединения с базой данных
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Получение данных из формы
$hotelId = $_GET['hotelId'];
$dateIn = $_GET['dateIn'];
$dateOut = $_GET['dateOut'];
$minPrice = $_GET['minPrice'];
$maxPrice = $_GET['maxPrice'];
$bedsCount = $_GET['bedsCount'];
$isConditioner = $_GET['isConditioner'];
$isTV = $_GET['isTV'];
$isWiFi = $_GET['isWiFi'];

// Подготовка SQL-запроса
$sql = "SELECT name FROM hotels WHERE id = '$hotelId'";

$hotelNameResult = $mysqli->query($sql);
$hotelName = $hotelNameResult->num_rows > 0? ($hotelNameResult->fetch_assoc())['name'] : null;

$sql = "SELECT * FROM rooms WHERE hotelId = '$hotelId'";

// Добавление фильтров в SQL-запрос
if (!empty($dateIn) && !empty($dateOut)) {
    // Проверка наличия свободных номеров на указанные даты
    $sql .= " AND id NOT IN (
        SELECT roomId FROM reservations 
        WHERE hotelId = '$hotelId'
        AND (
            (dateIn >= '$dateIn' AND dateIn < '$dateOut') OR 
            (dateOut > '$dateIn' AND dateOut <= '$dateOut') OR 
            (dateIn <= '$dateIn' AND dateOut >= '$dateOut')
        )
    )";
}

if (!empty($minPrice)) {
    $sql .= " AND price >= $minPrice";
}

if (!empty($maxPrice)) {
    $sql .= " AND price <= $maxPrice";
}

if (!empty($bedsCount)) {
    $sql .= " AND bedsCount = $bedsCount";
}

if (!empty($isConditioner)) {
    $sql .= " AND isConditioner = $isConditioner";
}

if (!empty($isTV)) {
    $sql .= " AND isTV = $isTV";
}

if (!empty($isWiFi)) {
    $sql .= " AND isWiFi = $isWiFi";
}

$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    // Выводим карточки для каждой комнаты
    while($row = $result->fetch_assoc()) {
        echo '<div class="card mb-3">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $row['roomTitle'] . '</h5>';
        echo '<p class="card-text">' . $row['roomText'] . '</p>';
        echo'<p class="m-0"><b>'. $row['bedsCount'] .'</b> места</p>';
        if($row['isConditioner']) echo '<p class="m-0"><b>Кодиционер</b></p>';
        if($row['isTV']) echo '<p class="m-0"><b>Телевизор</b></p>';
        if($row['isWiFi']) echo '<p class="m-0"><b>Wi-Fi</b></p>';
        echo '</div>';
        echo '<div class="card-footer">';
        echo '<div class="d-flex align-items-center justify-content-between">';
        echo '<p class="m-0">Цена за ночь: <b class="text-warning">' . $row['price'] . '</b></p>';
        echo '<a href="../handlers/room_reservation.php?
        hotelId='. $row['hotelId'] .'&
        hotelName='. $hotelName .'&
        roomId='. $row['id'] .'&
        dateIn='. $dateIn .'&
        dateOut='. $dateOut .'&
        price='. $row['price'] .'" class="btn btn-primary">Забронировать</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo "Нет доступных комнат.";
}

// Закрытие соединения с базой данных
$mysqli->close();
?>
