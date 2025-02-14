import { createI18n } from 'vue-i18n';

// Импортируем JSON-файлы с переводами
import am from './lang/am.json';
import ru from './lang/ru.json';
import en from './lang/en.json';

const messages = { en, ru,am };

const i18n = createI18n({
    legacy: false, // Используем Composition API
    locale: localStorage.getItem('locale') || 'en', // Берем язык из localStorage
    fallbackLocale: 'en',
    messages
});

export default i18n;
