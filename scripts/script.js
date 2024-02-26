// Функция для отправки AJAX-запроса
function filterHotels() {
    var formData = new FormData(document.getElementById("hotelsFilterForm"));
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                document.getElementById("hotels").innerHTML = xhr.responseText;
            } else {
                console.error('Ошибка при выполнении запроса');
            }
        }
    };
    xhr.open("GET", "./handlers/search_hotels.php?" + new URLSearchParams(formData).toString(), true);
    xhr.send();
}

// Обработка события отправки формы
document.getElementById("hotelsFilterForm").addEventListener("submit", function (event) {
    event.preventDefault();
    filterHotels();
});