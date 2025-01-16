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
        path: "/emailVerification",
        name:"emailVerification",
        component: () => import("@/views/auth/EmailVerification.vue"),
        meta: {
            requiresAuth: false,
            title: "Email Verification",
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
    document.title = `${to.meta.title}`;
    if (to.meta.requiresAuth && !sessionStorage.getItem("TOKEN")) {
        next({ name: "login" });
    } else if (!sessionStorage.getItem("TOKEN") && to.meta.isGuest) {
        next({ name: "login" });
    } else if (sessionStorage.getItem("TOKEN") && to.name === "login") {
        if(store.state.user.is_admin)
        next({ name: "dashboard" });
    else
    next({name:"home"});
    } else {
        next();
    }
});

export default router;
