<?php
  session_start();

  if(isset($_SESSION['user_id'])){
    $accountActionHref = "/HotelReservation/handlers/logout.php";
    $accountActionTitle = 'Выйти';
  } else {
    $accountActionHref = "/HotelReservation/pages/login.php";
    $accountActionTitle = 'Войти';
  }
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="/HotelReservation/index.php">Главная</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="/HotelReservation/pages/personal_area.php">Личный кабинет</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo $accountActionHref; ?>"><?php echo $accountActionTitle; ?></a>
        </li>        
      </ul>
    </div>
  </div>
</nav>