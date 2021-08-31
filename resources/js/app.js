require('./bootstrap');

import { createApp, h, VueElement } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { Dialog, DialogOverlay, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue';
import { ExclamationIcon } from '@vue-hero-icons/outline';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';
createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(Dialog)
            .use(DialogOverlay)
            .use(DialogTitle)
            .use(TransitionChild)
            .use(TransitionRoot)
            .use(ExclamationIcon)
            .mixin({ methods: { route } })
            .mount(el);
    },
});


InertiaProgress.init({ color: '#4B5563' });
