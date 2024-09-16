export default [
    {
        path: "",
        name: "user",
        component: () => import("@/components/Interface.vue"),
        children: [
            {
                path: "/home",
                component: () => import("@/views/user/Home.vue")
            },
            {
                path: "/checkout",
                name: "checkout",
                component: () => import("@/views/user/Checkout.vue")
            },
            {
                path: "/shop",
                name: "shop",
                component: () => import("@/views/user/Shop.vue")
            },
            {
                path: "/profile",
                name: "user-profile",
                component: () => import("@/views/user/UserProfile.vue")
            },
            {
                path: "/product-details",
                name: "product-details",
                component: () => import("@/views/user/ProductDetails.vue")
            },
            {
                path: "/account",
                name: "account",
                component: () => import("@/views/user/Account.vue")
            }
        ]
    }
];
