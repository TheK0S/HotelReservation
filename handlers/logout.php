<?php 
    session_start();
    session_unset();
    session_destroy();
    header('Location: /HotelReservation/index.php');
    exit();
?>