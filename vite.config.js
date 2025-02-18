import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/css/icons.css",
                "resources/css/report.css",
                "resources/js/app.js",
                "resources/js/sidebar.js",
                "resources/js/selectAllPermissions.js",
            ],
            refresh: true,
        }),
    ],
});
