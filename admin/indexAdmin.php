<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Список отелей</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
  <h1 class="text-center mt-0">Панель администратора</h1>
  <div class="container">
        <div class="d-flex justify-content-between">
        <h4>Список отелей</h4>
        <a href="/HotelReservation/handlers/logout.php" class="btn btn-secondary">Выйти</a>
        </div>
        <a href="./pages/add_hotel_admin.php" class="btn btn-success">Добавить отель</a>
        <a href="./pages/reservation_list.php" class="btn btn-primary">Список заказов</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th  class='text-center'>#</th>
                    <th  class='text-center'>Имя</th>
                    <th  class='text-center'>Адресс</th>
                    <th  class='text-center'>Рейтинг</th>
                    <th  class='text-center'>Телефон</th>
                    <th  class='text-center'>Дата строительства</th>
                    <th  class='text-center'>Линия от берега</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
              <?php
                // Подключение к базе данных
                $mysqli = new mysqli("localhost", "root", "", "hotelDb");

                // Проверка соединения
                if ($mysqli->connect_error) {
                    die("Connection failed: " . $mysqli->connect_error);
                }

                // Запрос для извлечения данных из таблицы отелей
                $sql = "SELECT * FROM hotels";
                $result = $mysqli->query($sql);

                // Проверка наличия данных
                if ($result->num_rows > 0) {
                    // Вывод данных в таблицу
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td class='text-center'>" . $row["id"] . "</td>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["address"] . "</td>";
                        echo "<td class='text-center'>" . $row["grade"] . "</td>";
                        echo "<td class='text-center'>" . $row["phoneNumber"] . "</td>";
                        echo "<td class='text-center'>" . $row["reconstructionDate"] . "</td>";
                        echo "<td class='text-center'>" . $row["beachLine"] . "</td>";
                        echo "<td class='text-center'><a href='./pages/list_hotel_images_admin.php?hotelId=". $row['id'] ."' class='btn btn-success'>📸</a></td>";
                        echo "<td class='text-center'><a href='./pages/edit_hotel_admin.php?hotelId=". $row['id'] ."' class='btn btn-warning'>✎</a></td>";
                        echo "<td class='text-center'><button onclick='deleteHotel(". $row['id'] .")' class='btn btn-danger'>✖</button></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "0 результатов";
                }

                // Закрытие соединения с базой данных
                $mysqli->close();
              ?>
            </tbody>
        </table>
    </div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="/HotelReservation/admin/scripts/remove-hotel-admin.js"></script>
</body>
</html>