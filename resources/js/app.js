import router from "./router";
import App from "./layout/App.vue";
import store from "./store";

require("./bootstrap");

window.Vue = require("vue").default;

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    router,
    el: "#app",
    store,
    render: h => h(App)
});