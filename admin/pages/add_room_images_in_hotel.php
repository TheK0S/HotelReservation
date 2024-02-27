
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Добавление фото номеров отеля</title>
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

    $mysqli = new mysqli("localhost", "root", "", "hotelDb");

    // Проверка соединения
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    $sql = "SELECT name FROM hotels WHERE id=$hotelId";
    $hotelResult = $mysqli->query($sql);

    $sql = "SELECT * FROM hotelImagePath WHERE hotelId=$hotelId";
    $imagesResult = $mysqli->query($sql);   
    
?>
    <div class="container">
        <h1 class="text-center">Добавление фото номеров отеля <?php if($hotelResult->num_rows == 1) echo $hotelResult->fetch_assoc()['name']; ?></h1>
        <form id="editHotelImagesForm" method="POST">
            <input type="hidden" name="hotelId" value="<?php echo $hotelId; ?>">
            <div class="mb-3 mt-5">
                <label for="title" class="form-label">Заголовок для каринки</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="imagePath" class="form-label">URL путь к каринке</label>
                <input type="text" class="form-control" id="imagePath" name="imagePath" required>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Добавить</button>
                <a href="/HotelReservation/admin/indexAdmin.php" class="btn btn-danger px-4">Отмена</a>
            </div>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
        // Обработчик отправки формы
            $('#editHotelImagesForm').submit(function(e){
                e.preventDefault(); // Предотвращаем стандартное поведение формы

                // Получаем данные из формы
                var formData = $(this).serialize();

                // Отправляем AJAX-запрос
                $.ajax({
                    url: '/HotelReservation/admin/handlers/add_room_images_handler.php', // Путь к обработчику формы
                    type: 'POST',
                    data: formData, // Данные из формы
                    success: function(response){
                        // В случае успешного ответа от сервера
                        alert(response);
                        window.location.href = "/HotelReservation/admin/pages/add_room_images_in_hotel.php?hotelId=" + $hotelId;
                    },
                    error: function(xhr, status, error){
                        // В случае ошибки
                        console.error(xhr.responseText); // Выводим сообщение об ошибке в консоль
                        alert('Произошла ошибка при добавлении изображения'); // Отображаем сообщение об ошибке
                    }
                });
            });
        });
    </script>
</body>
</html>