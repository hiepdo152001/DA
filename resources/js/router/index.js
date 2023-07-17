import { createRouter, createWebHistory } from "vue-router";
import admin from "./routes.js";

const routes = [...admin];

const router = createRouter({
    history: createWebHistory(),
    routes,
});
// router.beforeEach((to, from, next) => {
//     if (to.matched.some((record) => record.meta.requiresAuth)) {
//         if (jwtService.getToken()) {
//             next();
//         } else {
//             next("/");
//         }
//     } else {
//         next();
//     }
// });
export default router;
