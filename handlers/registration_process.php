<?php
$mysqli = new mysqli("localhost", "root", "", "hotelDb");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Обработчик формы регистрации
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = htmlspecialchars($_POST["firstName"]);
    $lastName = htmlspecialchars($_POST["lastName"]);
    $patronomic = htmlspecialchars($_POST["patronomic"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $confirmPassword = password_hash($_POST["confirmPassword"], PASSWORD_DEFAULT);
    $phoneNumber = htmlspecialchars($_POST["phoneNumber"]);
    $birthdate = htmlspecialchars($_POST["birthdate"]);
    $registerDate = date("Y-m-d");

    // Проверка наличия пользователя с таким email
    $checkQuery = "SELECT id FROM users WHERE email = ?";
    $checkStmt = $mysqli->prepare($checkQuery);
    $checkStmt->bind_param("s", $email);
    $checkStmt->execute();
    $checkStmt->store_result();
    
    if ($checkStmt->num_rows > 0) {
        // Пользователь с таким email уже существует
        header("Location: ../pages/registration.php?error_message=" . urlencode("Пользователь с таким email уже зарегистрирован!"));
        exit();
    }
    $checkStmt->close();

    // Проверка совпадения паролей
    if ($_POST["password"] !== $_POST["confirmPassword"]) {
        header("Location: ../pages/registration.php?error_message=" . urlencode("Пароли не совпадают!"));
        exit();
    }

    // Подготовка SQL запроса
    $stmt = $mysqli->prepare("INSERT INTO users (firstName, lastName, patronomic, email, password, phoneNumber, birthdate, registerDate) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    
    // Привязка параметров
    $stmt->bind_param("ssssssss", $firstName, $lastName, $patronomic, $email, $password, $phoneNumber, $birthdate, $registerDate);

    // Выполнение запроса
    if ($stmt->execute()) {
        header("Location: ../pages/login.php?message=" . urlencode("Вы успешно зарегистрированы!"));
        exit();
    } else {
        header("Location: ../pages/registration.php?error_message=" . urlencode("Ошибка регистации: " . $stmt->error));
        exit();
    }

    $stmt->close();
}

// Закрытие соединения с базой данных
$mysqli->close();
?>
