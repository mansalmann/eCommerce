import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import preline from 'preline/plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ], 
    optimizeDeps: {
    include: ['preline']
  }
});
