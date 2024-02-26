<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход</title>
    <link rel="stylesheet" href="../styles/registration-styles.css">
</head>
<body>    
    <div class="container">
    <?php
        // Проверяем наличие сообщения о регистрации
        if(isset($_GET['message'])) {
            // Если есть сообщение, выводим его пользователю
            $message = $_GET['message'];
            echo "<p class='message'>$message</p>";
        }elseif(isset($_GET['error_message'])){
            // Если есть сообщение об ошибке, выводим его пользователю
            $error_message = $_GET['error_message'];
            echo "<p class='message error'>$error_message</p>";
        }
    ?>
        <h2>Вход</h2>
        <form action="../handlers/login_process.php" method="POST">
            <label for="email">Электронная почта:</label>
            <input type="text" id="email" name="email">
            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password" class="last-input">
            <input type="submit" value="Войти">
        </form>
        <p>У вас еще нет акаунта? <a href="registration.php">Зарегистрируйся здесь</a>.</p>
    </div>
</body>
</html>
