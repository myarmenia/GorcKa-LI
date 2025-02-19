import { createI18n } from 'vue-i18n';



const messages = {};
const routeName = window.location.pathname.split('/').pop();

console.log(routeName, ' mmmmmmmmmmm')
// const loadMessages = async (locale) => {
//     const messages = {
//         register: await import(`./lang/${locale}/register.json`),
//         login: await import(`./lang/${locale}/login.json`)
//     };
//     return messages;
// };

const i18n = createI18n({
    legacy: false,
    locale: 'am',
    fallbackLocale: 'en',
    messages: {} // Загружаем динамически
});


export default i18n;
