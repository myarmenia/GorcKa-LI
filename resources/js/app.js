
// import '../../public/assets/user/libs/choices.js/public/assets/styles/choices.min.css';
import '../../public/assets/user/libs/swiper/swiper-bundle.min.css';

import '../css/user/app.css';
import '../css/user/icons.css';
import '../css/user/tailwind.css';

// import '../../public/assets/user/libs/@popperjs/core/umd/popper.min';
import '../../public/assets/user/libs/simplebar/simplebar.min';
import './modules/user/switcher.js';
// import '../../public/assets/user/libs/choices.js/public/assets/scripts/choices.min';

// import './modules/user/job-list.init';
import './modules/user/dropdown&modal.init.js';

import '../../public/assets/user/libs/swiper/swiper-bundle.min';
import './modules/user/swiper.init.js';
import '../../node_modules/preline/dist/preline.js'

// import './bootstrap';

// import './modules/user/nav&tabs.js';


import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createApp, h } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/User/${name}.vue`,
            import.meta.glob('./Pages/User/**/*.vue'),
        ),
    setup({ el, App, props, plugin }) {

        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});




