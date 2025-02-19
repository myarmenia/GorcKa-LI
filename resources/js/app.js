
import '../../public/assets/user/libs/choices.js/public/assets/styles/choices.min.css';
import '../../public/assets/user/libs/swiper/swiper-bundle.min.css';

import '../css/user/app.css';
import '../css/user/icons.css';
import '../css/user/tailwind.css';

// import '../../public/assets/user/libs/@popperjs/core/umd/popper.min';
import '../../public/assets/user/libs/simplebar/simplebar.min';
import './modules/user/switcher.js';
import '../../public/assets/user/libs/choices.js/public/assets/scripts/choices.min';

// import './modules/job-list.init.js';
import './modules/user/dropdown&modal.init.js';

import '../../public/assets/user/libs/swiper/swiper-bundle.min';
import './modules/user/swiper.init.js';


// import './bootstrap';

import './modules/user/nav&tabs.js';


import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createApp, h } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import i18n from './i18n';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/User/${name}.vue`,
            import.meta.glob('./Pages/User/**/*.vue'),
        ),
    setup({ el, App, props, plugin }) {

          // Получаем локаль из Laravel
          const locale = props.initialPage.props.locale || 'am';

          // Устанавливаем локаль в i18n
          i18n.global.locale.value = locale;

        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(i18n) // Добавляем локализацию
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});




