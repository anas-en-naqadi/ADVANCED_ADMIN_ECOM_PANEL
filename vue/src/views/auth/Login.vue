
<template>
    <div id="container"
        class="flex mt-[5.1rem] mb-[4rem] shadow-md  bg-white border border-gray-200 xl:w-[27%] lg:w-[40%] md:w-[40%] sm:w-[50%] w-[50%] mx-auto rounded-md flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm sm:max-h-sm -mt-12">
            <img class="mx-auto h-32 w-32 -mb-10" src="@/assets/images/olive.png" alt="Your Company" />
            <h2 class="mt-5 text-center text-xl font-bold leading-9 tracking-tight text-green-900">
                Sign in to your account
            </h2>
        </div>
        <div class="mt-7 mb-11 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6">
                <div v-if="errorMsg.length || message"
                    class="flex p-4  mb-4 text-sm text-red-800 rounded-lg bg-red-50 "
                    role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3 mt-[2px]" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Danger</span>
                    <div>
                        <span class="font-medium">Ensure that these requirements are met:</span>
                        <ul v-if="errorMsg.length" class="mt-1.5 list-disc list-inside">
                            <li v-for="(error, index) in errorMsg" :key="index">{{ error[0] }}</li>

                        </ul>
                        <ul v-if="message" class="mt-1.5 list-disc list-inside">
                            <li>{{ message }}</li>
                        </ul>
                    </div>
                </div>
                <div>


                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                    <div class="mt-2">
                        <input v-model="user.email" id="email" name="email" type="email" autofocus autocomplete="email"
                            required placeholder="oil_store@example.com"
                            class="block w-full rounded-md border-sm p-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6" />
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password
                        </label>
                    </div>
                    <div class="mt-2">
                        <input v-model="user.password" id="password" name="password" type="password"
                            autocomplete="current-password" required=""
                            class="block w-full rounded-md border-1 p-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6" />
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" v-model="user.remember" name="remember-me" id="remember me"
                            class="font-semibold text-green-600 hover:text-green-500" />
                        <label for="remember-me" class="ml-3 block text-sm">
                            Remember me
                        </label>
                    </div>
                    <div class="text-sm">
                        <router-link to="#"
                            class="font-semibold text-green-600 hover:text-green-500 hover:underline">Forgot Password?
                            </router-link>
                    </div>
                </div>

                <div>
                    <Button :loading="loading" @trigger-event="login()" :string="'Sign in'" :color="'green'" />
                </div>
            </form>


        </div>
    </div>
</template>
<style scope>
@media only screen and (max-width: 550px) {

    #container {
        width: 80%;
    }

}
/* Custom CSS for background */
body {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='%2300B38F' fill-opacity='0.7' d='M0,128L34.3,154.7C68.6,181,137,235,206,245.3C274.3,256,343,224,411,224C480,224,549,256,617,272C685.7,288,754,288,823,277.3C891.4,267,960,245,1029,218.7C1097.1,192,1166,160,1234,128C1302.9,96,1371,64,1406,48L1440,32L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z'%3E%3C/path%3E%3C/svg%3E");
    /* Other background properties */
    background-size: cover;
    /* Adjust as needed */
    background-position: bottom;
    /* Adjust as needed */
}
</style>
<script setup>
import store from "../../store";
import Button from "../../components/Button.vue";
import { ref } from "vue";
const errors = ref({});
const user = {
    email: "",
    password: "",
    remember: false,
};
function makeitRed() {
    document.querySelector("#email").classList.add("border-red-600");
    document.querySelector("#password").classList.add("border-red-600");
}
let errorMsg = ref([]);
let message = "";
const loading = ref(false);

function login() {
    document.querySelector("#email").classList.remove("border-red-600");
    document.querySelector("#password").classList.remove("border-red-600");
    errorMsg.value = [];
    message = ""
    loading.value = true;
    store
        .dispatch("login", user)
        .then((res) => {

            if (res.status === 200) {
                setTimeout(() => {
                        window.location.href = "http://localhost:5173/admin/dashboard";
                }, 1300);
            }
            if (res.status === 422 && res.response) {
                errorMsg.value = [...Object.values(res.response.data.errors)];
                loading.value = false;
            }
            if (res.status === 401 && res.response) {
                message = res.response.data.message;
                loading.value = false;
            }

        })
        .catch((err) => {
            loading.value = false;
        });
}
function google() {
    window.location.href = "http://127.0.0.1:8000/auth/google"

}
function facebook() {
    window.location.href = "http://127.0.0.1:8000/auth/facebook"
}

</script>
