document.addEventListener('DOMContentLoaded', function () {
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');
    const iconShow = togglePassword.querySelector('.icon-show');
    const iconHide = togglePassword.querySelector('.icon-hide');

    togglePassword.addEventListener('click', function () {
        // Cambia el tipo: de 'password' a 'text' y viceversa
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);

        // Cambia el ícono según sea necesario
        if (password.type === 'password') {
            iconShow.style.display = 'none';
            iconHide.style.display = 'inline-block';
        } else {
            iconShow.style.display = 'inline-block';
            iconHide.style.display = 'none';
        }
    });
});