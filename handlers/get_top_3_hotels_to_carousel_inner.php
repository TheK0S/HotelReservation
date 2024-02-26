<?php

include 'functions.php';
  $mysqli = new mysqli("localhost", "root", "", "hotelDb");

  if ($mysqli->connect_error) {
      die("Connection failed: " . $mysqli->connect_error);
  }

  $sql = "SELECT id, name, title, grade, imagePath FROM hotels ORDER BY grade DESC LIMIT 3";
  $topHotels = $mysqli->query($sql);

  $mysqli->close();

  if ($topHotels->num_rows > 0) {
    $row = $topHotels->fetch_assoc();
    echo '<div class="carousel-item active" data-bs-interval="5000">
            <img src="' . $row['imagePath'] . '" class="d-block w-100 h-100 carousel-image" alt="' . $row['name'] . '">
            <div class="carousel-caption d-none d-md-block text-carousel-wrapper">
              <h5>' . $row['name'] . '</h5>
              <p class="text-warning fs-5">' . printGrade($row["grade"]) . '</p>
              <p>' . $row['title'] . '</p>
              <a href="./pages/hotel_detail.php?hotelId=' . $row["id"] . '" class="btn btn-primary">Подробнее...</a>
            </div>
          </div>';
    while ($row = $topHotels->fetch_assoc()) {
      echo '<div class="carousel-item" data-bs-interval="5000">
              <img src="' . $row['imagePath'] . '" class="d-block w-100 h-100 carousel-image" alt="' . $row['name'] . '">
              <div class="carousel-caption d-none d-md-block text-carousel-wrapper">
                <h5>' . $row['name'] . '</h5>
                <p class="text-warning fs-5">' . printGrade($row["grade"]) . '</p>
                <p>' . $row['title'] . '</p>
                <a href="./pages/hotel_detail.php?hotelId=' . $row["id"] . '" class="btn btn-primary">Подробнее...</a>
              </div>
            </div>';
      }
  } 
?>