<?php
include '../functions.php';
// Подключение к базе данных
$mysqli = new mysqli("localhost", "root", "", "hotelDb");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Получение данных из формы
$partOfName = $_GET['partOfName'];
$grade = $_GET['grade'];
$beachLine = $_GET['beachLine'];

// Формируем SQL-запрос
$sql = "SELECT * FROM hotels WHERE 1";

if (!empty($partOfName)) {
    $sql .= " AND name LIKE '%$partOfName%'";
}

if ($grade > 0) {
    $sql .= " AND grade >= $grade";
}

if ($beachLine > 0) {
    $sql .= " AND beachLine = $beachLine";
}

// Выполнение запроса
$result = $mysqli->query($sql);



if ($result->num_rows > 0) {
    // Отображение отелей
    while ($row = $result->fetch_assoc()) {
        echo '
        <div class="card mb-3 w-100 shadow">
            <div class="row g-0">
                <div class="col-md-3">
                    <img src="' . $row["imagePath"] . '" class="img-fluid rounded-start w-100" alt="' . $row["name"] . '">
                </div>
                <div class="col-md-7">
                    <div class="card-body">
                        <h5 class="card-title">' . $row["name"] . '<span class="ms-3 text-warning">' . printGrade($row["grade"]) . '</span></h5>
                        <p class="card-text">' . $row["title"] . '</p>
                        <p class="card-text">Номер телефона: ' . $row["phoneNumber"] . '</p>
                        <p class="card-text"><small class="text-body-secondary">Дата реконструкции: ' . $row["reconstructionDate"] . '</small></p>
                    </div>
                </div>
                <div class="col-md-2 d-flex align-items-center justify-content-center">
                <a href="./pages/hotel_detail.php?hotelId=' . $row["id"] . '" class="btn btn-primary">Подробнее...</a>
                </div>
            </div>
        </div>';
    }
} else {
    echo "Нет доступных отелей.";
}

// Закрываем соединение с базой данных
$mysqli->close();
?>