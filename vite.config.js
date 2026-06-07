import { defineConfig } from 'vite';

export default defineConfig({
  build: {
    outDir: 'public/build',
    manifest: true,
    rollupOptions: {
      input: 'resources/js/app.js',
    },
  },
});
