<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Добавление отеля</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
  <div class="container my-5">
    <h1 class="mb-4 text-center">Добавление отеля</h1>
    <form id="addHotelForm" method="POST">
      <div class="mb-3">
        <label for="name" class="form-label">Название отеля</label>
        <input type="text" class="form-control" id="name" name="name" required>
      </div>
      <div class="mb-3">
        <label for="address" class="form-label">Адрес</label>
        <input type="text" class="form-control" id="address" name="address" required>
      </div>
      <div class="mb-3">
        <label for="grade" class="form-label">Рейтинг</label>
        <input type="number" class="form-control" id="grade" name="grade" min="1" max="5" required>
      </div>
      <div class="mb-3">
        <label for="phoneNumber" class="form-label">Номер телефона</label>
        <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" required>
      </div>
      <div class="mb-3">
        <label for="roomsCount" class="form-label">Количество комнат</label>
        <input type="number" class="form-control" id="roomsCount" name="roomsCount" required>
      </div>
      <div class="mb-3">
        <label for="beachLine" class="form-label">Линия от берега</label>
        <input type="number" class="form-control" id="beachLine" name="beachLine" required>
      </div>
      <div class="mb-3">
        <label for="birthdate" class="form-label">Дата строительства</label>
        <input type="date" class="form-control" id="birthdate" name="birthdate" required>
      </div>
      <div class="mb-3">
        <label for="reconstructionDate" class="form-label">Дата реконструкции</label>
        <input type="date" class="form-control" id="reconstructionDate" name="reconstructionDate" required>
      </div>
      <div class="mb-3">
        <label for="imagePath" class="form-label">URL адрес изображения</label>
        <input type="text" class="form-control" id="imagePath" name="imagePath" required>
      </div>
      <div class="mb-3">
        <label for="title" class="form-label">Заголовок описания отеля</label>
        <input type="text" class="form-control" id="title" name="title" required>
      </div>
      <div class="mb-3">
        <label for="text" class="form-label">Описание отеля</label>
        <textarea class="form-control" id="text" name="text" rows="4" required></textarea>
      </div>
      <div class="d-flex justify-content-between">
      <button type="submit" class="btn btn-primary">Добавить отель</button>
      <a href="/HotelReservation/admin/indexAdmin.php" class="btn btn-danger px-5">Отмена</a>
      </div>
    </form>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="/HotelReservation/admin/scripts/add-hotel-admin.js"></script>
</body>
</html>
