document.addEventListener('DOMContentLoaded', function () {
    var burger = document.querySelector('.burger');
    var sidebar = document.querySelector('.sidebar');

    burger.addEventListener('click', function () {
        sidebar.classList.toggle('active');
        burger.classList.toggle('active');
    });
});