<?php
session_start();

// Проверка, авторизован ли пользователь
if (!isset($_SESSION['user_id'])) {
    header("Location: /HotelReservation/pages/login.php");
    exit();
}

$mysqli = new mysqli("localhost", "root", "", "hotelDb");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Получение информации о пользователе
$user_id = $_SESSION['user_id'];
$user_query = "SELECT * FROM users WHERE id = $user_id";
$user_result = $mysqli->query($user_query);
if ($user_result->num_rows == 1) {
    $user_row = $user_result->fetch_assoc();
} else {
    echo "Ошибка: Пользователь не найден.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Изменение данных пользователя</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="text-center">Изменение данных пользователя</h1>
        <form id="editProfileForm" method="POST" action="update_profile.php">
            <div class="mb-3">
                <label for="userId" class="form-label"></label>
                <input type="hidden"  class="form-control" id="userId" name="userId" value="<?php echo $user_row['id']; ?>">
            </div>
            <div class="mb-3">
                <label for="firstName" class="form-label">Имя:</label>
                <input type="text"  class="form-control" id="firstName" name="firstName" value="<?php echo $user_row['firstName']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="lastName" class="form-label">Фамилия:</label>
                <input type="text"  class="form-control" id="lastName" name="lastName" value="<?php echo $user_row['lastName']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="patronomic" class="form-label">Отчество:</label>
                <input type="text"  class="form-control" id="patronomic" name="patronomic" value="<?php echo $user_row['patronomic']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="phoneNumber" class="form-label">Номер телефона:</label>
                <input type="text"  class="form-control" id="phoneNumber" name="phoneNumber" value="<?php echo $user_row['phoneNumber']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="birthdate" class="form-label">Дата рождения:</label>
                <input type="date"  class="form-control" id="birthdate" name="birthdate" value="<?php echo $user_row['birthdate']; ?>" required>
            </div>
            <button type="submit" class="btn btn-success">Сохранить изменения</button>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#editProfileForm').submit(function(e){
                e.preventDefault();
                var formData = $(this).serialize();

                $.ajax({
                    url: '/HotelReservation/handlers/update_profile.php', // Путь к обработчику формы
                    type: 'POST',
                    data: formData,
                    success: function(response){
                        alert(response);
                        window.location.href = '/HotelReservation/pages/personal_area.php';
                    },
                    error: function(xhr, status, error){
                        console.error(xhr.responseText);
                        alert('Произошла ошибка при обновлении данных');
                    }
                });
            });
        });
    </script>
</body>
</html>
