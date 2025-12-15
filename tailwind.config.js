import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                cyber: {
                    bg: '#0f0f1a',
                    alt: '#1a1a2e',
                    primary: '#d946ef', // Fuchsia
                    secondary: '#8b5cf6', // Violet
                    text: '#e2e8f0',
                }
            }
        },
    },

    plugins: [forms],
};
