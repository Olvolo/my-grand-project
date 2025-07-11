import './bootstrap';

import Alpine from 'alpinejs';
import EasyMDE from 'easymde';
import 'easymde/dist/easymde.min.css';

window.Alpine = Alpine;

Alpine.start();

// Инициализируем редактор для всех полей с классом .markdown-editor
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.markdown-editor').forEach((el) => {
        // Добавляем эту проверку, чтобы анализатор был уверен в типе элемента
        if (el instanceof HTMLElement) {
            new EasyMDE({
                element: el,
                spellChecker: false, // Отключаем проверку орфографии
                status: ["lines", "words"], // Показываем в статусной строке строки и слова
            });
        }
    });
});
