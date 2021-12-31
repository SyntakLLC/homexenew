require('./bootstrap');

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { asset } from '@codinglabs/laravel-asset';
import Maska from 'maska';
import VCalendar from 'v-calendar';

const appName =
    window.document.getElementsByTagName('title')[0]?.innerText || 'Homexe';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(Maska)
            .use(VCalendar, {
                componentPrefix: 'vc',
            })
            .mixin({ methods: { route, asset } })
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
