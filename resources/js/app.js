import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import { WEDDING_DATE } from './constants';

const CountdownTimer = ( targetDate ) => {
    const calculateTimeLeft = () => {
        const difference = new Date(targetDate) - new Date();
        let timeLeft = {};

        if (difference > 0) {
            timeLeft = {
                days: Math.floor(difference / (1000 * 60 * 60 * 24)),
                hours: Math.floor((difference / (1000 * 60 * 60)) % 24),
                minutes: Math.floor((difference / 1000 / 60) % 60),
                seconds: Math.floor((difference / 1000) % 60)
            };
        }

        return timeLeft;
    };

    const updateTimeLeft = () => {
        const timeLeft = calculateTimeLeft();

        if (Object.keys(timeLeft).length === 0) {
            clearInterval(timerInterval);
            document.getElementById('countdown').innerHTML = '<h2>La fecha objetivo ha pasado</h2>';
        } else {
            document.getElementById('days').innerHTML = `<h2 class="time">${timeLeft.days}</h2><p>DÍAS</p>`;
            document.getElementById('hours').innerHTML = `<h2 class="time">${timeLeft.hours}</h2><p>HORAS</p>`;
            document.getElementById('minutes').innerHTML = `<h2 class="time">${timeLeft.minutes}</h2><p>MINUTOS</p>`;
            document.getElementById('seconds').innerHTML = `<h2 class="time">${timeLeft.seconds}</h2><p>SEGUNDOS</p>`;
        }
    };

    updateTimeLeft();
    const timerInterval = setInterval(updateTimeLeft, 1000);
};
CountdownTimer( WEDDING_DATE.date);
