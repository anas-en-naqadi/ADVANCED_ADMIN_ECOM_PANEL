    <!-- component -->
    <style>
    /* Compiled dark classes from Tailwind */
    .dark .dark\:divide-gray-700 > :not([hidden]) ~ :not([hidden]) {
    border-color: rgba(55, 65, 81);
    }
    .dark .dark\:bg-gray-50 {
    background-color: rgba(249, 250, 251);
    }
    .dark .dark\:bg-gray-100 {
    background-color: rgba(243, 244, 246);
    }
    .dark .dark\:bg-gray-600 {
    background-color: rgba(75, 85, 99);
    }
    .dark .dark\:bg-gray-700 {
    background-color: rgba(55, 65, 81);
    }
    .dark .dark\:bg-gray-800 {
    background-color: rgba(31, 41, 55);
    }
    .dark .dark\:bg-gray-900 {
    background-color: rgba(17, 24, 39);
    }
    .dark .dark\:bg-red-700 {
    background-color: rgba(185, 28, 28);
    }
    .dark .dark\:bg-green-700 {
    background-color: rgba(4, 120, 87);
    }
    .dark .dark\:hover\:bg-gray-200:hover {
    background-color: rgba(229, 231, 235);
    }
    .dark .dark\:hover\:bg-gray-600:hover {
    background-color: rgba(75, 85, 99);
    }
    .dark .dark\:hover\:bg-gray-700:hover {
    background-color: rgba(55, 65, 81);
    }
    .dark .dark\:hover\:bg-gray-900:hover {
    background-color: rgba(17, 24, 39);
    }
    .dark .dark\:border-gray-100 {
    border-color: rgba(243, 244, 246);
    }
    .dark .dark\:border-gray-400 {
    border-color: rgba(156, 163, 175);
    }
    .dark .dark\:border-gray-500 {
    border-color: rgba(107, 114, 128);
    }
    .dark .dark\:border-gray-600 {
    border-color: rgba(75, 85, 99);
    }
    .dark .dark\:border-gray-700 {
    border-color: rgba(55, 65, 81);
    }
    .dark .dark\:border-gray-900 {
    border-color: rgba(17, 24, 39);
    }
    .dark .dark\:hover\:border-gray-800:hover {
    border-color: rgba(31, 41, 55);
    }
    .dark .dark\:text-white {
    color: rgba(255, 255, 255);
    }
    .dark .dark\:text-gray-50 {
    color: rgba(249, 250, 251);
    }
    .dark .dark\:text-gray-100 {
    color: rgba(243, 244, 246);
    }
    .dark .dark\:text-gray-200 {
    color: rgba(229, 231, 235);
    }
    .dark .dark\:text-gray-400 {
    color: rgba(156, 163, 175);
    }
    .dark .dark\:text-gray-500 {
    color: rgba(107, 114, 128);
    }
    .dark .dark\:text-gray-700 {
    color: rgba(55, 65, 81);
    }
    .dark .dark\:text-gray-800 {
    color: rgba(31, 41, 55);
    }
    .dark .dark\:text-red-100 {
    color: rgba(254, 226, 226);
    }
    .dark .dark\:text-green-100 {
    color: rgba(209, 250, 229);
    }
    .dark .dark\:text-blue-400 {
    color: rgba(96, 165, 250);
    }
    .dark .group:hover .dark\:group-hover\:text-gray-500 {
    color: rgba(107, 114, 128);
    }
    .dark .group:focus .dark\:group-focus\:text-gray-700 {
    color: rgba(55, 65, 81);
    }
    .dark .dark\:hover\:text-gray-100:hover {
    color: rgba(243, 244, 246);
    }
    .dark .dark\:hover\:text-blue-500:hover {
    color: rgba(59, 130, 246);
    }

    /* Custom style */
    .header-right {
    width: calc(100% - 3.5rem);
    }
    .sidebar:hover {
    width: 16rem;
    }
    @media only screen and (max-width: 800px) {
    .header-right {
        width: calc(100% - 16rem);
    }

    #toast-notification {
        margin-right:25%;
        width: 50%;
    }
    #notif{
        width:22px;
    }
    #counter {
        width: 13px;
        height: 13px;
        padding-bottom:2px;
        font-size:10px;
        top: 8px;
        right: 24px;
        margin-right: -13px;
    }
    }
    @media only screen and (max-width: 450px) {
    #toast-notification {
        margin-right: 53%;
        width: 80%;
    }
    #counter {
        width: 18px;
        height: 18px;
        top: 5px;
        right: 5px;
        margin-right: -13px;
    }
    #notif {
        margin-right: -13px;
    }
    #notif-box {
        margin-right: -23px;
    }
    #logo {
        display: none;
    }
    #brand {
        margin-top: 4px;
    }
    }
    </style>


<template>
    <!-- component -->
    <!-- This is an example component -->
    <div>
        <nav class="bg-white border-b border-gray-200 fixed z-30 w-full">
            <div class="px-3 py-1 shadow-md lg:px-5 lg:pl-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center justify-start">
                        <button id="toggleSidebarMobile" aria-expanded="true" aria-controls="sidebar"
                            class="lg:hidden mr-2 text-gray-600 hover:text-gray-900 cursor-pointer p-2 hover:bg-gray-100 focus:bg-gray-100 focus:ring-2 focus:ring-gray-100 rounded"
                            @click="toggle">
                            <svg id="toggleSidebarMobileHamburger" class="w-6 h-6" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <svg id="toggleSidebarMobileClose" class="w-6 h-6 hidden" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>

                        <a href="#" class="text-xl font-bold flex items-center lg:ml-2.5">
                            <img id="logo" src="@/assets/images/olive.png" class="h-16 w-16 mr-2" alt="Olive Logo" />
                            <span id="brand" class="self-center whitespace-nowrap">ALMOBARKA</span>
                        </a>
                    </div>

                    <div class="flex items-center gap-2">
                        <div class="flex items-center">
                            <div class="flex flex-col items-center gap-44">
                                <div class="">
                                    <button @click="
                      notifiable = !notifiable;
                      setRead_at();
                    " type="button" class="relative inline-flex items-center md:mr-3 md:w-12 p-3 mr-5 mt-2 text-sm font-medium text-center text-black rounded-lg hover:bg-blue-200 focus:ring-1 focus:outline-none focus:ring-blue-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" id="notif"
                                            class="xl:w-7 xl:h-7 h-6 w-6 text-black">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                                        </svg>

                                        <span class="sr-only">Notifications</span>
                                        <div id="counter"
                                            class="absolute inline-flex items-center justify-center md:w-4 md:h-4 w-6 h-6 text-xs font-bold text-white bg-red-500 border-1 text-center border-black rounded-full top-2 end-1.5 ">
                                            {{ counter }}
                                        </div>
                                    </button>
                                </div>
                                <div v-if="notifiable" id="toast-notification"
                                    class="absolute top-24 z-50 md:w-88 p-4 text-gray-900 bg-white rounded-lg shadow-lg border-gray-500 white:bg-gray-800 white:text-gray-300"
                                    role="alert">
                                    <div class="flex items-center mb-3 z-50">
                                        <span class="mb-1 text-md font-semibold text-gray-900 white:text-white">New
                                            notifications</span>
                                        <button type="button" id="notif-box" @click="notifiable = !notifiable"
                                            class="ms-auto -mx-1.5 -my-1.5 bg-white justify-center items-center flex-shrink-0 text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 white:text-gray-500 white:hover:text-white white:bg-gray-800 white:hover:bg-gray-700"
                                            data-dismiss-target="#toast-notification" aria-label="Close">
                                            <span class="sr-only">Close</span>
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                        </button>
                                    </div>
                                    <hr class="mb-2 text-gray-900 font-bold w-[20rem] -ml-4" />
                                    <div class="flex items-center flex-col md:h-52 overflow-scroll"
                                        v-if="notifications.length">
                                        <div class="ms-3 text-sm font-normal m-1.5"
                                            v-for="(notification, index) in notifications" :key="index">
                                            <div v-if="notification.data.name"
                                                @click="redirectTo(notification.data.url)"
                                                class="text-sm text-gray-700 font-semibold white:text-white">
                                                l'utilisateur
                                                <span class="text-red-600">{{
                                                    notification.data.name
                                                    }}</span>
                                                a passer une commande avec id: {{notification.data.order_id}}!!
                                            </div>
                                            <div v-else @click="redirectTo(notification.data.url)"
                                                class="text-sm text-gray-700 font-semibold white:text-white">
                                                Le stock du produit
                                                <span class="font-bold text-red-500">{{
                                                    (notification.data.product_name).toUpperCase()
                                                    }}</span>
                                                est actuellement inférieur à 10. Merci de vérifier.
                                            </div>

                                            <span class="text-xs font-medium text-blue-600 white:text-blue-500">
                                                {{ common.timeSince(notification.created_at) }}
                                            </span>

                                            <hr class="mt-2" />
                                        </div>
                                    </div>

                                    <div v-else class="text-gray-600 text-center text-sm font-semibold">
                                        No Notifications !!
                                    </div>
                                    <div v-if="notifications.length" @click="deleteAllNotifiable()"
                                        class="text-gray-600 text-center font-bold text-sm cursor-pointer hover:underline p-1">
                                        Clear All
                                    </div>
                                </div>
                            </div>
                        </div>
                        <router-link :to="{ name: 'admin-profile' }">
                            <div class="flex cursor-pointer">
                                <div v-if="Object.keys(user).length"
                                    class="hidden xl:flex lg:flex md:flex flex-col gap-2 md:mr-1 mr-2 p-2 justify-center">
                                    <div class="text-base font-medium leading-none text-blue-900">
                                        {{ user.name }}
                                    </div>
                                    <div class="text-sm font-medium leading-none text-blue-900">
                                        {{ user.email }}
                                    </div>
                                </div>
                                <div v-else
                                    class="hidden xl:flex lg:flex md:flex flex-col gap-2 md:mr-1 mr-2 p-2 justify-center">
                                    <div class="text-base font-medium leading-none text-blue-900 t">
                                        <Skeleton width="5rem" />
                                    </div>
                                    <div class="text-sm font-medium leading-none text-blue-900">
                                        <Skeleton width="10rem" />
                                    </div>
                                </div>

                                <avatar :fullname="'Anas Ennaqadi'" :size="50"></avatar>
                            </div>
                        </router-link>
                    </div>
                </div>
            </div>
        </nav>
        <div class="flex overflow-hidden bg-white pt-16">
            <aside id="sidebar"
                class="fixed z-20 hidden  h-full top-0 left-0 pt-14 flex lg:flex flex-shrink-0 flex-col w-64 transition-width duration-75"
                aria-label="Sidebar">
                <div class="relative flex-1 flex shadow-md h-full flex-col min-h-0 border-r border-gray-200 pt-0">
                    <div class="flex-1  flex flex-col pt-5 pb-4 overflow-y-auto">
                        <div class="flex-1 px-3  bg-white divide-y space-y-1">
                            <ul class="space-y-2 pb-2">
                                <li>
                                    <router-link :to="{ name: 'dashboard' }" :class="{
                                        'text-white bg-stone-500': route.name === 'dashboard',
                                        'text-base text-gray-900 font-normal rounded-lg mt-2 hover:bg-gray-100 hover:text-gray-900 group transition duration-75 flex items-center p-2': true
                                    }">
                                        <i class="fas fa-tachometer-alt"></i>

                                        <span class="ml-3">Dashboard</span>
                                    </router-link>
                                </li>

                                <li>
                                    <router-link :to="{ name: 'users' }" :class="{
                                        'text-white bg-fuchsia-600': route.name === 'users',
                                        'text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 hover:text-gray-900 group transition duration-75 flex items-center p-2': true
                                    }">
                                        <i class="fas fa-users"></i>
                                        <span class="ml-3 flex-1 whitespace-nowrap">Users</span>
                                    </router-link>
                                </li>
                                <li>
                                    <router-link :to="{ name: 'blacklist' }" :class="{
    'text-white bg-orange-600': route.name === 'blacklist',
                                        'text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 hover:text-gray-900 group transition duration-75 flex items-center p-2': true
                                    }">
                                        <i class="fas fa-user-slash"></i>

                                        <span class="ml-3 flex-1 whitespace-nowrap">Blacklist</span>
                                    </router-link>
                                </li>
                                <li>
                                    <router-link :to="{ name: 'products' }" :class="{
    'text-white bg-cyan-600': route.name === 'products',
                                        'text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 hover:text-gray-900 group transition duration-75 flex items-center p-2': true
                                    }">
                                        <i class="fas fa-box"></i>
                                        <span class="ml-3 flex-1 whitespace-nowrap">Products</span>
                                        <!-- <span
                      class="bg-gray-200 text-gray-800 ml-3 text-sm font-medium inline-flex items-center justify-center px-2 rounded-full"
                      >Pro</span
                    > -->
                                    </router-link>
                                </li>
                                <li>
                                    <router-link :to="{ name: 'categories' }" :class="{
                                        'text-white bg-yellow-600': route.name === 'categories',
                                        'text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 hover:text-gray-900 group transition duration-75 flex items-center p-2': true
                                    }">
                                        <i class="fas fa-th-large"></i>

                                        <span class="ml-3">Categories</span>
                                    </router-link>
                                </li>
                                <li>
                                    <router-link :to="{ name: 'orders' }" :class="{
                                    'text-white bg-violet-600': route.name === 'orders',
                                    'text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 hover:text-gray-900 group transition duration-75 flex items-center p-2': true
                                }"><i class="fas fa-shopping-basket"></i>
                                        <span class="ml-3 flex-1 whitespace-nowrap">Orders</span>
                                    </router-link>
                                </li>
                                <li>
                                    <router-link :to="{ name: 'sells' }" :class="{
                                    'text-white bg-emerald-600': route.name === 'sells',
                                    'text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 hover:text-gray-900 group transition duration-75 flex items-center p-2': true
                                }">
                                        <i class="fas fa-receipt"></i>
                                        <span class="ml-3">Sells</span>
                                    </router-link>
                                </li>
                                <li>
                                    <router-link :to="{ name: 'invoices' }" :class="{
                                        'text-white bg-red-600': route.name === 'invoices',
                                        'text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 hover:text-gray-900 group transition duration-75 flex items-center p-2': true
                                    }">
                                        <i class="fas fa-file-invoice"></i>
                                        <span class="ml-3 flex-1 whitespace-nowrap">Invoices</span>
                                    </router-link>
                                </li>
                            </ul>
                            <div class="space-y-2 pt-2">
                                <router-link :to="{ name: 'admin-profile' }" :class="{
                                    'text-white bg-blue-600': route.name === 'admin-profile',
                                    'text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 hover:text-gray-900 group transition duration-75 flex items-center p-2': true
                                }">
                                    <i class="fas fa-user"></i>

                                    <span class="ml-4">Profile</span>
                                </router-link>

                                <button @click="logout"
                                    class="text-base w-full text-gray-900 cursor-pointer font-normal rounded-lg hover:bg-gray-100 group transition duration-75 flex items-center p-2">
                                    <i class="fas fa-sign-out-alt"></i>

                                    <span class="ml-3">Log out</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
            <!-- this is the shadow of the sidebar -->
            <div class="bg-gray-900 opacity-50 hidden fixed inset-0 z-10" id="sidebarBackdrop"></div>
            <div id="main-content" class="h-full w-full bg-gray-50 relative overflow-y-auto overflow-x-hidden lg:ml-64">
                <main>
                    <router-view></router-view>
                </main>
                <footer
                    class="bg-white md:flex md:items-center md:justify-between shadow rounded-lg p-4 md:p-6 xl:p-8 my-6 mx-4">
                    <ul class="flex items-center flex-wrap mb-6 md:mb-0">
                        <li>
                            <a href="#" class="text-sm font-normal text-gray-500 hover:underline mr-4 md:mr-6">Terms and
                                conditions</a>
                        </li>
                        <li>
                            <a href="#" class="text-sm font-normal text-gray-500 hover:underline mr-4 md:mr-6">Privacy
                                Policy</a>
                        </li>
                        <li>
                            <a href="#"
                                class="text-sm font-normal text-gray-500 hover:underline mr-4 md:mr-6">Licensing</a>
                        </li>
                        <li>
                            <a href="#" class="text-sm font-normal text-gray-500 hover:underline mr-4 md:mr-6">Cookie
                                Policy</a>
                        </li>
                        <li>
                            <a href="#" class="text-sm font-normal text-gray-500 hover:underline">Contact</a>
                        </li>
                    </ul>
                    <div class="flex sm:justify-center space-x-6">
                        <a href="#" class="text-gray-500 hover:text-gray-900">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-gray-900">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-gray-900">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path
                                    d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-gray-900">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-gray-900">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10c5.51 0 10-4.48 10-10S17.51 2 12 2zm6.605 4.61a8.502 8.502 0 011.93 5.314c-.281-.054-3.101-.629-5.943-.271-.065-.141-.12-.293-.184-.445a25.416 25.416 0 00-.564-1.236c3.145-1.28 4.577-3.124 4.761-3.362zM12 3.475c2.17 0 4.154.813 5.662 2.148-.152.216-1.443 1.941-4.48 3.08-1.399-2.57-2.95-4.675-3.189-5A8.687 8.687 0 0112 3.475zm-3.633.803a53.896 53.896 0 013.167 4.935c-3.992 1.063-7.517 1.04-7.896 1.04a8.581 8.581 0 014.729-5.975zM3.453 12.01v-.26c.37.01 4.512.065 8.775-1.215.25.477.477.965.694 1.453-.109.033-.228.065-.336.098-4.404 1.42-6.747 5.303-6.942 5.629a8.522 8.522 0 01-2.19-5.705zM12 20.547a8.482 8.482 0 01-5.239-1.8c.152-.315 1.888-3.656 6.703-5.337.022-.01.033-.01.054-.022a35.318 35.318 0 011.823 6.475 8.4 8.4 0 01-3.341.684zm4.761-1.465c-.086-.52-.542-3.015-1.659-6.084 2.679-.423 5.022.271 5.314.369a8.468 8.468 0 01-3.655 5.715z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </footer>
                <p class="text-center text-sm text-gray-500 my-10">
                    &copy; 2023-2024
                    <a href="#" class="hover:underline" target="_blank">Oil Store</a>. All
                    rights reserved.
                </p>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed, ref, onMounted } from "vue";
import { useRouter,useRoute } from "vue-router";
import store from "../store";
import common from "../utils/common";
import Avatar from "vue-avatar-component";

const user = computed(() => store.state.user.data);
const notifications = ref({});
const router = useRouter();
const route = useRoute(); // Access the current route
const counter = ref(0);
const notifiable = ref(false);

onMounted(() => {
    fetchNotifications();
  store.dispatch("getLoggedUser");
});
function   redirectTo(url) {
      if (url) {
        router.push(url);
        notifiable.value = false ;
      }
    }
function toggle() {
  document.getElementById("sidebar").classList.toggle("hidden");
  document
    .getElementById("toggleSidebarMobileHamburger")
    .classList.toggle("hidden");
  document
    .getElementById("toggleSidebarMobileClose")
    .classList.toggle("hidden");
}
function fetchNotifications() {
  store.dispatch("getNotifications").then((res) => {
    notifications.value = res;
    counter.value = notifications.value.length;
  });
}
function logout() {
  store.dispatch("logout").then((res) => {
    if (res.status === 200) {
      router.push({
        name: "login",
      });
    }
  });
}

function setRead_at() {
  counter.value = 0;
  const now = new Date();
  store.dispatch("setReadAt", now);
}
</script>
