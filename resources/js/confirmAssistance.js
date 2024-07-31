const confirmForm = document.querySelector('#confirm');
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


confirmForm.addEventListener('submit', async (event) => {
    const songsUri = [];
    event.preventDefault();
    const totalGuests = confirmForm.querySelectorAll('.person-group').length;

    const formData = new FormData(confirmForm);

    const songs = document.querySelectorAll('input[id*="song"]');

    songs.forEach((song) => {
        if (song.hasAttribute('data-uri')) songsUri.push(song.getAttribute('data-uri'));
    })

    songsUri.forEach((song) => {
        formData.append("uri[]    ", song);
    });

    formData.append("totalGuests", totalGuests);

    try {
        const response = await fetch('/confirm-assistance', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
            },
            body: formData
        });

        const data = await response.json();

        const messageContainer = document.getElementById('message-container');
        messageContainer.innerHTML = ''; // Limpiar mensajes previos

        if (data.response) {
            const response = data.response;

            let message = "";
            let allErrors = new Set();
            if (response.error) {
                console.log(response.error);
                response.error.forEach((formError) => {
                    for (let error in formError) {
                        const personContainer = confirmForm.querySelector('#person-container');
                        const formGroups = personContainer.children[formError[error].guest].querySelectorAll('.input-form');

                        formGroups[formError[error].position].querySelector('.error-message').textContent = formError[error].error;
                        const formGroupsInputs = formGroups[formError[error].position].querySelectorAll('input, textarea');
                        formGroupsInputs.forEach(input => {
                            input.classList.add('input-error')
                        })
                        allErrors.add(formError[error].error)

                    }
                    message = `Error al enviar el formulario:<br> ${Array.from(allErrors).join('<br>')}`;;
                })

            }
            else message += response.success;

            messageContainer.innerHTML = generateToast(message, data.status);

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

            if (data.status === 200) {
                confirmForm.reset();
                const errorInputs = document.querySelectorAll('.input-error');
                const errorMessage = document.querySelectorAll('.error-message');
                errorInputs.forEach(input => {
                    input.classList.remove('input-error');
                })
                errorMessage.forEach(message => {
                    message.textContent = "";
                })
            }
        }

    } catch (error) {
        console.error('Error:', error);
    }

});

function generateToast(message, responseCode) {
    if (responseCode === 200) {
        return `<div id="toast-success" class="toast fixed top-4 right-4 z-50 flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow-lg dark:text-gray-400 dark:bg-gray-800">
    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
        </svg>
        <span class="sr-only">Check icon</span>
    </div>
    <div class="ml-3 text-sm font-normal"><p>${message}</p></div>

</div>`;
    } else {
        return `<div id="toast-danger" class="toast fixed top-4 right-4 z-50 flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow-lg dark:text-gray-400 dark:bg-gray-800">
    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
        </svg>
        <span class="sr-only">Error icon</span>
    </div>
    <div class="ml-3 text-sm font-normal">${message}</div>

</div>`;
    }
}
