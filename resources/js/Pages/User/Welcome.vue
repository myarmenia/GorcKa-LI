<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import Layout from '@/Layouts/User/Layout.vue';
import Index from '@/Layouts/User/Index.vue';
import FindJobe from '@/Pages/User/Home/FindJobe.vue';

import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
  locale: String,
  categories: Array,
});






// defineProps({
//     canLogin: {
//         type: Boolean,
//     },
//     canRegister: {
//         type: Boolean,
//     },
//     laravelVersion: {
//         type: String,
//         required: true,
//     },
//     phpVersion: {
//         type: String,
//         required: true,
//     },
// });

// function handleImageError() {
//     document.getElementById('screenshot-container')?.classList.add('!hidden');
//     document.getElementById('docs-card')?.classList.add('!row-span-1');
//     document.getElementById('docs-card-content')?.classList.add('!flex-row');
//     document.getElementById('background')?.classList.add('!hidden');
// }
</script>

<template>

    <Head title="Welcome" />

    <!-- <GuestLayout></GuestLayout> -->
    <Layout >
        <!-- <Index /> -->
        <FindJobe :categories="props.categories" :locale="locale"/>
    </Layout>

</template>
