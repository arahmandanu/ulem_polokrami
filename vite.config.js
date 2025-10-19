import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    // CRITICAL for WAMP subdirectory hosting (undangan-q2)
    base: '/undangan-q2/build/',

    plugins: [
        laravel({
            // Define ALL your entry points here (JS, SCSS, and CSS files)
            input: [
                'resources/js/app.js',
                'resources/scss/app.scss',
                'resources/css/common.css',
            ],
            refresh: true,
        }),
    ],

    // This build block is CRITICAL for forcing assets into correct subdirectories
    build: {
        // Essential to ensure font file paths are handled correctly
        rollupOptions: {
            output: {
                // Force all font files (woff, woff2, ttf, etc.) into the 'fonts' folder
                assetFileNames: (assetInfo) => {
                    const ext = assetInfo.name.split('.').pop();
                    if (['woff', 'woff2', 'ttf', 'otf'].includes(ext)) {
                        return `assets/fonts/[name]-[hash].${ext}`;
                    }
                    // Default naming for other assets (like images, CSS, etc.)
                    return `assets/[name]-[hash].${ext}`;
                },
            },
        },
    },

    // This is optional but helps with HMR in WAMP subdirectories
    // LOCAL
    server: {
        host: '0.0.0.0',
        hmr: {
            host: 'localhost',
        },
    },
});
