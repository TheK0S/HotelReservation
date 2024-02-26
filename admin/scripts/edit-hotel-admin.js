console.log('formData');
$(document).ready(function(){
    // Подписка на событие отправки формы
    $('#editHotelForm').submit(function(event){
        event.preventDefault(); // Предотвращение стандартной отправки формы
        // Получение данных формы
        //var formData = $(this).serialize();
        var formData = new FormData(this);
        console.log(formData);

        // AJAX-запрос на обновление данных об отеле
        $.ajax({
            url: '/HotelReservation/admin/handlers/edit_hotel_admin_handler.php', // Путь к обработчику формы
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response){
                alert(response); // Отображение результата во всплывающем окне
                window.location.href = "/HotelReservation/admin/indexAdmin.php";
            },
            error: function(xhr, status, error){
                alert("Произошла ошибка: " + error); // Отображение ошибки во всплывающем окне
            }
        });
    });
});