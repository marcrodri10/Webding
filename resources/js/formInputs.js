const formInputs = document.querySelectorAll('input[name^="name"], input[name^="surname"]');
let errorMessages = [];

formInputs.forEach((input) => {
    errorMessages.push(input.nextElementSibling.querySelector('.error-message'));
})


formInputs.forEach((input, index) => {
    input.addEventListener('blur', () => {
        if(input.value !== "") {
            input.classList.remove('input-error');
        }
        else {

            input.classList.add('input-error');
            errorMessages[index].textContent = 'Este campo es obligatorio'
    
        }
    })
    input.addEventListener('input', (event) => {
        if(event.target.value !== ""){
            input.classList.remove('input-error');
            errorMessages[index].textContent = ''
        }
    });
})

