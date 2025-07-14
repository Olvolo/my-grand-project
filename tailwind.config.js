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
            colors: {
                'brand-gold': '#facc15',      // Ярко-жёлтый (Солнце)
                'brand-blue': '#1e3a8a',      // Глубокий синий (Небо)
                'brand-cream': '#fffacc',     // Кремовый (Для текста)
                'brand-slate': '#1e293b',     // Графитовый (Для фона карточек)
                'welcome-card': '#4ca4b5',
                'welcome-card-text': '#bcc2be',
                'welcome-card-hover': '#61cbf2',
            },
        },
    },

    plugins: [
        forms,
        typography, // <-- ИЗМЕНЕНО: теперь используем переменную typography
    ],
};
