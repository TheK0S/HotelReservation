
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Редактирование фото номеров отеля</title>
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

    
?>
    <div class="container">
        <h1>Редактирование фото номеров отеля <?php echo $hotelId; ?></h1>
    </div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>