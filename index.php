<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Бронирование отелей</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href="styles/style.css" rel="stylesheet">
</head>
<body>

<?php include './components/nav.php' ?>

<div class="container content">
  <h1 class="text-center mt-0">Добро пожаловать на сайт по бронированию отелей</h1>
  <h3 class="text-center">У нас вы найдете то, что ищете! Так что вперед!</h3>
  <div id="topHotelsCarousel" class="carousel carousel-dark slide mb-5">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#topHotelsCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#topHotelsCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#topHotelsCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <?php include './handlers/get_top_3_hotels_to_carousel_inner.php' ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#topHotelsCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#topHotelsCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <div class="d-flex justify-content-center mb-3">
    <form id="hotelsFilterForm" action="./handlers/search_hotels.php" method="GET" class="row g-3">
      <div class="formBlockItem">
        <label for="partOfName" class="form-label">Имя отеля содержит:</label>
        <input id="partOfName" name="partOfName" type="text" class="form-control"/>
      </div>
      <div class="formBlockItem">
        <label for="grade" class="form-label">Минимальный рейтинг:</label>
        <select class="form-select mb-3" name="grade" id="grade">
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
        </select>
      </div>
      <div class="formBlockItem">
        <label for="beachLine" class="form-label">Линия от берега:</label>
        <select class="form-select mb-3" name="beachLine" id="beachLine">
          <option value="0">Все</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
        </select>
      </div>
      <div class="formBlockItem">
        <label class="form-label opacity-0">Жми</label>
        <input type="submit" value="Подобрать" class="btn btn-primary">
      </div>
    </form>
  </div>
  <div id="hotels">
    <?php include './handlers/search_hotels_without_filter.php' ?>
  </div>
</div>

<?php include './components/footer.php' ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="./scripts/script.js"></script>
</body>
</html>