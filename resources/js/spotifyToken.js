import * as library from './functions';
//const songInput = document.querySelector('#song');
const personContainer = document.querySelector('#person-container');
let interval;
//const songsDiv = document.querySelector('#songs');
personContainer.addEventListener('input', (event) => {
    if (event.target.id.includes("song")) {
        
        const songsDiv = event.target.parentElement.parentElement.children[3];

        const songInput = event.target;

        clearTimeout(interval);
        songsDiv.innerHTML = "";

        const inputValue = event.target.value.trim(); // Obtener valor del input sin espacios en blanco al inicio y al final

        if (inputValue !== "") {
            const spinner = document.querySelector("#spinner")
            spinner.classList.remove("hidden")

            interval = setTimeout(async () => {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const songs = await getSongs(inputValue, csrfToken);

                const playlistSongs = await getPlaylistSongs(csrfToken);
                if(songs) spinner.classList.add("hidden")
                // Mostrar solo las primeras 6 canciones
                const songsToShow = songs.tracks.items.slice(0, 6);

                for (let song of songsToShow) {
                    if (playlistSongs.includes(song.uri)) {
                        songsDiv.innerHTML += `<div class="flex justify-between gap-5 song-name in-playlist">
                        <p data-uri=${song.uri}>${song.name} - ${song.artists[0].name} <span>(Ya en playlist)</span></p>
                        <img src="${song.album.images[2].url}" class="song-image"/>
                        </div>`;
                    }
                    else {
                        songsDiv.innerHTML += `<div class="flex justify-between gap-5 song-name not-playlist">
                        <p data-uri=${song.uri}>${song.name} - ${song.artists[0].name}</p>
                        <img src="${song.album.images[2].url}" class="song-image"/>
                        </div>`;
                    }

                }
                songsDiv.classList.add("border");
            }, 700);
        }
        else {
            songsDiv.classList.remove("border")
            songInput.removeAttribute("data-uri");
            if (songsDiv.classList.contains("input-error")) songsDiv.classList.remove("input-error")
            if (songInput.classList.contains('input-error')) songInput.classList.remove("input-error")
            songsDiv.nextElementSibling.querySelector('.error-message').innerHTML = "";
        }

    }
});
personContainer.addEventListener('click', (event) => {
    const songsDiv = event.target.closest('#songs');
    if (songsDiv) {
        const songInput = event.target.closest('.cancion').querySelector('.form-input');
        if (event.target.closest(".in-playlist")) {
            const messageContainer = document.querySelector('#message-container');
            messageContainer.innerHTML = library.generateErrorToast('Esta canción ya se encuentra en nuestra playlist. Escoge otra');

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
        }
        else {
            songInput.value = event.target.textContent.trim()
            if (songsDiv.classList.contains("input-error")) songsDiv.classList.remove("input-error")
            if (songInput.classList.contains('input-error')) songInput.classList.remove("input-error")
            songsDiv.nextElementSibling.querySelector('.error-message').innerHTML = "";
            songInput.setAttribute('data-uri', event.target.getAttribute('data-uri'))
            songsDiv.innerHTML = ""
            songsDiv.classList.remove("border")
        }
    }




})
/* songInput.addEventListener('input', async (event) => {
    clearTimeout(interval);
    songsDiv.innerHTML = "";

    const inputValue = event.target.value.trim(); // Obtener valor del input sin espacios en blanco al inicio y al final

    if (inputValue !== "") {
        interval = setTimeout(async () => {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const songs = await getSongs(inputValue, csrfToken);
            // Mostrar solo las primeras 6 canciones
            const songsToShow = songs.tracks.items.slice(0, 6);

            for (let song of songsToShow) {
                songsDiv.innerHTML += `<div class="song-name">
                    <p data-uri=${song.uri}>${song.name} - ${song.artists[0].name}</p>
                </div>`;
            }
        }, 600);
    }
});
 */
async function getSongs(input, csrfToken) {
    let song = new FormData();
    song.append("song", input);

    const response = await fetch('/songs', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken, // Enviar el token CSRF en la cabecera
        },
        body: song
    })

    if (!response.ok) {
        throw new Error('Network response was not ok');
    }
    return response.json();
}
async function getPlaylistSongs(csrfToken) {
    const response = await fetch('/playlist-songs', {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': csrfToken, // Enviar el token CSRF en la cabecera
        }
    })

    if (!response.ok) {
        throw new Error('Network response was not ok');
    }
    return response.json();
}



