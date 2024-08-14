import * as library from './functions';

const loginBtn = document.querySelector("#login-btn");
const loginForm = document.querySelector("#login-form");

loginForm.addEventListener("submit", async (event) => {
    event.preventDefault();
    const formData = new FormData(loginForm)

    const loginResponse = await fetch('/admin/login', {
        method: "POST",
        body: formData
    });
    const data = await loginResponse.json()
    const response = data.response;

    if (response.status === 404) {
        let message = ""
        const messageContainer = document.querySelector('#message-container');
        messageContainer.innerHTML = ''; // Limpiar mensajes previos

        const errorMessage = document.querySelector('.error-message')
        errorMessage.textContent = response.error
        message = response.error

        const allInputs = document.querySelectorAll('.input-form')
        allInputs.forEach(input => {
            input.classList.add('input-error')
        })

        const password = document.querySelector('#password');
        password.value = ""

        messageContainer.innerHTML = library.generateErrorToast(message);
    }
    else window.location.href = '/administrator'

    const toast = document.querySelector('.toast');
    if (toast) {
        toast.style.display = 'flex';
        toast.classList.add('slide-in');

        setTimeout(() => {
            toast.classList.remove('slide-in');
            toast.classList.add('slide-out');
            setTimeout(() => {
                toast.style.display = 'none';
            }, 500);
        }, 5000);
    }

})