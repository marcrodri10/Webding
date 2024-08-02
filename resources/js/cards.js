import * as library from './functions';

document.addEventListener('DOMContentLoaded', function() {
    const galleryCards = document.querySelectorAll('.card');

    galleryCards.forEach(card => {
        let timer; // Variable para almacenar el temporizador

        card.addEventListener('mouseover', () => {
            clearTimeout(timer); // Limpiamos el temporizador si existe

            // Activamos la rotación después de un breve retraso
            timer = setTimeout(() => {
                library.rotateCard(card, 180);
            }, 50); // Puedes ajustar el retraso según sea necesario
        });

        card.addEventListener('mouseout', () => {
            clearTimeout(timer); // Limpiamos el temporizador si existe

            // Desactivamos la rotación después de un breve retraso
            timer = setTimeout(() => {
                library.rotateCard(card, 0);
            }, 50); // Puedes ajustar el retraso según sea necesario
        });
    });


});
