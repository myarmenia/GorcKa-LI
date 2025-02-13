<script setup>
import { Link } from '@inertiajs/vue3';
import Footer from '@/Layouts/User/Footer.vue';
import NavBar from '@/Layouts/User/NavBar.vue';



</script>

<template>
    <NavBar></NavBar>

    <main>
        <slot></slot>
    </main>
    <Footer></Footer>
</template>
