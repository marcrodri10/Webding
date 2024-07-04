document.addEventListener('DOMContentLoaded', function() {
    const galleryCards = document.querySelectorAll('.card');

    galleryCards.forEach(card => {
        let timer; // Variable para almacenar el temporizador

        card.addEventListener('mouseover', () => {
            clearTimeout(timer); // Limpiamos el temporizador si existe

            // Activamos la rotación después de un breve retraso
            timer = setTimeout(() => {
                rotateCard(card, 180);
            }, 50); // Puedes ajustar el retraso según sea necesario
        });

        card.addEventListener('mouseout', () => {
            clearTimeout(timer); // Limpiamos el temporizador si existe

            // Desactivamos la rotación después de un breve retraso
            timer = setTimeout(() => {
                rotateCard(card, 0);
            }, 50); // Puedes ajustar el retraso según sea necesario
        });
    });

    function rotateCard(card, rotation) {
        card.style.transform = `rotateY(${rotation}deg)`;
    }
});
