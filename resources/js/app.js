import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    progress: {
        color: '#4B5563'
    },
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .directive('clickOutside', {
                mounted(el, binding) {
                    el.__ClickOutsideHandler__ = (event) => {
                        if (!(el === event.target
                            || el.contains(event.target)
                            || event.target.dataset.showTrigger === el.id
                            || event.target.parentNode.dataset.showTrigger === el.id)) {

                            binding.value()
                        }
                    }
                    document.body.addEventListener('click', el.__ClickOutsideHandler__)
                },
                unmounted(el) {
                    document.body.removeEventListener('click', el.__ClickOutsideHandler__)
                }
            })
            .mount(el);
    },
});