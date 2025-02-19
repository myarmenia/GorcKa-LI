<script setup>
import { Link } from '@inertiajs/vue3';
import Footer from '@/Layouts/User/Footer.vue';
import NavBar from '@/Layouts/User/NavBar.vue';
import { provide, computed } from 'vue';
// import { usePage } from '@inertiajs/vue3';

// const page = usePage();
// const user = computed(() => page.props.auth?.user);

// Публикуем `user` для дочерних компонентов
// provide('user', user);
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
