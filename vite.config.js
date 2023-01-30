import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'public/assets/vendors/mdi/css/materialdesignicons.min.css',
                'public/assets/vendors/css/vendor.bundle.base.css',
                'public/assets/css/style.css',

                'public/assets/vendors/js/vendor.bundle.base.js',
                'public/assets/js/off-canvas.js',
                'public/assets/js/hoverable-collapse.js',

                'public/assets/vendors/chart.js/Chart.min.js',
                'public/assets/js/dashboard.js'
            ],
            refresh: true,
        }),
    ],
});
