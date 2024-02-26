function deleteHotel(hotelId) {
    // Формируем URL с ID отеля для передачи через строку запроса
    var url = '/HotelReservation/admin/handlers/remove_hotel_admin.php?hotel_id=' + hotelId;

    // Выполняем AJAX запрос
    $.ajax({
        url: url,
        type: 'GET',
        success: function(response) {
            alert("Отель №" + hotelId + "успешно удален");
            location.reload();
        },
        error: function(xhr, status, error) {
            alert("Произошла ошибка при удалении отеля: " + error);
        }
    });
}
