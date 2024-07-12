//const songInput = document.querySelector('#song');
const personContainer = document.querySelector('#person-container');
let interval;
//const songsDiv = document.querySelector('#songs');
personContainer.addEventListener('input', (event) => {
    if (event.target.id.includes("song")) {
        const songsDiv = event.target.nextElementSibling;
        const songInput = event.target;

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
        songsDiv.addEventListener('click', (event) => {
            songInput.value = event.target.textContent
            songInput.setAttribute('data-uri', event.target.getAttribute('data-uri'))
            songsDiv.innerHTML = ""

        })
    }
});
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



