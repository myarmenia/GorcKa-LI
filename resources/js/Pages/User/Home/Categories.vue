<script setup>
import { computed } from "vue";
import { useTrans } from '/resources/js/trans';
import { Head, Link } from '@inertiajs/vue3';

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


</script>

<template>
    <section class="py-20 dark:bg-neutral-800">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 gap-5">
                <div class="text-center">
                    <h3 class="mb-3 text-3xl text-gray-900 dark:text-gray-50">{{useTrans('page.categories.h3')}}</h3>
                    <p class="mb-5 text-gray-500 whitespace-pre-line dark:text-gray-300">{{useTrans('page.categories.p')}}</p>
                </div>
            </div>
            <div class="grid grid-cols-12 gap-5">
                <div v-for="(category, index) in categoryItems" class="col-span-12 md:col-span-6 lg:col-span-3">
                    <div class="mt-4">
                        <div class="px-6 py-5 transition-all duration-500 ease-in-out cursor-pointer lg:py-10 hover:-translate-y-2">
                            <div class="flex justify-center items-center job-categorie h-16 w-16 group-data-[theme-color=green]:bg-green-500/20 rounded-lg text-center leading-[4.4] mx-auto dark:bg-violet-900">
                                <img :src="category.icon" class="" />
                            </div>
                            <div class="mt-4 text-center">
                                <a href="job-categories.html" class="text-gray-900">
                                    <h5 class="text-lg dark:text-gray-50">{{category.name}}</h5>
                                </a>
                                <p class="mt-1 font-medium text-gray-500 dark:text-gray-300">{{category.tasks_count}}</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="grid grid-cols-1">
                <div class="mt-5 text-center">
                    <Link :href="route('categories', { locale: $page.props.locale })" class="text-white border-transparent group-data-[theme-color=green]:bg-green-500 btn hover:-translate-y-2">{{ useTrans('page.categories.link') }} <i class="uil uil-arrow-right ms-1"></i></Link>
                </div>
            </div>
        </div>
    </section>

</template>

