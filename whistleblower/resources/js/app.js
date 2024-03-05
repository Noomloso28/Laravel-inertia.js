import './bootstrap';
import '../css/app.css';
import "@fortawesome/fontawesome-free/css/all.min.css";
import "@/assets/styles/tailwind.css";
import "@/assets/styles/easy-data-table.css";
import { createWebHistory, createRouter } from "vue-router";

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import { i18nVue } from 'laravel-vue-i18n';
import $ from 'jquery';
import 'lightbox2/dist/css/lightbox.min.css'; // Import the Lightbox2 CSS
import 'lightbox2/dist/js/lightbox.min.js';   // Import the Lightbox2 JS
import CKEditor from '@ckeditor/ckeditor5-vue';

import Multiselect from 'vue-multiselect';
import 'vue-multiselect/dist/vue-multiselect.css';


/*** routes **/
const routes = [];
const router = createRouter({
    history: createWebHistory(),
    routes,
});

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(i18nVue, {
              resolve: (lang) => import(`../../lang/${lang}.json`)
            })
            .use(ZiggyVue, Ziggy)
            .use(router)
            .use($)
            // .use(Multiselect)
            .component('multiselect', Multiselect)
            .use(CKEditor)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
