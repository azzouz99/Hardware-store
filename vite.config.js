import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/app.js',
                'resources/js/appAdmin.js',
                'resources/css/admin.css',
            ],
            refresh: true,
        }),
    ],
    optimizeDeps: {
        exclude: ['alpinejs'], // Prevent double-bundling
    },
});