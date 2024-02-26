// Подписка на событие отправки формы
$(document).ready(function() {
    $('#addHotelForm').submit(function(e) {
      e.preventDefault(); // Предотвращаем отправку формы по умолчанию

      // Получение данных из формы
      var formData = new FormData(this);

      // Выполнение AJAX запроса
      $.ajax({
        url: '/HotelReservation/admin/handlers/add_hotel_admin_handler.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          // Отображение результата в алерте
          alert(response);
          // Перенаправление на страницу администратора после успешного добавления
          window.location.href = "/HotelReservation/admin/indexAdmin.php";
        },
        error: function(xhr, status, error) {
          // Отображение сообщения об ошибке в алерте
          alert("Произошла ошибка: " + error);
        }
      });
    });
  });