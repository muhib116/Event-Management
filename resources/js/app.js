import './bootstrap';
import '../css/app.css';
import './assets/backend/styles/css/main.css';
import "vue-toastification/dist/index.css";
import 'element-plus/dist/index.css'
import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import axios from 'axios'
import Toast from "vue-toastification";
import { createAuth0 } from '@auth0/auth0-vue';
import ElementPlus from 'element-plus'
import VueQrcodeReader from "vue3-qrcode-reader"; 
import CKEditor from '@ckeditor/ckeditor5-vue';
import { get } from 'lodash'
 
axios.defaults.baseURL = `${window.location.origin}/api/`;

const appName = window.document.getElementsByTagName('title')[0]?.innerText || '';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, app, props, plugin }) {
        let settings = props.initialPage.props.settings;
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(Toast, {
                transition: "Vue-Toastification__bounce",
                maxToasts: 20,
                newestOnTop: true
            })
            .use(ElementPlus)
            .use(VueQrcodeReader) 
            .use(CKEditor) 
            .use(
                createAuth0({
                    domain: `${get(settings, 'auth0_domain.value')}`,
                    client_id: `${get(settings, 'auth0_client_id.value')}`,
                    redirect_uri: window.location.origin
                })
            )
            .use(ZiggyVue, Ziggy)
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
