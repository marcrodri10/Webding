import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/addPerson.js',
                'resources/js/cards.js',
                'resources/js/checkboxes.js',
                'resources/js/confirmAssistance.js',
                'resources/js/scroll.js',
                'resources/js/spotifyToken.js',
                'resources/js/constants/index.js',
                'resources/js/constants/weddingDate.js'
            ],
            refresh: true,
        }),
    ],
});
