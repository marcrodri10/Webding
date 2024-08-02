const returnHomeCheckboxes = document.querySelectorAll('.return')
const personContainer = document.querySelector('#person-container');

personContainer.addEventListener('click', (event) => {
    if (event.target.className.includes('menu-input')) {

        const checkboxGroup = event.target.closest('.menu')
        const checkboxes = checkboxGroup.querySelectorAll('.menu-input')
        const menuError = checkboxGroup.querySelector('.error-message');

        menuError.textContent = "";
        checkboxes.forEach((checkbox) => {
            if(checkbox.classList.contains('input-error')) checkbox.classList.remove('input-error');
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

