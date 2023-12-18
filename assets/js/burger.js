document.addEventListener('DOMContentLoaded', function () {
    var burger = document.querySelector('.burger');
    var sidebar = document.querySelector('.sidebar');
    var container = document.querySelector('.container');

    burger.addEventListener('click', function () {
        sidebar.classList.toggle('active');
        container.classList.toggle('active');
        burger.classList.toggle('active');
    });
});