<script setup>
import { useTrans } from '/resources/js/trans';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    jobs: Array,
});


</script>

<template>
    <div v-if="(Array.isArray(props.jobs) && props.jobs.length > 0) || (typeof props.jobs === 'object' && Object.keys(props.jobs).length > 0)">
        <div v-for="job in props.jobs" :key="job.id" class="relative mt-4 overflow-hidden transition-all duration-500 ease-in-out bg-white border rounded-md border-gray-100/50 group/jobs group-data-[theme-color=green]:hover:border-green-500 hover:-translate-y-2 dark:bg-neutral-900 dark:border-neutral-600">
            <div class="w-48 absolute -top-[5px] -left-20 -rotate-45 group-data-[theme-color=green]:bg-green-500/20 group-data-[theme-color=green]:group-hover/jobs:bg-green-500 transition-all duration-500 ease-in-out p-[6px] text-center dark:bg-violet-500/20">
                <a href="javascript:void(0)" class="text-2xl text-white align-middle"><i class="uil uil-star"></i></a>
            </div>
            <div class="p-4">
                <div class="grid items-center grid-cols-12">
                    <div class="col-span-12 lg:col-span-2">
                        <div class="mb-4 text-center mb-md-0">
                            <a href="company-details.html">
                                <img :src="job.category_icon
                                                ? `/assets/user/icons/categories/${job.category_icon}.svg`
                                                : `/assets/user/icons/categories/it.svg`"
                                        alt="" class="mx-auto img-fluid rounded-3 w-1/3">
                            </a>
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-span-12 lg:col-span-3">
                        <div class="mb-2 mb-md-0">
                            <h5 class="mb-1 fs-18"><a href="job-details.html" class="text-gray-900 dark:text-gray-50">{{job.title}}</a>
                            </h5>
                            <!-- <p class="mb-0 text-gray-500 fs-14 dark:text-gray-300">Web Technology pvt.Ltd</p> -->
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-span-12 lg:col-span-3">
                        <div class="mb-2 lg:flex">
                            <div class="flex-shrink-0">
                                <i class="mr-1 group-data-[theme-color=violet]:text-violet-500 group-data-[theme-color=sky]:text-sky-500 group-data-[theme-color=red]:text-red-500 group-data-[theme-color=green]:text-green-500 group-data-[theme-color=pink]:text-pink-500 group-data-[theme-color=blue]:text-blue-500 uil uil-map-marker"></i>
                            </div>
                            <p class="mb-0 text-gray-500 dark:text-gray-300">{{job.translation_name}}</p>
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-span-12 lg:col-span-2">
                        <div>
                            <p class="mb-2 text-gray-500 dark:text-gray-300"><span class="group-data-[theme-color=violet]:text-violet-500 group-data-[theme-color=sky]:text-sky-500 group-data-[theme-color=red]:text-red-500 group-data-[theme-color=green]:text-green-500 group-data-[theme-color=pink]:text-pink-500 group-data-[theme-color=blue]:text-blue-500">

                                </span>{{job.price_min ? job.price_min + ' - ':  ' '}}  {{job.price_max}} ֏</p>
                        </div>
                    </div>

                    <div v-if="job.task_type === 1" class="col-span-12 lg:col-span-2">
                        <div class="flex flex-wrap gap-1.5">
                            <span class="badge bg-green-500/20 text-green-500 text-13 px-2 py-0.5 font-medium rounded">{{useTrans('page.jobs.remote')}}</span>
                            <!-- <span class="badge bg-sky-500/20 text-sky-500 text-13 px-2 py-0.5 font-medium rounded">Private</span> -->
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>

            <div class="p-3 bg-gray-50 dark:bg-neutral-700">
                <div class="grid grid-cols-12">
                    <div class="col-span-12 lg:col-span-6">
                        <div>
                            <p class="mb-0 text-gray-500 dark:text-gray-300"><span class="text-gray-900 dark:text-gray-50">{{useTrans('page.jobs.execution_time')}} </span> {{job.start_date ? job.start_date + ' - ' : ' ' }}  {{ job.end_date }}</p>
                        </div>
                    </div>
                    <!--end col-->

                    <div class="col-span-12 lg:col-span-5">
                        <div class="text-start lg:text-end dark:text-gray-50">
                            <!-- <Link :href="route('single_job', { locale: $page.props.locale, id: job.id })">{{useTrans('page.jobs.apply_now')}} <i class="mdi mdi-chevron-double-right"></i></Link> -->
                            <Link v-if="$page.props.auth.user != null && ($page.props.auth.user.id == job.applicant_auth_id) "
                                    :href="route('single_job', { locale: $page.props.locale, id: job.id })" >
                                          {{ useTrans('page.jobs.you_applied') }}
                                        <i class="mdi mdi-chevron-double-right"></i>
                            </Link>
                            <Link v-else :href="route('single_job', { locale: $page.props.locale, id: job.id })">{{useTrans('page.jobs.apply_now')}} <i class="mdi mdi-chevron-double-right"></i></Link>

                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
            </div>
        </div>
    </div>
    <div v-else class="space-y-8 text-center">{{ useTrans('page.jobs.no_result') }}</div>


</template>

