document.addEventListener('DOMContentLoaded', function () {
    var userMenuButton = document.getElementById('user-menu-button');
    var userDropdown = document.getElementById('user-dropdown');

    userMenuButton.addEventListener('click', function () {
        userDropdown.classList.toggle('hidden');
    });
});