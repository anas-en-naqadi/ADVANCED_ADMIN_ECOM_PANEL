export default [
    {
        path: "/pannel",
        redirect: "/pannel",
        component: () => import("@/components/Layout.vue"),
        meta: {
          requiresAuth: true,
        },
        children: [
            {
                path: "/admin/dashboard",
                name: "dashboard",
                meta:{
                    title:"Dashboard - Admin"
                },
                component: () => import("@/views/admin/Dashboard.vue"),
            },
            {
                path: "/admin/users",
                name: "users",
                meta:{
                    title:"Users - Admin"
                },
                component: () => import("@/views/admin/Users.vue"),
            },
            {
                path: "/admin/products",
                name: "products",
                meta:{
                    title:"Products - Admin"
                },
                component: () => import("@/views/admin/Products.vue"),
            },
            {
                path: "/admin/orders",
                name: "orders",
                meta:{
                    title:"Orders - Admin"
                },
                component: () => import("@/views/admin/order/Orders.vue"),
            },
            {
                path: "/admin/orders/:id(\\d+)",
                name: "order-details",
                component: () => import("@/views/admin/order/OrderDetails.vue"),
            },
            {
                path: "/admin/invoices",
                name: "invoices",
                meta:{
                    title:"Invoices - Admin"
                },
                component: () => import("@/views/admin/invoice/Invoices.vue"),
            },
            {
                path: "/admin/sells",
                name: "sells",
                component: () => import("@/views/admin/Sells.vue"),
            },
            {
                path: "/admin/profile",
                name: "profile",
                meta:{
                    title:"Profile - Admin"
                },
                component: () => import("@/views/admin/Profile.vue"),
            },

            {
                path: "/admin/invoice/show/:id(\\d+)",
                name: "invoice-details",
                component: () =>
                    import("@/views/admin/invoice/InvoiceDetails.vue"),
            },
            {
                path: "/admin/invoice/create",
                name: "action-invoice",
                component: () =>
                    import("@/views/admin/invoice/ActionInvoice.vue"),
            },
            {
                path: "/admin/invoice/:id(\\d+)/edit",
                name: "edit-invoice",
                component: () =>
                    import("@/views/admin/invoice/ActionInvoice.vue"),
            },
            {
                path: "/admin/categories",
                name: "categories",
                meta:{
                    title:"Categories - Admin"
                },
                component: () =>
                    import("@/views/admin/Categories.vue"),
            },{
                path: "/admin/blacklist",
                name: "blacklist",
                meta:{
                    title:"Blacklist - Admin"
                },
                component: () =>
                    import("@/views/admin/Blacklist.vue"),
            },
        ],
    },
];
