import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import typography from "@tailwindcss/typography";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/laravel/jetstream/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],
    darkMode: true,
    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            borderWidth: {
                medium: "0.094rem",
            },
            fontSize: {
                title: ["32px", "38px"],
            },
            colors: {
                "yellow-primary": "#FBEDCD",
                "yellow-secondary": "#FDF9ED",
                "brown-primary": "#4A1D1F",
                "brown-secondary": "#381618",
                "font-primary": "#272727",
                border: "#555555",
                "yellow-btn": "#dbc537",
                "font-btn": "#382417",
                footer: "#fc9f67",
            },
            height: {
                500: "500px",
            },
            boxShadow: {
                card: "0.5px 0.5px 2.5px 0.5px rgba(0, 0, 0, 0.2)",
                "card-hover": "1px 1px 2.5px 1px rgba(0, 0, 0, 0.4)",
            },
        },
    },

    plugins: [forms, typography],
};
