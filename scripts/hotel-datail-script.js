// Функция для отправки AJAX-запроса и обновления результатов на странице
function searchRooms() {
    var formData = new FormData(document.getElementById("searchForm"));
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                document.getElementById("roomResults").innerHTML = xhr.responseText;
            } else {
                console.error('Ошибка при выполнении запроса');
            }
        }
    };
    xhr.open("GET", "../handlers/search_rooms.php?" + new URLSearchParams(formData).toString(), true);
    xhr.send();
}

// Обработка события отправки формы
document.getElementById("searchForm").addEventListener("submit", function(event) {
    event.preventDefault();
    searchRooms();
});