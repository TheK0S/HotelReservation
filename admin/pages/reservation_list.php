<?php
session_start();

$mysqli = new mysqli("localhost", "root", "", "hotelDb");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}


// Получение информации о резервациях пользователя
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
  hotels h ON r.hotelId = h.id;
";
$reservation_result = $mysqli->query($reservation_query);

?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Список заказов</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<style>
  .reservation-wrapper{
    justify-content: center;
    flex-wrap: wrap;
    gap: 20px;
  }
  .formBlockItem{
    display: flex;
    flex-direction: column;
    width: 150px;
  }
  input[type="date"]{
    border: 1px solid rgb(223, 223, 223);
    border-radius: 6px;
    padding: 6px;
  }

  input[type="date"]:focus{
    border: 5px solid rgba(79, 150, 255, 0.3);
    outline: none;
    padding: 5px;
  }
</style>
<body>
    <div class="container">
      <h1 class="text-center mb-5">Список заказов</h1>
      <div class="d-flex justify-content-center mb-5">
        <form id="searchForm" action="" method="GET">
          <div class="d-flex reservation-wrapper mb-3">
            <div class="formBlockItem">
              <label for="dateBeginRange" class="form-label">Начальная дата:</label>
              <input id="dateBeginRange" name="dateBeginRange" type="date"/>
            </div>
            <div class="formBlockItem">
              <label for="dateEndRange" class="form-label">Конечная дата:</label>
              <input id="dateEndRange" name="dateEndRange" type="date"/>
            </div>
            <div class="formBlockItem">
              <label for="emailPart" class="form-label">Email содержит:</label>
              <input id="emailPart" name="emailPart" type="text" class="form-control"/>
            </div>
            <div class="formBlockItem">
              <label for="namePart" class="form-label">Имя содержит:</label>
              <input id="namePart" name="namePart" type="text" class="form-control"/>
            </div> 
          </div>     
          <div class="d-flex justify-content-center">
            <input type="submit" value="Подобрать" class="btn btn-primary w-50">
          </div>
        </form>
      </div>
      <div id="reservationField" class="d-flex flex-wrap reservation-wrapper mb-5">
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
              <p>У вас нет активных резерваций.</p>
          <?php endif; ?>
      </div>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $(document).ready(function() {
      $('#searchForm').submit(function(e) {
          e.preventDefault();
          var formData = $(this).serialize();

          $.ajax({
              type: 'GET',
              url: '/HotelReservation/admin/handlers/reservation_list_filter_handler.php',
              data: formData,
              success: function(data) {
                  // Обновляем содержимое блока с заказами
                  $('#reservationField').html(data);
              },
              error: function(xhr, status, error) {
                  console.error(error);
                  alert('Произошла ошибка при загрузке данных');
              }
          });
      });
  });
</script>
</body>
</html>