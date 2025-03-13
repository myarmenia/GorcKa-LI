<script setup>
import Layout from '@/Layouts/User/Layout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { computed } from "vue";
import { useTrans } from '/resources/js/trans';

const props = defineProps({
  locale: String,
  categories: Array,
});

const categoryItems = computed(() => {
    return props.categories.map(category => ({
        name: category.translation?.name,
        icon: category.icon
            ? `assets/user/icons/categories/${category.icon}.png`
            : `assets/user/icons/categories/default.png`,
        tasks_count: category.tasks_count
    }));
});

const partOne = computed(() => {
    return categoryItems.value.slice(0, Math.ceil(categoryItems.value.length / 3));
});

const partTwo = computed(() => {
    return categoryItems.value.slice(Math.ceil(categoryItems.value.length / 3), Math.ceil(2 * categoryItems.value.length / 3));
});

const partThree = computed(() => {
    return categoryItems.value.slice(Math.ceil(2 * categoryItems.value.length / 3));
});

</script>

<template>
    <Layout>
        <Head :title="useTrans('page.title')" />
        <section class="pt-28 lg:pt-44 pb-28 group-data-[theme-color=green]:bg-green-500 dark:bg-neutral-900 bg-[url('../images/home/page-title.png')] bg-center bg-cover relative" >
            <div class="container mx-auto">
                <div class="grid">
                    <div class="col-span-12">
                        <div class="text-center text-white">
                            <h3 class="mb-4 text-[26px]">{{useTrans('page.title')}}</h3>
                            <div class="page-next">
                                <nav class="inline-block" aria-label="breadcrumb text-center">
                                    <ol class="flex flex-wrap justify-center text-sm font-medium uppercase">
                                        <li><Link :href="route('welcome', { locale: $page.props.locale })" class="text-white block ">{{useTrans('navbar.home')}}</Link></li>
                                        <li class="active" aria-current="page"><i class="bx bxs-chevron-right align-middle px-2.5"></i>{{useTrans('page.title')}}</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <img src="/assets/user/images/about/shape.png" alt="" class="absolute block bg-cover -bottom-0 dark:hidden">
            <img src="/assets/user/images/about/shape-dark.png" alt="" class="absolute hidden bg-cover -bottom-0 dark:block">
        </section>

        <section class="py-20">
            <div class="container mx-auto">
                <div class="grid grid-cols-12 gap-y-10 lg:gap-10">
                    <div class="col-span-12 lg:col-span-6 lg:col-start-4">
                        <div class="mb-5 text-center">
                            <h4 class="mt-2 text-gray-900 text-22 dark:text-white">{{useTrans('page.h4')}}</h4>
                            <p class="mt-2 text-gray-500 dark:text-gray-300">{{useTrans('page.p')}}</p>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-12 gap-y-5 md:gap-8">
                    <div class="col-span-12 md:col-span-6 xl:col-span-4">
                        <div class="mt-10 rounded bg-gray-50 dark:bg-neutral-700">
                            <div class="p-6">
                                <ul class="space-y-4">
                                    <li v-for="(category, index) in partOne" class="px-4 py-2 bg-white rounded dark:bg-neutral-600">
                                        <a href="job-list.html" class="text-gray-900 dark:text-white">{{category.name}}
                                            <span class="px-2 py-1 rounded bg-sky-500/20 text-11 text-sky-500 ltr:float-right rtl:float-left">{{ category.tasks_count }}</span>
                                        </a>
                                        <!-- <Link :href="route('jobs', { locale: $page.props.locale })" class="text-white block ">{{category.name}}</Link> -->
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 xl:col-span-4">
                        <div class="mt-10 rounded bg-gray-50 dark:bg-neutral-700">
                            <div class="p-6">
                                <ul class="space-y-4">
                                    <li v-for="(category, index) in partTwo" class="px-4 py-2 bg-white rounded dark:bg-neutral-600">
                                        <a href="job-list.html" class="text-gray-900 dark:text-white">{{category.name}}
                                             <span class="px-2 py-1 rounded bg-sky-500/20 text-11 text-sky-500 ltr:float-right rtl:float-left">{{ category.tasks_count }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 xl:col-span-4">
                        <div class="mt-10 rounded bg-gray-50 dark:bg-neutral-700">
                            <div class="p-6">
                                <ul class="space-y-4">
                                    <li v-for="(category, index) in partThree" class="px-4 py-2 bg-white rounded dark:bg-neutral-600">
                                        <a href="job-list.html" class="text-gray-900 dark:text-white">{{category.name}}
                                            <span class="px-2 py-1 rounded bg-sky-500/20 text-11 text-sky-500 ltr:float-right rtl:float-left">{{ category.tasks_count }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </Layout>
</template>

