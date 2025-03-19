<script setup>
import { computed, onMounted} from "vue";
import { useTrans } from '/resources/js/trans';
import { Head, Link } from '@inertiajs/vue3';
import Jobs from '@/Components/Jobs.vue'
import initNavAndTabs from "@/modules/user/nav&tabs.js";

const props = defineProps({
    jobs: Array,
});

onMounted(() => {
    initNavAndTabs();

});

const taskType0 = computed(() => props.jobs.filter(job => job.task_type === 0))
const taskType1 = computed(() => props.jobs.filter(job => job.task_type === 1))

</script>

<template>
    <section class="py-20 bg-gray-50 dark:bg-neutral-700">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 gap-5">
                <div class="mb-5 text-center">
                    <h3 class="mb-3 text-3xl text-gray-900 dark:text-gray-50">{{useTrans('page.jobs.h3')}}</h3>
                    <p class="mb-5 text-gray-500 whitespace-pre-line dark:text-gray-300">{{useTrans('page.jobs.p')}}</p>
                </div>
            </div>
            <div class="nav-tabs chart-tabpill">
                <div class="grid grid-cols-12">
                    <div class="col-span-12 lg:col-span-8 lg:col-start-3">
                        <div class="p-1.5 bg-white dark:bg-neutral-900 shadow-lg shadow-gray-100/30 rounded-lg dark:shadow-neutral-700">
                            <ul class="items-center text-sm font-medium text-center text-gray-700 nav md:flex">
                                <li class="w-full">
                                    <a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="recent-job" class="inline-block w-full py-[12px] px-[18px] dark:text-gray-50 active" aria-current="page">{{useTrans('page.jobs.all')}}</a>
                                </li>
                                <li class="w-full">
                                    <a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="featured-jobs-tab" class="inline-block w-full py-[12px] px-[18px] dark:text-gray-50">{{useTrans('page.jobs.remote')}}</a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-content">
                    <div class="block w-full tab-pane" id="recent-job">
                        <div class="pt-8 ">
                            <Jobs :jobs="taskType0" />
                        </div>
                    </div>

                    <div class="hidden w-full tab-pane" id="featured-jobs-tab">
                        <div class="pt-8 ">
                            <Jobs :jobs="taskType1" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8">
                <div class="grid grid-cols-1">
                    <div class="text-center">
                        <Link :href="route('jobs', { locale: $page.props.locale })" class="text-white border-transparent group-data-[theme-color=green]:bg-green-500 btn focus:ring focus:ring-custom-500/20">{{ useTrans('page.jobs.view_more') }}<i class="uil uil-arrow-right ms-1"></i></Link>
                    </div>
                </div>
            </div>
        </div>
    </section>

</template>

