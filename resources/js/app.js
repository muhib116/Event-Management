import './bootstrap';
import '../css/app.css';
import './assets/backend/styles/css/main.css';
import "vue-toastification/dist/index.css";
import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import axios from 'axios'
import Toast from "vue-toastification";
import { createAuth0 } from '@auth0/auth0-vue';


axios.defaults.baseURL = `${window.location.origin}/api/`;

const appName = window.document.getElementsByTagName('title')[0]?.innerText || '';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(Toast, {
                transition: "Vue-Toastification__bounce",
                maxToasts: 20,
                newestOnTop: true
            })
            .use(
                createAuth0({
                    domain: "dev-8xgi8q5dp4sbgcnn.us.auth0.com",
                    client_id: "lVcd5ENj2CbbKwVRv1dP4yF11F2cr4YH",
                    redirect_uri: window.location.origin
                })
            )
            .use(ZiggyVue, Ziggy)
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
