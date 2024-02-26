<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link rel="stylesheet" href="../styles/registration-styles.css">
</head>
<body>
    <div class="container">
        <h2>Регистрация</h2>
        <form action="../handlers/registration_process.php" method="POST">
            <label for="firstName">Имя:</label>
            <input type="text" id="firstName" name="firstName" required>
            <label for="lastName">Фамилия:</label>
            <input type="text" id="lastName" name="lastName" required>
            <label for="patronomic">Отчество:</label>
            <input type="text" id="patronomic" name="patronomic">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password" required>
            <label for="confirmPassword">Подтверждение пароля:</label>
            <input type="password" id="confirmPassword" name="confirmPassword" required>
            <label for="phoneNumber">Номер телефона:</label>
            <input type="tel" id="phoneNumber" name="phoneNumber" required>
            <label for="birthdate">Дата рождения:</label>
            <input type="date" id="birthdate" name="birthdate">
            <input type="submit" value="Зарегистрировать">
        </form>
    </div>
</body>
</html>
