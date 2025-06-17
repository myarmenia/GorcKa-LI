<script setup>
import { computed } from "vue";
import { useTrans } from '/resources/js/trans';
import { Head, Link } from '@inertiajs/vue3';
import Jobs from '@/Components/Jobs.vue'

const props = defineProps({
  topCategoriesJobs: Array
});

// onMounted(() => {
//     initNavAndTabs();

// });
const leftTasks = computed(() => {
  const half = Math.ceil(props.topCategoriesJobs.length / 2)
  return props.topCategoriesJobs.slice(0, half)
})

const rightTasks = computed(() => {
  const half = Math.ceil(props.topCategoriesJobs.length / 2)
  return props.topCategoriesJobs.slice(half)
})

const categoryIds = computed(() => {
  return [...new Set(props.topCategoriesJobs.map(job => job.category_id))];
});

</script>

<template>
    <section class="py-20 dark:bg-neutral-800">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 gap-5">
                <div class="text-center">
                    <h3 class="mb-3 text-3xl text-gray-900 dark:text-gray-50">{{useTrans('page.top_category_jobs.h3')}}</h3>
                    <p class="mb-5 text-gray-500 whitespace-pre-line dark:text-gray-300">{{useTrans('page.top_category_jobs.p')}}</p>
                </div>
            </div>
            <div class="grid grid-cols-12 gap-y-8 lg:gap-8">
                <div class="col-span-12 space-y-8 lg:col-span-6">
                    <Jobs :jobs="leftTasks" />
                </div>
                <div class="col-span-12 space-y-8 lg:col-span-6">
                    <Jobs :jobs="rightTasks" />

                </div>
            </div>
            <div class="grid grid-cols-1">
                <div class="mt-5 text-center">
                    <Link :href="route('jobs', { locale: $page.props.locale, category_ids: categoryIds })" class="text-white border-transparent group-data-[theme-color=green]:bg-green-500 btn hover:-translate-y-2">{{ useTrans('page.jobs.view_more') }} <i class="uil uil-arrow-right ms-1"></i></Link>
                </div>
            </div>
        </div>
    </section>

</template>

