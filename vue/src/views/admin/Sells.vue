<template>
    <div class="card mt-12 m-6 bg-white border border-gray-300 rounded-xl">
        <div class="flex justify-between items-center mb-4">
            <h2 class="mb-3 text-2xl font-extrabold tracking-tight text-gray-900 p-8">
                List of Sells
            </h2>
            <p class="mb-4 text-2xl font-extrabold p-8">
                Total Sells:
                <span class="text-2xl font-bold text-blue-800">{{ common.formatNumber(total) }} DH</span>
            </p>
        </div>
        <!-- Main Data Table -->

        <div v-if="!loading">
            <DataTable :value="filteredSells" removableSort :paginator="true" class="p-datatable-sites -mt-5 m-6"
                showGridlines :rows="10" dataKey="id" tableStyle="min-width: 30rem" stripedRows
                :rowClassName="'border-t text-center border-gray-200'" filterDisplay="menu" responsiveLayout="scroll"
                breakpoint="960px"
                paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown"
                currentPageReportTemplate="Showing {first} to {last} of {totalRecords} sells">
                <template #header>
                    <div class="flex flex-col flex-wrap md:flex-row md:justify-between w-full md:items-center gap-5">
                        <div class="relative mb-2 md:mb-0 md:mr-5">
                            <i
                                class="pi pi-search absolute top-2/4 -mt-2 left-3 text-surface-400 white:text-surface-600"></i>
                            <InputText @input="filterTable($event)" placeholder="Search" id="searchInput"
                                class="pl-10 py-2 border-gray-300" />
                        </div>

                        <div class="flex flex-col md:flex-row gap-5">
                            <input v-model="date.start_date" type="date"
                                class="xl:w-[12rem] p-2 border-gray-300  focus:border-blue-500" />
                            <input v-model="date.end_date" type="date"
                                class="p-2 xl:w-[12rem] focus:border-blue-500 border-gray-300 " />

                            <Button type="button" icon="pi pi-filter-slash" label="Filter"
                                class="p-button-outlined bg-white py-2 px-4 border border-green-500 rounded-md text-green-800 hover:text-white hover:bg-green-500"
                                @click="filterSells()" />
                        </div>

                        <Button type="button" icon="pi pi-filter-slash" label="Clear"
                            class="p-button-outlined bg-white py-2 px-4 border border-blue-500 rounded-md text-blue-800 hover:text-white hover:bg-blue-500 mt-2 md:mt-0"
                            @click="clearFilter()" />
                    </div>
                </template>
                <template #empty>No sells list found.</template>
                <!-- Columns -->
                <Column field="id" header="ID"></Column>
                <Column field="product.product_name" class="border-b-[1px] text-center" header="Nom produit">
                    <template #body="{ data }">
                        <span>{{ data.product.product_name }}</span>
                    </template>
                </Column>
                <Column field="" header="Image" style="min-width: 12rem" class="border-b-[1px] text-center">
                    <template #body="{ data }">
                        <img v-if="data.product.image" :src="data.product.image" class="w-36 h-24 rounded-sm"
                            alt="User Image" />
                        <span v-else>No image</span>
                    </template>
                </Column>
                <Column field="" class="border-b-[1px] text-center" header="Prix" sortable>
                    <template #body="{ data }">
                        <span>{{ common.formatNumber(data.product.price) }} DH</span>
                    </template>
                </Column>
                <Column sortable field="quantity" class="border-b-[1px] text-center" header="Quantite"></Column>
                <Column field="total_amount" class="border-b-[1px] text-center" header="Total" sortable>
                    <template #body="{ data }">
                        <span>{{ common.formatNumber(data.total_amount) }} DH</span>
                    </template>
                </Column>
                <Column field="created_at" header="Vende le">
                    <template #body="{ data }">
                        <span>{{ common.formatDate(data.created_at) }}</span>
                    </template>
                </Column>
            </DataTable>
        </div>
        <!-- Skeleton Data Table -->
        <div v-else>
            <DataTable :value="skeletonObjects" class="p-datatable-sites -mt-5 m-6" tableStyle="min-width: 30rem"
                :rowClassName="'border-t text-center border-gray-200'">
                <template #header>
                    <div class="flex justify-between items-center gap-5" style="display: flex">
                        <span class="relative">
                            <i
                                class="pi pi-search absolute top-2/4 -mt-2 left-3 text-surface-400 white:text-surface-600" />
                            <InputText placeholder="Search" class="pl-10 py-2" />
                        </span>
                        <Button type="button" icon="pi pi-filter-slash" label="Clear"
                            class="p-button-outlined bg-white py-2 px-4 border border-blue-500 rounded-md text-blue-800 hover:text-white hover:bg-blue-500" />
                    </div>
                </template>

                <Column field="id" header="ID">
                    <template #body>
                        <Skeleton></Skeleton>
                    </template>
                </Column>
                <Column field="product.product_name" class="text-center" header="Nom produit">
                    <template #body>
                        <Skeleton></Skeleton>
                    </template>
                </Column>
                <Column field="product.image" header="Image" class="text-center flex  items-center justify-center">
                    <template #body>
                        <Skeleton width="8rem" height="8rem" shape="square"></Skeleton>
                    </template>
                </Column>
                <Column field="product.price" class="text-center" header="Prix" sortable>
                    <template #body>
                        <Skeleton></Skeleton>
                    </template>
                </Column>
                <Column field="quantity" header="Quantite">
                    <template #body>
                        <Skeleton></Skeleton>
                    </template>
                </Column>
                <Column field="total_amount" class="text-center" header="Total" sortable>
                    <template #body>
                        <Skeleton></Skeleton>
                    </template>
                </Column>
                <Column field="created_at" class="text-center" header="Vende le" sortable>
                    <template #body>
                        <Skeleton></Skeleton>
                    </template>
                </Column>
            </DataTable>
        </div>
        <Toast />
    </div>
</template>

<script setup>
import common from "../../utils/common";
import { ref, onMounted, computed } from "vue";
import store from "../../store";
import { useToast } from "primevue/usetoast";
const sells = ref([]);
const loading = ref(true);
const filteredSells = ref([]);
const date = ref({});
const toast = useToast();

onMounted(() => {
    fetchSells();
});
function filterSells() {
    store.dispatch("filterByDates", { date: date.value, type: "sell" }).then((res) => {
        if (res.status === 200 && res.data)
            filteredSells.value = [...res.data];
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
    }).catch(error => error);
}
function fetchSells() {
    store
        .dispatch("getSells")
        .then((res) => {

            sells.value = res;
            filteredSells.value = [...res];

        })
        .catch((error) => error)
        .finally(() => {
            loading.value = false;
        });
}
function clearFilter() {
    document.getElementById("searchInput").value = "";
    date.value = {};
    filteredSells.value = sells.value;
}
function filterTable(event) {
    const filter = event.target.value.toLowerCase();

    if (!filter) filteredSells.value = sells.value;
    else
        filteredSells.value = sells.value.filter(
            (p) =>
                p.product.product_name.toLowerCase().includes(filter)

        );
}
const total = computed(() => filteredSells.value.reduce(
    (acc, sell) => acc + parseFloat(sell.total_amount),
    0
));
// Define skeleton data
const skeletonObjects = new Array(10);
</script>
