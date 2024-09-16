<template>
    <div>
        <Nav />
        <main>
            <router-view></router-view>
        </main>
        <Footer />
    </div>
</template>

<script setup>
import Footer from './Footer.vue';
import Nav from './Nav.vue';
</script>

<style scoped>
@import url('@/assets/css/main.css');
</style>
