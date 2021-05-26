import Vue from "vue";
import VueRouter from "vue-router";


import Home from "./pages/Home.vue"
import User from "./pages/User.vue"

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'active',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/user',
            name: 'user',
            component: User
        }
    ]
});

export default router;
