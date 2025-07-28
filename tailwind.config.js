import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    darkMode: 'class', // Enable dark mode with class strategy

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [
        forms, 
        typography,
        require('daisyui')
    ],

    daisyui: {
        themes: [
            {
                sampahgo_light: {
                    "primary": "#16a34a", // green-600 - tema utama sampah/lingkungan
                    "secondary": "#0ea5e9", // sky-500
                    "accent": "#f59e0b", // amber-500
                    "neutral": "#374151", // gray-700
                    "base-100": "#ffffff", // white
                    "base-200": "#f9fafb", // gray-50
                    "base-300": "#f3f4f6", // gray-100
                    "info": "#3b82f6", // blue-500
                    "success": "#10b981", // emerald-500
                    "warning": "#f59e0b", // amber-500
                    "error": "#ef4444", // red-500
                },
                sampahgo_dark: {
                    "primary": "#22c55e", // green-500
                    "secondary": "#38bdf8", // sky-400
                    "accent": "#fbbf24", // amber-400
                    "neutral": "#1f2937", // gray-800
                    "base-100": "#111827", // gray-900
                    "base-200": "#1f2937", // gray-800
                    "base-300": "#374151", // gray-700
                    "info": "#60a5fa", // blue-400
                    "success": "#34d399", // emerald-400
                    "warning": "#fbbf24", // amber-400
                    "error": "#f87171", // red-400
                }
            },
            "light",
            "dark"
        ],
        darkTheme: "sampahgo_dark",
        base: true,
        styled: true,
        utils: true,
        rtl: false,
        prefix: "",
        logs: true,
    },
};
