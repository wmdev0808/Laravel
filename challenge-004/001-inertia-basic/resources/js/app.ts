import "./bootstrap";
import "../css/app.css";

import { createApp, h, DefineComponent } from "vue";
import { Link, createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";
import Layout from "./Shared/Layout.vue";

const appName = import.meta.env.VITE_APP_NAME || "Laravel";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    // resolve: (name) =>
    //     resolvePageComponent(
    //         `./Pages/${name}.vue`,
    //         import.meta.glob<DefineComponent>("./Pages/**/*.vue")
    //     ),
    resolve: (name) => {
        const pages = import.meta.glob<DefineComponent>("./Pages/**/*.vue", {
            eager: true,
        });
        let page = pages[`./Pages/${name}.vue`];
        page.default.layout = page.default.layout || Layout;
        return page;
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .component("Link", Link)
            .mount(el);
    },
    progress: {
        color: "#4B5563",
    },
});
