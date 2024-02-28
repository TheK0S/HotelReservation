
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Редактирование фото номеров отеля</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<style>
    .image{
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>
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
        <h1 class="text-center">Редактирование фото номеров отеля <?php if($hotelResult->num_rows == 1) echo $hotelResult->fetch_assoc()['name']; ?></h1>
            <?php
            if($imagesResult->num_rows > 0){
                $index = 1;
                while($row = $imagesResult->fetch_assoc()){
                    echo '<div class="row mb-5 rounded py-3 px-1 shadow">';
                        echo '<div class="col-md-10 col-sm-12">';
                            echo '<div class="mb-3">';
                                echo '<p class="form-label">Заголовок '. $index .'</p>';
                                echo '<p class="form-control">'. $row['title'] .'</p>';
                            echo '</div>';
                            echo '<div class="mb-3">';
                                echo '<p class="form-label">URL адресс каринки '. $index .'</p>';
                                echo '<p class="form-control text-truncate">'. $row['imagePath'] .'</p>';
                            echo '</div>';
                            echo '<div class="d-flex justify-content-center">';
                                echo '<a href="#" class="btn btn-warning me-5">✎ Изменить</a>';
                                echo '<button onclick="deleteImage('. $row['id'] .')" class="btn btn-danger">✖ Удалить</a>';
                            echo '</div>';
                        echo '</div>';
                        echo '<div class="col-md-2 col-sm-12">';
                            echo '<img src="'. $row['imagePath'] .'" alt="'. $row['title'] .'" class="image rounded">';
                        echo '</div>';
                    echo '</div>';
                    
                    $index++;
                }
            }else{
                echo '<div class="my-5">';
                echo '<p class="text-center fs-5">У отеля пока не фотографий номеров</p>';
                echo '</div>';
            }
            ?>
            <div class="d-flex justify-content-between">
                <a href="/HotelReservation/admin/indexAdmin.php" class="btn btn-danger px-4">Отмена</a>
            </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="/HotelReservation/admin/scripts/remove-room-image-admin.js"></script>
</body>
</html>