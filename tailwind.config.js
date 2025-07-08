import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                // Использование Instrument Sans в качестве основного sans-serif
                sans: ['Instrument Sans', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [
        forms,
        typography, // <-- ИЗМЕНЕНО: теперь используем переменную typography
    ],
};
