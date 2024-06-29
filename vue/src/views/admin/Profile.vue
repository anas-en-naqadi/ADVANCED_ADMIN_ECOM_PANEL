<template>
  <div class="w-full">
    <div class="flex flex-col items-center w-full px-5">
      <div
        class="flex flex-wrap justify-center items-center w-full mt-12"

      >
        <div class="w-full xl:w-2/4 p-3" v-if="Object.keys(user).length">
          <div class="card bg-white border border-gray-300 rounded-xl">
            <!-- Profile Card -->
            <div class="bg-white  border-t-4 border-green-400">
              <div class="pt-1.5 -mb-2 mt-2 overflow-hidden text-center">
                <Avatar :fullname="user.name" :size="60" />
              </div>
             <div class="px-2">
                 <h1 class="text-gray-900 font-bold text-xl leading-8 my-1">
                {{ user.first_name + " " + user.last_name }}
              </h1>
               <h3 class="text-gray-600 font-lg text-semibold leading-6">
                Role:
                <span class="text-sm font-semibold">{{ user.is_admin === 1 ? 'admin' : '' }}</span>
              </h3>
              <h3 class="text-gray-600 font-lg text-semibold leading-6">
                email:
                <span class="text-sm font-semibold">{{ user.email }}</span>
              </h3>
              <h3 class="text-gray-600 font-lg text-semibold leading-6">
                phone:
                <span class="text-sm font-semibold">{{
                  user.phone || "not exist"
                }}</span>
              </h3>
             </div>


              <ul
                class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:shadow py-2 px-3 mt-3 divide-y rounded shadow-sm"
              >
                <li class="flex items-center py-3">
                  <span>Status</span>
                  <span class="ml-auto"
                    ><span
                      class="bg-green-500 py-1 px-2 rounded text-white text-sm"
                      >{{ user.status }}</span
                    ></span
                  >
                </li>
                <li class="flex items-center py-3">
                  <span>Member since</span>
                  <span class="ml-auto">{{
                    common.formatDate(user.created_at)
                  }}</span>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="w-full xl:w-2/4 p-3" v-else>
          <div class="card bg-white border border-gray-300 rounded-xl">
            <!-- Profile Card -->
            <div class="bg-white  border-t-4 border-green-400">
              <div class=" flex items-center justify-center -mb-2 mt-2 overflow-hidden text-center">
               <Skeleton shape="circle" size="5rem"></Skeleton>
              </div>
             <div class="px-2">
                 <h1 class="text-gray-900 font-bold text-xl leading-8 ">
                <Skeleton width="12rem"></Skeleton>
              </h1>
              <h3 class="text-gray-600 my-2 flex gap-4 items-center font-lg text-semibold leading-6">
               <span>Role:</span>
                <Skeleton width="9rem" ></Skeleton>
              </h3>
              <h3 class="text-gray-600 my-2 flex gap-4 items-center font-lg text-semibold leading-6">
               <span>Email:</span>
                <Skeleton width="14rem"></Skeleton>
              </h3>
              <h3 class="text-gray-600 my-2 flex gap-4 items-center font-lg text-semibold leading-6">
               <span>Phone:</span>
                <Skeleton width="14rem"></Skeleton>
              </h3>
             </div>


              <ul
                class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:shadow py-2 px-3 mt-3 divide-y rounded shadow-sm"
              >
                <li class="flex justify-between items-center py-3">
                  <span>Status</span>

                      <Skeleton width="7rem"></Skeleton>

                </li>
               <li class="flex justify-between items-center py-3">
                  <span>Member Since</span>

                      <Skeleton width="7rem"></Skeleton>

                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="w-full xl:w-2/4 p-3">
          <div class="card bg-white border border-gray-300 rounded-xl p-6 pb-7">
            <div class="flex w-full justify-between items-center pb-4">
              <p class="mb-0 white:text-white/80 font-bold">Edit Password</p>
              <button
                @click="updatePassword"
                type="button"
                class="inline-block px-8 py-2 mt-3 mb-4 ml-auto font-bold leading-normal text-center text-white align-middle transition-all ease-in bg-red-500 border-0 rounded-lg shadow-md cursor-pointer text-xs tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85"
              >
                save
              </button>
            </div>

            <div class="flex flex-wrap mx-3 pb-4">
              <div class="w-full px-3 mb-4">
                <label
                  for="current_password"
                  class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 white:text-white/80"
                  >Current Password</label
                >
                <input
                  v-model="passwordBag.currentPassword"
                  type="password"
                  name="current_password"
                  class="focus:shadow-primary-outline white:bg-slate-850 white:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"
                />
              </div>
              <div class="w-full md:w-6/12 px-3 mb-4">
                <label
                  for="new_password"
                  class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 white:text-white/80"
                  >New Password</label
                >
                <input
                  v-model="passwordBag.newPassword"
                  type="password"
                  name="new_password"
                  class="focus:shadow-primary-outline white:bg-slate-850 white:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"
                />
              </div>
              <div class="w-full md:w-6/12 px-3 mb-4">
                <label
                  for="confirm_password"
                  class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 white:text-white/80"
                  >Confirm Password</label
                >
                <input
                  v-model="passwordBag.confirmation_password"
                  type="password"
                  name="confirm_password"
                  class="focus:shadow-primary-outline white:bg-slate-850 white:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"
                />
              </div>
            </div>
          </div>
        </div>
      </div>

      <div v-if="Object.keys(user).length" class="w-full p-3 mt-6">
        <div class="card bg-white border border-gray-300 rounded-xl p-6 pb-0">
          <div class="flex items-center">
            <p class="mb-0 white:text-white/80 font-bold">Edit Profile</p>
            <button
              @click="updateProfile"
              type="button"
              class="inline-block px-8 py-2 mt-3 mb-4 ml-auto font-bold leading-normal text-center text-white align-middle transition-all ease-in bg-blue-500 border-0 rounded-lg shadow-md cursor-pointer text-xs tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85"
            >
              save
            </button>
          </div>

          <div class="flex-auto p-6">
            <p
              class="leading-normal uppercase white:text-white white:opacity-60 text-sm font-semibold mb-2 text-blue-600"
            >
              User Information
            </p>
            <div id="profile" class="flex flex-wrap -mx-3 pb-2">
              <div class="w-full md:w-6/12 px-3 mb-4">
                <label
                  for="first_name"
                  class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 white:text-white/80"
                  >First name</label
                >
                <input
                  v-model="user.first_name"
                  type="text"
                  name="first_name"
                  class="focus:shadow-primary-outline white:bg-slate-850 white:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"
                />
              </div>
              <div class="w-full md:w-6/12 px-3 mb-4">
                <label
                  for="email"
                  class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 white:text-white/80"
                  >Email address</label
                >
                <input
                  v-model="user.email"
                  type="email"
                  name="email"
                  class="focus:shadow-primary-outline white:bg-slate-850 white:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"
                />
              </div>
              <div class="w-full md:w-6/12 px-3 mb-4">
                <label
                  for="last_name"
                  class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 white:text-white/80"
                  >Last name</label
                >
                <input
                  v-model="user.last_name"
                  type="text"
                  name="last_name"
                  class="focus:shadow-primary-outline white:bg-slate-850 white:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"
                />
              </div>
              <div class="w-full md:w-6/12 px-3 mb-4">
                <label
                  for="phone"
                  class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 white:text-white/80"
                  >Phone Number</label
                >
                <input
                  v-model="user.phone"
                  type="text"
                  name="phone"
                  class="focus:shadow-primary-outline white:bg-slate-850 white:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
       <div v-else class="w-full p-3 mt-6">
        <div class="card bg-white border border-gray-300 rounded-xl p-6 pb-0">
          <div class="flex justify-between items-center">
            <p class="mb-0 white:text-white/80 font-bold">Edit Profile</p>
             <Skeleton width="7rem"></Skeleton>
          </div>

          <div class="flex-auto p-6">
            <p
              class="leading-normal uppercase white:text-white white:opacity-60 text-sm font-semibold mb-2 text-blue-600"
            >
              User Information
            </p>
            <div id="profile" class="flex flex-wrap -mx-3 pb-2">
              <div class="w-full md:w-6/12 px-3 mb-4">
                <label
                  for="first_name"
                  class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 white:text-white/80"
                  >First name</label
                >
                <Skeleton></Skeleton>
              </div>
              <div class="w-full md:w-6/12 px-3 mb-4">
                <label
                  for="email"
                  class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 white:text-white/80"
                  >Email address</label
                >
                 <Skeleton></Skeleton>
              </div>
              <div class="w-full md:w-6/12 px-3 mb-4">
                <label
                  for="last_name"
                  class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 white:text-white/80"
                  >Last name</label
                >
                <Skeleton></Skeleton>
              </div>
              <div class="w-full md:w-6/12 px-3 mb-4">
                <label
                  for="phone"
                  class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 white:text-white/80"
                  >Phone Number</label
                >
                 <Skeleton></Skeleton>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <Toast />
  </div>
</template>


<script setup>
import { ref,onMounted } from "vue";
import store from "../../store";
import Avatar from "vue-avatar-component";
import common from "../../utils/common";
import { useToast } from "primevue/usetoast";
const user = ref({});
let errors;
const passwordBag = ref({});
const toast = useToast();
onMounted(()=>{
    store.dispatch("getLoggedUser").then((res)=>{
        if(res.status === 200)
        user.value = res.data;
    })
})
function updateProfile() {
  store
    .dispatch("updateAdminProfile", user.value)
    .then((res) => {
      if (res.status === 200)
        common.showToast({ title: res.data.message, icon: "success" });
      if (res.response && res.response.status === 422){
  errors = [...Object.values(res.response.data.errors)];
      errors.forEach((e) => {
        toast.add({
          severity: "error",
          summary: "Error",
          detail: e[0],
          life: 3000,
        });
      });
      }

    })
    .catch((error) => {
      console.error(error);
    });
}
function updatePassword() {
  store
    .dispatch("updatePassword", passwordBag.value)
    .then((res) => {
      if (res.status === 200)
        common.showToast({ title: res.data.message, icon: "success" });
      if (res.response.status === 422){
 errors = [...Object.values(res.response.data.errors)];
      errors.forEach((e) => {
        toast.add({
          severity: "error",
          summary: "Error",
          detail: e,
          life: 3000,
        });
      });
      }

    })
    .catch((error) => {
      console.error(error);
    });
}
</script>
