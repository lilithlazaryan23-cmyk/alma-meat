import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/main.css',
                'resources/css/products.css',
                'resources/css/cart.css',
                'resources/css/atenk.css',
                'resources/css/luma.css',
                'resources/css/marila.css',
                'resources/css/recipes.css',
                'resources/css/register.css',
                'resources/css/admin.css',
                'resources/css/polish.css',
                'resources/js/main.js',
                'resources/js/products.js',
                'resources/js/cart.js',
                'resources/js/atenk.js',
                'resources/js/luma.js',
                'resources/js/marila.js',
                'resources/js/recipes.js',
                'resources/js/register.js',
            ],
            refresh: true,
        }),
    ],
});
