import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import MainLayout from "@/Layouts/MainLayout.vue";
import { ZiggyVue } from 'ziggy';

createInertiaApp({
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
        let page = pages[`./Pages/${name}.vue`];
        // set the default component for every page and mainlayout is the default component
        page.default.layout = page.default.layout || MainLayout;
        return page;
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);
    },
});
