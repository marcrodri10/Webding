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
            document.getElementById('days').innerHTML = `<h2 class="time astralaga">${timeLeft.days}</h2><p class="astralaga">DÍAS</p>`;
            document.getElementById('hours').innerHTML = `<h2 class="time astralaga">${timeLeft.hours}</h2><p class="astralaga">HORAS</p>`;
            document.getElementById('minutes').innerHTML = `<h2 class="time astralaga">${timeLeft.minutes}</h2 class="astralaga"><p>MINUTOS</p>`;
            document.getElementById('seconds').innerHTML = `<h2 class="time astralaga">${timeLeft.seconds}</h2><p class="astralaga">SEGUNDOS</p>`;
        }
    };

    updateTimeLeft();
    const timerInterval = setInterval(updateTimeLeft, 1000);
};
CountdownTimer( WEDDING_DATE.date);
