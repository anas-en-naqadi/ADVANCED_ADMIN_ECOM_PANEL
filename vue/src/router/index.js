import { createRouter, createWebHistory } from "vue-router";
import AdminRouter from "./AdminRouter";
import store from "../store";
const routes = [
    ...AdminRouter,
    {
        path: "/login",
        name: "login",
        meta: {
            title: "Login - ALMOBARKA",
        },
        component: () => import("@/views/auth/Login.vue"),
    },

    {
        path: "/:pathMatch(.*)",
        component: () => import("@/components/NotFound.vue"),
        meta: {
            requiresAuth: false,
            title: "404 Not Found",
        },
    },

    {
        path: "/notFound",
        component: () => import("@/components/NotFound.vue"),
        name: "notFound",
        meta: {
            requiresAuth: false,
            title: "404 Not Found",
        },
    },
    {
        path: "/serverError",
        component: () => import("@/components/ServerError.vue"),
        name: "serverError",
        meta: {
            requiresAuth: false,
            title: "500 Server Error",
        },
    },
];
const router = createRouter({
    history: createWebHistory(),
    routes,
});
router.beforeEach((to, from, next) => {
    const token = sessionStorage.getItem("TOKEN");
    const isAdmin = store.state.user.is_admin;

    document.title = to.meta.title;

    if (to.meta.requiresAuth && !token) {
        return next({ name: "login" });
    }

    if (to.meta.isGuest && token) {
        return next({ name: "dashboard" });
    }

    if (token && to.name === "login" && isAdmin) {
        return next({ name: "dashboard" });
    }

    next();
});

export default router;
