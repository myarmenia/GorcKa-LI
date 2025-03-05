<script setup>
import { Head, usePage ,Link } from '@inertiajs/vue3';
import Index from './Index.vue';
import { useTrans } from '/resources/js/trans';


const props = defineProps({
        tasks: Array,
        locale: String
});
const {tasks} = usePage().props;
console.log(tasks)


</script>
<template>
    <Index>
        <Head title = "Task-list" />
        <template #content>
            <div class="mt-14">
                <div v-for="task in tasks" class="relative mt-4 overflow-hidden transition-all duration-500 ease-in-out bg-white border rounded-md border-gray-100/50 group/job group-data-[theme-color=violet]:hover:border-violet-500 group-data-[theme-color=sky]:hover:border-sky-500 group-data-[theme-color=red]:hover:border-red-500 group-data-[theme-color=green]:hover:border-green-500 group-data-[theme-color=pink]:hover:border-pink-500 group-data-[theme-color=blue]:hover:border-blue-500 hover:-translate-y-2 dark:bg-neutral-900 dark:border-neutral-600">
                    <div class="w-48 absolute -top-[5px] -left-20 -rotate-45 group-data-[theme-color=violet]:bg-violet-500/20 group-data-[theme-color=sky]:bg-sky-500/20 group-data-[theme-color=red]:bg-red-500/20 group-data-[theme-color=green]:bg-green-500/20 group-data-[theme-color=pink]:bg-pink-500/20 group-data-[theme-color=blue]:bg-blue-500/20 group-data-[theme-color=violet]:group-hover/job:bg-violet-500 group-data-[theme-color=sky]:group-hover/job:bg-sky-500 group-data-[theme-color=red]:group-hover/job:bg-red-500 group-data-[theme-color=green]:group-hover/job:bg-green-500 group-data-[theme-color=pink]:group-hover/job:bg-pink-500 group-data-[theme-color=blue]:group-hover/job:bg-blue-500 transition-all duration-500 ease-in-out p-[6px] text-center dark:bg-violet-500/20">
                        <a href="javascript:void(0)" class="text-2xl text-white align-middle"><i class="mdi mdi-star"></i></a>
                    </div>
                    <div class="p-4">
                        <div class="grid items-center grid-cols-12">
                            <div class="col-span-12 lg:col-span-2">
                                <div class="mb-4 text-center mb-md-0">
                                    <a href="company-details.html"><img src="assets/user/images/featured-job/img-01.png" alt="" class="mx-auto img-fluid rounded-3"></a>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-span-12 lg:col-span-3">
                                <div class="mb-2 mb-md-0">
                                    <h5 class="mb-1 fs-18"><a href="job-details.html" class="text-gray-900 dark:text-gray-50">{{ task.title }}</a>
                                    </h5>
                                    <p class="mb-0 text-gray-500 fs-14 dark:text-gray-300">Creative Agency</p>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-span-12 lg:col-span-3">
                                <div class="mb-2 lg:flex">
                                    <div class="flex-shrink-0">
                                        <i class="mr-1 mdi mdi-map-marker group-data-[theme-color=violet]:text-violet-500 group-data-[theme-color=sky]:text-sky-500 group-data-[theme-color=red]:text-red-500 group-data-[theme-color=green]:text-green-500 group-data-[theme-color=pink]:text-pink-500 group-data-[theme-color=blue]:text-blue-500"></i>
                                    </div>
                                    <p class="mb-0 text-gray-500 dark:text-gray-300">Escondido,California</p>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-span-12 lg:col-span-2">
                                <div>
                                    <p class="mb-0 text-gray-500 dark:text-gray-300"> <i class="mr-1 uil uil-clock-three group-data-[theme-color=violet]:text-violet-500 group-data-[theme-color=sky]:text-sky-500 group-data-[theme-color=red]:text-red-500 group-data-[theme-color=green]:text-green-500 group-data-[theme-color=pink]:text-pink-500 group-data-[theme-color=blue]:text-blue-500"></i> 3 min ago</p>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-span-12 lg:col-span-2">
                                <div class="flex flex-wrap gap-1.5">
                                    <span class="bg-green-500/20 text-green-500 text-13 px-2 py-0.5 font-medium rounded">

                                        <Link :href="route('task.edit',{id:task.id,locale:usePage().props.locale})" >
                                             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-600 hover:text-blue-500 cursor-pointer">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 3.487a2.25 2.25 0 1 1 3.182 3.182L8.317 18.397a4.5 4.5 0 0 1-1.89 1.128l-4.06 1.277a.375.375 0 0 1-.475-.474l1.277-4.06a4.5 4.5 0 0 1 1.128-1.89L16.862 3.487z" />
                                        </svg>

                                        </Link>

                                    </span>
                                    <span class="bg-green-500/20 text-green-500 text-13 px-2 py-0.5 font-medium rounded">Full Time</span>
                                </div>

                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div>
                    <div class="px-4 py-3 bg-gray-50 dark:bg-neutral-700">
                        <div class="grid grid-cols-12">
                            <div class="col-span-12 lg:col-span-6">
                                <div>
                                    <p class="mb-0 text-gray-500 dark:text-gray-300"><span class="font-medium text-gray-900 dark:text-gray-50"> {{useTrans('page.start_date')}} {{ task.start_date }} - {{useTrans('page.end_date')}} {{task.end_date  }}</span> </p>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-span-12 mt-2 lg:col-span-6 lg:mt-0">
                                <div class="ltr:lg:text-right rtl:lg:text-left dark:text-gray-50">
                                    <a href="#applyNow" data-bs-toggle="modal">Apply Now <i class="mdi mdi-chevron-double-right"></i></a>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div>
                </div>
            </div>
        </template>

    </Index>

</template>
