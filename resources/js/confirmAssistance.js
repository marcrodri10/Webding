import * as library from './functions';

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

        const messageContainer = document.querySelector('#message-container');
        messageContainer.innerHTML = ''; // Limpiar mensajes previos

        if (data.response) {
            const response = data.response;
            
            let message = "";
            let allErrors = new Set();
            if (response.error) {
                
                if(response.status === 405) message = response.error;
                else if (response.status === 404) {
                    response.error.forEach((formError) => {
                        for (let error in formError) {
                            const personContainer = confirmForm.querySelector('#person-container');
                            const formGroups = personContainer.children[formError[error].guest].querySelectorAll('.input-form');

                            formGroups[formError[error].position].querySelector('.error-message').textContent = formError[error].error;
                            const formGroupsInputs = formGroups[formError[error].position].querySelectorAll('input, textarea, #songs');
                            formGroupsInputs.forEach(input => {
                                input.classList.add('input-error')
                            })
                            allErrors.add(formError[error].error)

                        }
                        message = `Error al enviar el formulario:<br> ${Array.from(allErrors).join('<br>')}`;;
                    })
                }

                messageContainer.innerHTML = library.generateErrorToast(message);
            }
            else {
                message += response.success;
                messageContainer.innerHTML = library.generateSuccessToast(message);
            }

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

            if (response.status === 200) {
                confirmForm.reset();
                const allPersonGroup = document.querySelectorAll('.person-group');
                allPersonGroup.forEach((group, index) => {
                    if(index !== 0) group.remove();
                })
                const removePersonBtn = document.querySelector('#remove-person');
                removePersonBtn.classList.add("hidden");
                /* const errorInputs = document.querySelectorAll('.input-error');
                const errorMessage = document.querySelectorAll('.error-message');
                errorInputs.forEach(input => {
                    input.classList.remove('input-error');
                })
                errorMessage.forEach(message => {
                    message.textContent = "";
                }) */
            }
        }

    } catch (error) {
        console.error('Error:', error);
    }

});
