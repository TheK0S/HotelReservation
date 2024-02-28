function deleteImage(imageId) {
    var confirmation = confirm("Вы уверены, что хотите удалить эту картинку?");    
    if (confirmation) {
        var url = '/HotelReservation/admin/handlers/delete_room_image_handler.php?id=' + imageId;
        console.log(url)
        $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
                alert(response);
                console.log(response)
                location.reload();
            },
            error: function(xhr, status, error) {
                console.log(xhr)
                console.log(status)
                console.log(error)
                alert("Произошла ошибка при удалении картинки: " + error);
            }
        });            
    }
}