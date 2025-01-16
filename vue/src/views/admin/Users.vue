<template>
  <div class="card mx-5 mt-12 bg-white border border-gray-300 rounded-xl">
    <div class="flex justify-between items-center mb-4">
      <h2 class="mb-3 text-2xl font-extrabold tracking-tight text-gray-900 p-8">
        List of Users
      </h2>
      <Button
        type="button"
        icon="pi pi-add"
        label="new User"
        class="p-button-outlined bg-white py-2 px-4 mr-6 border border-black rounded-md text-black hover:text-white hover:bg-black"
        @click="visible2 = true"
      />
    </div>
    <!-- Main Data Table -->
    <div v-if="!loading">
      <DataTable
        :value="filteredUsers"
        removableSort
        :paginator="true"
        class="p-datatable-sites -mt-5 m-6"
        showGridlines
        :rows="10"
        dataKey="id"
        tableStyle="min-width: 30rem"
        stripedRows
        responsiveLayout="scroll"
        breakpoint="960px"
        paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown"
        currentPageReportTemplate="Showing {first} to {last} of {totalRecords} users"
      >
        <template #header>
          <div
            class="flex justify-between items-center gap-5"
            style="display: flex"
          >
            <span class="relative">
              <i
                class="pi pi-search absolute top-2/4 -mt-2 left-3 text-surface-400 white:text-surface-600"
              />
              <InputText
                @input="filterTable($event)"
                placeholder="Search"
                id="searchInput"
                class="pl-10 py-2 border-gray-300"
              />
            </span>
            <Button
              type="button"
              icon="pi pi-filter-slash"
              label="Clear"
              class="p-button-outlined bg-white py-2 px-4 border border-blue-500 rounded-md text-blue-800 hover:text-white hover:bg-blue-500"
              @click="clearFilter()"
            />
          </div>
        </template>
        <template #empty>No users list found.</template>

        <!-- Columns -->
        <Column
          field="id"
          class="border-b-[1px] text-center"
          header="ID"
        ></Column>
        <Column
          field="avatar"
          header="Avatar"
          class="border-b-[1px] text-center"
          style="min-width: 12rem"
        >
          <template #body="{ data }">
            <avatar :fullname="data.name" :size="63"></avatar>
          </template>
        </Column>
        <Column
          field="name"
          class="border-b-[1px] text-center"
          header="Name"
        ></Column>
        <Column
          field="email"
          class="border-b-[1px]"
          header="Email"
        ></Column>
        <Column
          field="status"
          class="border-b-[1px] text-center"
          header="Status"
          style="min-width: 8rem"
          sortable
        >
          <template #body="{ data }">
            <span
              class="py-1.5 px-1.5 text-xs rounded-md text-white"
              :class="[
                data.status === 'active'
                  ? 'bg-green-500 '
                  : data.status === 'inactive'
                  ? 'bg-red-500'
                  : 'bg-gray-500',
              ]"
              >{{ data.status }}</span
            >
          </template>
        </Column>
        <Column
          field="is_admin"
          class="border-b-[1px] text-center"
          header="Role"
          style="min-width: 6rem"
          sortable
        >
          <template #body="{ data }">
            <span
              class="py-1.5 px-1.5 text-xs rounded-md text-white"
              :class="[data.is_admin !== 1 ? 'bg-blue-500 ' : 'bg-green-500 ']"
              >{{ data.is_admin !== 1 ? "user" : "admin" }}</span
            >
          </template>
        </Column>

        <Column
          field="created_at"
          class="border-b-[1px] text-center w-full"
          header="creer a"
          sortable
        >
          <template #body="{ data }">
            <span>{{ common.formatDate(data.created_at) }}</span>
          </template>
        </Column>

        <Column header="Actions" class="border-b-[1px] text-center">
          <template #body="{ data }">
            <div class="flex gap-3">
              <button
                v-if="data.status === 'active'"
                @click="changeStatus(data.id, 'inactive')"
                title="Desactiver ce compte"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="w-6 h-6 text-red-600"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                  />
                </svg>
              </button>
              <button
                v-if="data.status === 'inactive'"
                @click="changeStatus(data.id, 'active')"
                title="Activer ce compte"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="w-6 h-6 text-emerald-500"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 0 0-3.7-3.7 48.678 48.678 0 0 0-7.324 0 4.006 4.006 0 0 0-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 0 0 3.7 3.7 48.656 48.656 0 0 0 7.324 0 4.006 4.006 0 0 0 3.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3-3 3"
                  />
                </svg>
              </button>

              <button
                @click="showDialog(data.id)"
                title="Ajouter aux blacklist"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="w-6 h-6"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                  />
                </svg>
              </button>
              <button v-if="!data.is_admin" @click="setToAdmin(data.id)" title="Mettre comme admin">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="w-6 h-6 text-green-600"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"
                  />
                </svg>
              </button>
            </div>
          </template>
        </Column>
      </DataTable>
    </div>
    <!-- Skeleton Data Table -->
    <div v-else>
      <DataTable
        :value="skeletonObjects"
        class="p-datatable-sites -mt-5 m-6"
        tableStyle="min-width: 30rem"
        :rowClassName="'border-t text-center border-gray-200'"
      >
        <template #header>
          <div
            class="flex justify-between items-center gap-5"
            style="display: flex"
          >
            <span class="relative">
              <i
                class="pi pi-search absolute top-2/4 -mt-2 left-3 text-surface-400 white:text-surface-600"
              />
              <InputText placeholder="Search" class="pl-10 py-2" />
            </span>
            <Button
              type="button"
              icon="pi pi-filter-slash"
              label="Clear"
              class="p-button-outlined bg-white py-2 px-4 border border-blue-500 rounded-md text-blue-800 hover:text-white hover:bg-blue-500"
            />
          </div>
        </template>
        <Column field="id" header="Id">
          <template #body>
            <Skeleton></Skeleton>
          </template>
        </Column>
        <Column field="name" header="Name" class="text-center flex items-center justify-center">
          <template #body>
            <Skeleton shape="circle" size="5rem"></Skeleton>
          </template>
        </Column>
        <Column field="name" header="Status">
          <template #body>
            <Skeleton></Skeleton>
          </template>
        </Column>
        <Column field="id" header="Role">
          <template #body>
            <Skeleton></Skeleton>
          </template>
        </Column>
        <Column field="email" header="Email">
          <template #body>
            <Skeleton></Skeleton>
          </template>
        </Column>
        <Column field="created_at" header="Register in">
          <template #body>
            <Skeleton></Skeleton>
          </template>
        </Column>

        <Column field="" header="Actions">
          <template #body>
            <Skeleton></Skeleton>
          </template>
        </Column>
      </DataTable>
    </div>

    <Dialog
      v-model:visible="visible1"
      modal
      header="Add to Blacklist"
      :style="{ width: '30rem' }"
    >
      <div class="flex-col gap-5">
        <div class="flex mt-1 gap-2">
        <label for="reason" class="font-semibold w-6rem">Reason:</label>
        <Textarea
          v-model="reason"
          autoResize
          rows="5"
          cols="30"
          class="border w-full border-gray-500 p-2"
        />
      </div>
      <Button
        icon="pi pi-check"
        label="submit"
        @click="addToBlacklist"
        class="bg-green-500 p-2 w-[23.3rem] mt-4 hover:bg-green-800 text-white ml-[3.7rem] "
      />
      </div>

    </Dialog>
    <Dialog
      v-model:visible="visible2"
      modal
      header="Ajouter nouveau utilisateur"
      :style="{ width: '50%' }"
    >
      <div id="profile" class="flex flex-wrap -mx-3 pb-2">
        <div class="w-full md:w-6/12 px-3 mb-4">
          <label
            for="first_name"
            class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 white:text-white/80"
            >Full name</label
          >
          <input
            v-model="user.name"
            type="text"
            name="full_name"
            placeholder="Jane Doe"
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
            placeholder="example@gmail.com"
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
            placeholder="06..."
            name="phone"
            class="focus:shadow-primary-outline white:bg-slate-850 white:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"
          />
        </div>
        <div class="w-full md:w-6/12 px-3 mb-4">
          <label
            for="phone"
            class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 white:text-white/80"
            >Role</label
          >
          <select
            v-model="user.is_admin"
            name="role"
            class="focus:shadow-primary-outline white:bg-slate-850 white:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"
          >
            <option selected value=" ">Choisissez un role</option>
            <option value="0">user</option>
            <option value="1">admin</option>
          </select>
        </div>
        <div class="w-full flex-1 -mb-4 mt-3">
          <Button
            @click="newUser"
            label="Add"
            class="text-white bg-blue-500 text-sm  py-2 hover:bg-blue-900 w-full rounded-md"
          />
        </div>
      </div>
    </Dialog>
    <Toast />
  </div>
</template>

<script setup>
import store from "../../store";
import Avatar from "vue-avatar-component";
import { ref, onMounted } from "vue";
import common from "../../utils/common";
import { useToast } from "primevue/usetoast";

const users = ref([]);
const user = ref({ is_admin: " ", name: "", email: "", phone: "" });
const visible1 = ref(false);
const visible2 = ref(false);
const loading = ref(false);
const filteredUsers = ref([]);
const toast = useToast();
let userId;
let reason = "";

onMounted(() => {
  fetchUsers();
});

function clearFilter() {
  document.getElementById("searchInput").value = "";
  filteredUsers.value = users.value;
}
function fetchUsers() {
  loading.value = true;
  store
    .dispatch("getUsers")
    .then((res) => {
      users.value = res;
      filteredUsers.value = [...users.value];
    })
    .catch((error) => console.error(error))
    .finally(() => {
      loading.value = false;
    });
}

function filterTable(event) {
  const filter = event.target.value.toLowerCase();

  if (!filter) filteredUsers.value = users.value;
  else
    filteredUsers.value = users.value.filter(
      (u) =>
        u.name.toLowerCase().includes(filter) ||
        u.email.toLowerCase().includes(filter)
    );
}

function changeStatus(id, status) {
  common
    .showSwal({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: `yes, ${
        status === "inactive" ? "deactivate" : "active"
      } it !`,
    })
    .then((result) => {
      if (result.isConfirmed) {
        store
          .dispatch("changeUserStatus", { user_id: id, status: status })
          .then((res) => {
            if (res.status === 200 && res.data) {
              fetchUsers();
              common.showToast({ title: res.data.message, icon: "success" });
            } else if (res.response.status === 500)
              common.showToast({
                title: res.response.data.message,
                icon: "error",
              });
          });
      }
    });
}

function showDialog(id) {
  visible1.value = true;
  userId = id;
}

function addToBlacklist() {
  store
    .dispatch("addToBlacklist", { user_id: userId, reason: reason })
    .then((res) => {
        console.log("res",res);
      if (res.status === 200 && res.data) {
        visible1.value = false;
        reason = "";
        fetchUsers();
        common.showToast({ title: res.data.message, icon: "success" });
      } if (res.response && res.response.status === 422){
        toast.add({
          severity: "error",
          summary: "Error",
          detail: Object.values(res.response.data.errors)[0][1],
          life: 3000,
        });
      }
}).catch((error) => error);
}

function setToAdmin(id) {
  common
    .showSwal({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "yes, as admin !",
    })
    .then((result) => {
      if (result.isConfirmed) {
        store.dispatch("setAsAdmin", { user_id: id }).then((res) => {
          if (res.status === 200 && res.data) {
            fetchUsers();
            common.showToast({ title: res.data.message, icon: "success" });
          }
        });
      }
    });
}
function newUser() {
  store.dispatch("storeUser",user.value).then((res) => {
    console.log(res)
    if (res.status === 200 && res.data) {
      fetchUsers();
      visible2.value = false ;
      common.showToast({ title: res.data.message, icon: "success" });
    }
    if (res.response && res.response.status === 422) {
      [...Object.values(res.response.data.errors)].forEach((e) => {
        toast.add({
          severity: "error",
          summary: "Error",
          detail: e[0],
          life: 3000,
        });
      });
    }
  });
}
// Define skeleton data
const skeletonObjects = new Array(10);
</script>
