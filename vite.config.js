import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
                'resources/js/datatables.js',
                'resources/js/custom.js',

                'resources/sass/app.scss',
                'resources/sass/deferred.scss',
            ],
            refresh: true,
        }),
    ],
    // esbuild: {
    //     minifyIdentifiers: false
    // },
});
