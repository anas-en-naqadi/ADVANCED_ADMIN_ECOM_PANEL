export default [
    {
        path: "",
        name: "user",
        component: () => import("@/components/Interface.vue"),
        children: [
            // {
            //     path: "/home",
            //     name:"home",
            //     component: () => import("@/views/user/Home.vue"),
            //     meta:{
            //         title:"Home - ALMOBARKA"
            //     }
            // },
            // {
            //     path: "/checkout",
            //     name: "checkout",
            //     component: () => import("@/views/user/Checkout.vue"),
            //     meta:{
            //         title:"Checkout - ALMOBARKA"
            //     }
            // },
            // {
            //     path: "/shop",
            //     name: "shop",
            //     component: () => import("@/views/user/Shop.vue"),
            //     meta:{
            //         title:"Products - ALMOBARKA"
            //     }
            // },
            // {
            //     path: "/profile",
            //     name: "user-profile",
            //     component: () => import("@/views/user/UserProfile.vue"),
            //     meta:{
            //         title:"Profile - ALMOBARKA"
            //     }
            // },
            // {
            //     path: "/product-details",
            //     name: "product-details",
            //     component: () => import("@/views/user/ProductDetails.vue"),
            //     meta:{
            //         title:"Product Details - ALMOBARKA"
            //     }
            // },
            // {
            //     path: "/account",
            //     name: "account",
            //     component: () => import("@/views/user/Account.vue"),
            //     meta:{
            //         title:"Account - ALMOBARKA"
            //     }
            // }
        ]
    }
];
