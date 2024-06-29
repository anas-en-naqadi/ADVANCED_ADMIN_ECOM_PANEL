<template>
  <section class="container mx-auto p-10 md:py-20 px-0 md:p-10 md:px-0">
    <section
      class="p-5 md:p-0 grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-5 items-start"
    >
      <section
        v-for="product in products"
        :key="product.id"
        class="p-5 py-12 text-left transform duration-500 hover:-translate-y-2 hover:shadow-2xl cursor-pointer"
      >
        <img class="p-5" :src="product.image" alt="" />
        <h2 class="font-semibold mb-2 mt-12 text-cyan-600">
          Popular Collection
        </h2>
        <span class="w-6 h-6 bg-red-100"
          >-{{ Math.floor(product.discount) }}%</span
        >
        <h1 class="text-3xl mb-5 h-16">{{ product.product_name }}</h1>
        <div class="space-x-1 flex mb-5">
          <span>rate: {{ calculateAverageRating(product) }}</span>
          <svg
            v-for="(rate, index) in Math.ceil(calculateAverageRating(product))"
            :key="index"
            class="w-4 h-4 mx-px fill-current text-orange-600"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 14 14"
          >
            <path
              :class="{
                'text-yellow-500': index < rate,
                'text-yellow-500 half-star bg-': index >= Math.floor(rate),
              }"
              d="M6.43 12l-2.36 1.64a1 1 0 0 1-1.53-1.11l.83-2.75a1 1 0 0 0-.35-1.09L.73 6.96a1 1 0 0 1 .59-1.8l2.87-.06a1 1 0 0 0 .92-.67l.95-2.71a1 1 0 0 1 1.88 0l.95 2.71c.13.4.5.66.92.67l2.87.06a1 1 0 0 1 .59 1.8l-2.3 1.73a1 1 0 0 0-.34 1.09l.83 2.75a1 1 0 0 1-1.53 1.1L7.57 12a1 1 0 0 0-1.14 0z"
            ></path>
          </svg>
        </div>
        <p class="mb-5">
          {{ product.description }}
        </p>
        <h2 class="font-semibold mb-2 line-through text-gray-400 text-sm">
          {{ product.price }}DH
        </h2>
        <h2 class="font-semibold mb-5 text-red-500">
          {{
            (product.price - product.price * (product.discount / 100)).toFixed(
              2
            )
          }}DH
        </h2>

        <button
          class="p-2 px-6 bg-red-500 text-white rounded-md hover:bg-red-600"
        >
          Add To Cart
        </button>
      </section>

    
    </section>
  </section>
</template>

<script setup>
import store from "../../store";
import { onMounted, ref, computed } from "vue";

const products = computed(() => store.state.products);

onMounted(() => {
  store.dispatch("getProducts");
});

function calculateAverageRating(product) {
  const reviews = [...product.reviews];
  if (reviews.length === 0) return 0;

  const totalRating = reviews.reduce((acc, review) => acc + review.rating, 0);
  const averageRating = totalRating / reviews.length;

  return averageRating;
}
</script>
