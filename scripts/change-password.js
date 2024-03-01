function checkPasswordMatch() {
    var newPassword = document.getElementById("newPassword").value;
    var confirmNewPassword = document.getElementById("confirmNewPassword").value;
    var passwordMatch = document.getElementById("passwordMatch");

    if (newPassword !== confirmNewPassword) {
        passwordMatch.textContent = "Пароли не совпадают!";
    } else {
        passwordMatch.textContent = "";
    }
}

$(document).ready(function(){
    $('#passwordChangeForm').submit(function(e){
        e.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            url: '/HotelReservation/handlers/change_password_handler.php',
            type: 'POST',
            data: formData,
            success: function(response){
                alert(response);
                window.location.href = "/HotelReservation/pages/personal_area.php";
            },
            error: function(xhr, status, error){
                console.error(xhr.responseText);
                alert('Произошла ошибка при изменении пароля');
            }
        });
    });
});