import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import laravel from 'laravel-vite-plugin'

export default defineConfig({
    server: {
        host: true,         // ← This exposes to Docker host
        port: 5173,
        strictPort: true,   // Avoid random ports
        hmr: {
            host: 'localhost', // ← Must match your browser's domain
        },
    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        vue(),
    ],
})
