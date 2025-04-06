import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/app.js',
                'resources/css/Login.css',
                'resources/css/registro.css',
                'resources/js/registro.js',
                'resources/css/residente/residente.css',
                'resources/js/residente/residente.js'
            ],
            refresh: true,
        }),
    ],
});