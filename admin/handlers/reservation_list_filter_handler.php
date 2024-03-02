<?php
session_start();

$mysqli = new mysqli("localhost", "root", "", "hotelDb");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Проверяем, была ли отправлена форма
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Получаем значения фильтров
    $dateBeginRange = $_GET['dateBeginRange'] ?? '';
    $dateEndRange = $_GET['dateEndRange'] ?? '';
    $emailPart = $_GET['emailPart'] ?? '';
    $namePart = $_GET['namePart'] ?? '';

    // Формируем условия для фильтрации
    $conditions = [];
    if (!empty($dateBeginRange)) {
        $conditions[] = "r.dateIn >= '$dateBeginRange'";
    }
    if (!empty($dateEndRange)) {
        $conditions[] = "r.dateOut <= '$dateEndRange'";
    }
    if (!empty($emailPart)) {
        $conditions[] = "u.email LIKE '%$emailPart%'";
    }
    if (!empty($namePart)) {
        $conditions[] = "CONCAT(u.firstName, ' ', u.lastName, ' ', COALESCE(u.patronomic, '')) LIKE '%$namePart%'";
    }

    // Формируем SQL-запрос с учетом условий
    $whereClause = '';
    if (!empty($conditions)) {
        $whereClause = "WHERE " . implode(" AND ", $conditions);
    }

    $reservation_query = "SELECT 
        r.id AS reservation_id,
        h.name AS hotel_name,
        r.roomId,
        CONCAT(u.firstName, ' ', u.lastName, ' ', COALESCE(u.patronomic, '')) AS user_name,
        u.email AS user_email,
        r.dateIn,
        r.dateOut,
        r.reservationDate,
        r.reservationPrice
    FROM 
        reservations r
    JOIN
        users u ON r.userId = u.id
    JOIN
        hotels h ON r.hotelId = h.id
    $whereClause
    ";
    $reservation_result = $mysqli->query($reservation_query);
}
?>

<?php if ($reservation_result->num_rows > 0): ?>
    <?php while ($reservation_row = $reservation_result->fetch_assoc()): ?>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Отель: <?php echo $reservation_row['hotel_name']; ?></h5>
                <p class="card-text"><strong>Номер в отеле:</strong> <?php echo $reservation_row['roomId']; ?></p>
                <p class="card-text"><strong>Дата заезда:</strong> <?php echo $reservation_row['dateIn']; ?></p>
                <p class="card-text"><strong>Дата выезда:</strong> <?php echo $reservation_row['dateOut']; ?></p>
                <p class="card-text"><strong>Дата бронирования:</strong> <?php echo $reservation_row['reservationDate']; ?></p>
                <p class="card-text"><strong>Цена бронирования:</strong> <?php echo $reservation_row['reservationPrice']; ?></p>
                <p class="card-text"><strong>Имя клиента:</strong> <?php echo $reservation_row['user_name']; ?></p>
                <p class="card-text"><strong>Почта клиента:</strong> <?php echo $reservation_row['user_email']; ?></p>
            </div>
        </div>
    <?php endwhile; ?>
<?php else: ?>
    <p>Нет резерваций удовлетворяющих условия фильтра.</p>
<?php endif;
