const returnHomeCheckboxes = document.querySelectorAll('.return')
const personContainer = document.querySelector('#person-container');

personContainer.addEventListener('click', (event) => {
    const inputForm = event.target.closest('.input-form');
    if (inputForm) {
        if (inputForm.querySelector('.error-message')) {
            event.target.closest('.input-form').querySelector('.error-message').textContent = "";
            event.target.closest('.input-form').querySelectorAll('input, textarea').forEach(input => {
                input.classList.remove('input-error');
            })
        }

    }
    if (event.target.className.includes('menu-input')) {

        const checkboxGroup = event.target.closest('.menu')
        const checkboxes = checkboxGroup.querySelectorAll('.menu-input')

        checkboxes.forEach((checkbox) => {
            if (checkbox.id !== event.target.id) checkbox.checked = false
        })
    }
    if (event.target.className.includes('return')) {
        const checkboxGroup = event.target.closest('.traslado')
        const checkboxes = checkboxGroup.querySelectorAll('.return')

        checkboxes.forEach((checkbox) => {
            if (checkbox.id !== event.target.id) checkbox.checked = false
        })
    }
})
/* returnHomeCheckboxes.forEach((checkbox) => {
    checkbox.addEventListener('change', (event) => {
        const id = event.target.id;
        returnHomeCheckboxes.forEach((checkbox) => {
            if(checkbox.id !== id) checkbox.checked = false
        })

    })
})

const menuCheckboxes = document.querySelectorAll('.menu-input');

menuCheckboxes.forEach((checkbox) => {
    checkbox.addEventListener('change', (event) => {
        const id = event.target.id;
        menuCheckboxes.forEach((checkbox) => {
            if(checkbox.id !== id) checkbox.checked = false
        })

    })

})
 */

