<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Редактирование отеля</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<?php 
    if(isset($_GET['hotelId'])) {
        // Получаем ID отеля из строки запроса
        $hotelId = $_GET['hotelId'];
    }else{
        echo '<div style="height: 100vh;" class="d-flex flex-column w-100 align-items-center justify-content-center">';
        echo '<p class="text-danger fw-bold fs-3">Ошибка!</p>';
        echo '<p class="text-danger fw-bold fs-5">Не переданы данные об отеле</p>';
        echo '</div>';
        exit();
    }

    // Подключение к базе данных
    $mysqli = new mysqli("localhost", "root", "", "hotelDb");

    // Проверка соединения
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Запрос для извлечения данных из таблицы отелей
    $sql = "SELECT * FROM hotels WHERE id='$hotelId'";
    $result = $mysqli->query($sql);
    
    if($result->num_rows == 1) {
      $hotel = $result->fetch_assoc();
    }else{
        echo '<div style="height: 100vh;" class="d-flex flex-column w-100 align-items-center justify-content-center">';
        echo '<p class="text-danger fw-bold fs-3">Ошибка!</p>';
        echo '<p class="text-danger fw-bold fs-5">Данные отеля не получены, попробуйте повторить попытку.</p>';
        echo '</div>';
        exit();
    }
?>
    <div class="container my-5">
    <h1 class="mb-4 text-center">Редактирование отеля</h1>
    <form id="editHotelForm" method="POST">
      <div class="mb-3">
        <label for="hotelId" class="form-label">hotelId</label>
        <input type="number" class="form-control" id="hotelId" name="hotelId" value="<?php echo $hotel['id'] ?>" required readonly>
      </div>
      <div class="mb-3">
        <label for="name" class="form-label">Название отеля</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo $hotel['name'] ?>" required>
      </div>
      <div class="mb-3">
        <label for="address" class="form-label">Адрес</label>
        <input type="text" class="form-control" id="address" name="address" value="<?php echo $hotel['address'] ?>" required>
      </div>
      <div class="mb-3">
        <label for="grade" class="form-label">Рейтинг</label>
        <input type="number" class="form-control" id="grade" name="grade" min="1" max="5" value="<?php echo $hotel['grade'] ?>" required>
      </div>
      <div class="mb-3">
        <label for="phoneNumber" class="form-label">Номер телефона</label>
        <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" value="<?php echo $hotel['phoneNumber'] ?>" required>
      </div>
      <div class="mb-3">
        <label for="roomsCount" class="form-label">Количество комнат</label>
        <input type="number" class="form-control" id="roomsCount" name="roomsCount" value="<?php echo $hotel['roomsCount'] ?>" required>
      </div>
      <div class="mb-3">
        <label for="beachLine" class="form-label">Линия от берега</label>
        <input type="number" class="form-control" id="beachLine" name="beachLine" value="<?php echo $hotel['beachLine'] ?>" required>
      </div>
      <div class="mb-3">
        <label for="birthdate" class="form-label">Дата строительства</label>
        <input type="date" class="form-control" id="birthdate" name="birthdate" value="<?php echo $hotel['birthdate'] ?>" required>
      </div>
      <div class="mb-3">
        <label for="reconstructionDate" class="form-label">Дата реконструкции</label>
        <input type="date" class="form-control" id="reconstructionDate" name="reconstructionDate" value="<?php echo isset($hotel['reconstructionDate']) ? htmlspecialchars($hotel['reconstructionDate']) : '' ?>" required>
      </div>
      <div class="mb-3">
        <label for="imagePath" class="form-label">URL адрес изображения</label>
        <input type="text" class="form-control" id="imagePath" name="imagePath" value="<?php echo $hotel['imagePath'] ?>" required>
      </div>
      <div class="mb-3">
        <label for="title" class="form-label">Заголовок описания отеля</label>
        <input type="text" class="form-control" id="title" name="title" value="<?php echo $hotel['title'] ?>" required>
      </div>
      <div class="mb-3">
        <label for="text" class="form-label">Описание отеля</label>
        <textarea class="form-control" id="text" name="text" rows="4" required><?php echo $hotel['text'] ?></textarea>
      </div>
      <div class="d-flex justify-content-between">
      <button type="submit" class="btn btn-primary">Сохранить</button>
      <a href="/HotelReservation/admin/indexAdmin.php" class="btn btn-danger px-4">Отмена</a>
      </div>
    </form>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="/HotelReservation/admin/scripts/edit-hotel-admin.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>