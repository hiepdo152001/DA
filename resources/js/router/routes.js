const route = [
    {
        path: "/",
        component: () => import("../layouts/auth/viewWeb.vue"),
    },
    {
        path: "/home",
        component: () => import("../layouts/page/home/home.vue"),
    },
];

export default route;
