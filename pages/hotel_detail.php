<?php
  session_start();
  include '../functions.php';

  //echo $_SESSION['user_id'];

  $mysqli = new mysqli("localhost", "root", "", "hotelDb");

  if ($mysqli->connect_error) {
      die("Connection failed: " . $mysqli->connect_error);
  }

  if (isset($_GET['hotelId'])) {
    // Получаем значение id
    $hotelId = $_GET['hotelId'];
  } else {
    echo "ID не был передан через адрес";
  }

  $sql = "SELECT * FROM hotels WHERE id='$hotelId'";
  $hotelResult = $mysqli->query($sql);
  $hotel = $hotelResult->fetch_assoc();

  $sql = "SELECT title, imagePath FROM hotelImagePath WHERE hotelId='$hotelId'";
  $hotelImagesPaths = $mysqli->query($sql);

  $sql = "SELECT * FROM hotelImagePath WHERE hotelId='$hotelId'";
  $hotelImages = $mysqli->query($sql);

  $mysqli->close();   
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Бронирование отелей</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="../styles/hotel-detail-styles.css" rel="stylesheet">
  </head>
<body>

<?php include '../components/nav.php' ?>

<div class="container content mb-3"> 
  <?php
      if($hotel["name"]){
          echo '<h1 class="text-center mb-3">Добро пожаловать в отель ' . $hotel["name"] . '</h1>'; 
      }else{
          echo "Выбранный отель не найден";
      }
      
  ?> 

  <div class="row mb-3">
      <div class="col-md-5 col-sm-12">
        <img src="<?php echo $hotel['imagePath']; ?>" alt="<?php echo $hotel['name']; ?>" class="w-100 rounded">
      </div>
      <div class="offset-md-1 col-md-6 col-sm-12">
        <p><b>Рейтинг отеля: </b><?php echo '<span class="ms-2 fs-5 text-warning">' . printGrade($hotel["grade"]) . '</span>'; ?></p>
        <p><b>Адресс: </b><?php echo '<span class="ms-2">'. $hotel["address"] . '</span>'; ?></p>
        <p><b>Номер телефона: </b><?php echo '<span class="ms-2">'. $hotel["phoneNumber"] . '</span>'; ?></p>
        <p><b>Дата основания: </b><?php echo '<span class="ms-2">'. $hotel["birthdate"] . '</span>'; ?></p>
        <p><b>Дата реконструкции: </b><?php echo '<span class="ms-2">'. $hotel["reconstructionDate"] . '</span>'; ?></p>
        <p><b>Количество номеров: </b><?php echo '<span class="ms-2">'. $hotel["roomsCount"] . '</span>'; ?></p>
        <p><b>Линия от пляжа: </b><?php echo '<span class="ms-2">'. $hotel["beachLine"] . '</span>'; ?></p>
      </div>
  </div>
  <h6><?php echo $hotel['title']; ?></h6>
  <p><?php echo $hotel['text']; ?></p>
  <div id="hotelImagesField" class="d-flex flex-wrap mb-3">
    <?php 
      if($hotelImages->num_rows > 0){
        while($row = $hotelImages->fetch_assoc()){
          echo '<div class="cardImage">';
          echo '<img src="'. $row["imagePath"] .'" alt="'. $row["title"] .'" class="w-100 h-100 object-fit-cover rounded">';
          echo '</div>';
        }
      }
    ?>
  </div>

  <div>
    <form id="searchForm" action="../handlers/search_rooms.php" method="GET" class="row g-3 mb-5">
      <input type="text" name="hotelId" value="<?php echo $hotelId ?>" class="d-none">
      <div class="formBlockItem">
        <label for="dateIn" class="form-label">Дата заселения:</label>
        <input id="dateIn" name="dateIn" type="date"/>
      </div>
      <div class="formBlockItem">
        <label for="dateIn" class="form-label">Дата отьезда:</label>
        <input id="dateOut" name="dateOut" type="date"/>
      </div>
      <div class="formBlockItem">
        <label for="minPrice" class="form-label">Цена минимум:</label>
        <input id="minPrice" name="minPrice" type="number" class="form-control"/>
      </div>
      <div class="formBlockItem">
        <label for="maxPrice" class="form-label">Цена максимум:</label>
        <input id="maxPrice" name="maxPrice" type="number" class="form-control"/>
      </div>
      <div class="formBlockItem">
        <label for="isWiFi" class="form-label">Количество мест:</label>
        <select class="form-select mb-3" name="bedsCount" id="bedsCount">
          <option value="4">4</option>
          <option value="3">3</option>
          <option value="2">2</option>
          <option value="1">1</option>
        </select>
      </div>
      <div class="formBlockItem">
        <label for="isWiFi" class="form-label">Кондиционер:</label>
        <select class="form-select mb-3" name="isConditioner" id="isConditioner">
          <option value="1">Да</option>
          <option value="0">Нет</option>
        </select>
      </div>
      <div class="formBlockItem">
        <label for="isWiFi" class="form-label">Телевизор:</label>
        <select class="form-select mb-3" name="isTV" id="isTV">
          <option value="1">Да</option>
          <option value="0">Нет</option>
        </select>
      </div>
      <div class="formBlockItem">
        <label for="isWiFi" class="form-label">Wi-Fi:</label>
        <select class="form-select mb-3" name="isWiFi" id="isWiFi">
          <option value="1">Да</option>
          <option value="0">Нет</option>
        </select>
      </div>
      <div class="d-flex justify-content-center">
        <input type="submit" value="Подобрать" class="btn btn-primary w-50">
      </div>
    </form>
  </div>
  <div id="roomResults" class="d-flex justify-content-around"></div>
</div>

<?php include '../components/footer.php' ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="../scripts/hotel-datail-script.js"></script>
</body>
</html>