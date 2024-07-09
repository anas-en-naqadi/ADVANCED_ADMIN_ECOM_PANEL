import { createRouter, createWebHistory } from "vue-router";
import AdminRouter from "./AdminRouter";
import store from "../store";
const routes = [
    ...AdminRouter,
    {
        path: "/login",
        name: "login",
        meta:{
            title:"Login - ALMOBARKA"
        },
        component: () => import("@/views/auth/Login.vue"),
    },
    {
        path: "/register",
        name: "register",
        meta:{
            title:"Register - ALMOBARKA"
        },
        component: () => import("@/views/auth/Register.vue"),
    },
    {
        path: "/admin",
        name: "home",
        component: () => import("@/views/admin/Dashboard.vue"),
    },
    {
        path: "/:pathMatch(.*)",
        component:  () => import("@/components/NotFound.vue"),
        meta: {
          requiresAuth: false,
          title: "Page Not Found",
        },
      },
      {
        path: "/NOT-FOUND",
        component:  () => import("@/components/NotFound.vue"),
        name: "notFound",
        meta: {
          requiresAuth: false,
          title: "Page Not Found",
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
        next({ name: "home" });
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
