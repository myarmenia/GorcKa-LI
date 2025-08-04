<script setup>

import Layout from '@/Layouts/User/Layout.vue';
import FindJobe from '@/Pages/User/Home/FindJobe.vue';
import Categories from '@/Pages/User/Home/Categories.vue';
import Jobs from '@/Pages/User/Home/Jobs.vue';
import SiteGuide from '@/Pages/User/Home/SiteGuide.vue';
import TopCategoriesJobs from '@/Pages/User/Home/TopCategoriesJobs.vue';

import { Head, Link } from '@inertiajs/vue3';
import TopSpecialist from './Home/TopSpecialist.vue';


const props = defineProps({
  locale: String,
  categories: Array,
  categoriesWithTaskCount: Array,
  jobs: Array,
  topCategoriesJobs: Array,
  topSpecialistRating: Array
});
console.log(props.topSpecialistRating)


</script>

<template>

    <Head title="Welcome" />

    <!-- <GuestLayout></GuestLayout> -->
    <Layout >
        <!-- <Index /> -->
        <FindJobe :categories="props.categories" :locale="locale"/>
        <TopCategoriesJobs :topCategoriesJobs="props.topCategoriesJobs" />

        <Categories :categories="props.categoriesWithTaskCount" :locale="locale"/>
        <Jobs :jobs="props.jobs" />
        <SiteGuide :locale="locale" />
        <TopSpecialist :topSpecialistRating="props.topSpecialistRating" :locale="locale" />


    </Layout>

</template>


