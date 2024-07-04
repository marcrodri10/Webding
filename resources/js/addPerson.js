const personContainer = document.querySelector('#person-container');
const addPersonBtn = document.querySelector('#add-person');
let countPerson = 1;

addPersonBtn.addEventListener('click', () => {
    const personGroup = document.querySelector('.person-group');
    const newPersonGroup = personGroup.cloneNode(true);
    const inputs = newPersonGroup.querySelectorAll('input[type=text], textarea');

    const checkboxes = newPersonGroup.querySelectorAll('input[type="checkbox"]');
    inputs.forEach((input) => {
        input.value = "";
        input.removeAttribute('data-uri');
        input.id = input.id.replace(/\d+$/, '') + (countPerson + 1)
    });
    checkboxes.forEach((checkbox) => {
        checkbox.checked = false;
        checkbox.id = checkbox.id.replace(/\d+$/, '') + (countPerson + 1)
        checkbox.nextElementSibling.setAttribute('for', checkbox.id.replace(/\d+$/, '') + (countPerson + 1))
    })
    newPersonGroup.classList.add('mt-10');
    const removePerson = document.createElement('button');
    removePerson.innerHTML += `<button id="remove-person" class="flex items-center px-4 py-2 bg-red-500 text-white font-bold rounded hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50" type="button">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Eliminar
                </button>`
    newPersonGroup.appendChild(removePerson);
    personContainer.appendChild(newPersonGroup);

    removePerson.addEventListener('click', (event) => {
        event.target.closest('.person-group').remove();
    })
})


