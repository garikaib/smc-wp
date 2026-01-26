import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [react()],
    define: {
        'process.env.NODE_ENV': '"production"' // Defining NODE_ENV to avoid "process is not defined" error in browser
    },
    build: {
        outDir: 'assets/compiled',
        rollupOptions: {
            input: 'src/main.jsx',
            output: {
                entryFileNames: 'hero-slider.js',
                assetFileNames: 'hero-slider.[ext]',
            },
        },
        // Prevent empty files or hashes if possible for easier PHP enqueuing
        emptyOutDir: true,
    },
});
