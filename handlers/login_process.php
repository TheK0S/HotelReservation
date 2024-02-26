<?php
// Начинаем сессию
session_start();

$mysqli = new mysqli("localhost", "root", "", "hotelDb");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $query = "SELECT * FROM users WHERE email = ?";


    $statement = $mysqli->prepare($query);
    $statement->bind_param("s", $email);
    $statement->execute();
    $result = $statement->get_result();

    // Проверка наличия пользователя с указанным логином
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        
        // Проверка пароля
        if (password_verify($password,$row['password'])){
            // Пароль совпадает, переадресация на страницу info.php
            // Сохранение ID пользователя в сеансе
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['role'] = $row['role'];

            if($row['role'] === 'admin'){
                header("Location: ../admin/indexAdmin.php");
                exit();
            }else{
                header("Location: ../index.php");
                exit();
            }
            
        } else {
            // Пароль не совпадает, переадресация на страницу login.php с сообщением об ошибке
            header("Location: ../pages/login.php?error_message=" . urlencode("Неверный пароль!"));
            exit();
        }
    } else {
        // Пользователь с указанным логином не найден, переадресация на страницу login.php с сообщением об ошибке
        header("Location: ../pages/login.php?error_message=" . urlencode("Пользователь не найден!"));
        exit();
    }
}
?>
