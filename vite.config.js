import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({

            input: [
                'resources/css/user/app.css',
                'resources/css/user/icons.css',
                'resources/css/user/tailwind.css',
                'resources/js/app.js',
                'resources/css/admin/style.css',
                'resources/js/admin.js'

            ],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ]

});




