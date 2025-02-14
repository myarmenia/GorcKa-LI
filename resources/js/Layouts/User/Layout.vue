<script setup>
import { Link } from '@inertiajs/vue3';
import Footer from '@/Layouts/User/Footer.vue';
import NavBar from '@/Layouts/User/NavBar.vue';



</script>

<template>
    <NavBar></NavBar>
        <div class="main-content">
            <div class="page-content">
                <slot></slot>
            </div>
        </div>
    <Footer></Footer>
</template>
