import { createRouter, createWebHistory } from 'vue-router';
import backend from './backend'
import notFound from "../views/backend/NotFound.vue";
import academic from "./academic";
import user from "./user";
import notice from "./notice";
import exam from "./exam";

const routes = [
    ...backend,
    ...academic,
    ...user,
    ...notice,
    ...exam

    // {
    //     path: '/:pathMatch(.*)*',
    //     name: 'GlobalNotFound',
    //     component: notFound
    // }

];
const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
