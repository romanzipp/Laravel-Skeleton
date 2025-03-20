import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { viteStaticCopy } from 'vite-plugin-static-copy';
import eslintPlugin from 'vite-plugin-eslint';
import tailwindcss from '@tailwindcss/vite';
import react from '@vitejs/plugin-react';  // Make sure this is here!

export default defineConfig({
    plugins: [
        tailwindcss(),
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.jsx',
            ],
            refresh: true,
        }),
        react(),
        viteStaticCopy({
            targets: [
                {
                    src: 'node_modules/@fontsource/inter/files',
                    dest: 'public/css/files',
                },
            ],
        }),
        eslintPlugin(),
    ],
    server: {
        cors: true,
    },
});
