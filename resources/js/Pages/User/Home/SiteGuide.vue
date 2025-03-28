<script setup>
import { computed, onMounted} from "vue";
import { useTrans } from '/resources/js/trans';
import initNavAndTabs from "@/modules/user/nav&tabs.js";

onMounted(() => {
    initNavAndTabs();
});

</script>

<template>
    <section class="py-20 dark:bg-neutral-800">
        <div class="container mx-auto">
            <div class="nav-tabs round-pill">
                <div class="grid items-center grid-cols-12 gap-5">
                    <div class="col-span-12 lg:col-span-6">
                        <h3 class="mb-3 text-3xl text-gray-900 dark:text-gray-50">{{useTrans('page.site_guide.h3')}}</h3>
                        <div class="mt-5">
                            <ul class="text-gray-700 nav">
                                <li class="w-full mb-[22px]">
                                    <a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="v-pills-home-tab" class="relative inline-block w-full p-2 group active group/active" aria-current="page">
                                    <div class="after:content-[''] after:h-[65px] after:border after:border-dashed after:border-gray-100 after:absolute ltr:after:left-7 rtl:after:right-7 after:-bottom-5 after:group-[.active]:bg-green-300 hidden md:block"></div>
                                        <div class="flex">
                                            <div class="shrink-0 h-10 w-10 rounded-full text-center bg-gray-500/20 group-[.active]:bg-green-500">
                                                <span class="text-gray-900 group-[.active]:text-white text-16 leading-[2.5] dark:text-gray-50">1</span>
                                            </div>
                                            <div class="grow ltr:ml-4 rtl:mr-4">
                                                <h5 class="fs-18 text-gray-900 group-[.active]:text-green-500 dark:text-gray-50">{{useTrans('page.site_guide.h5_1')}}</h5>
                                                <p class="mt-1 mb-2 text-gray-500">{{useTrans('page.site_guide.p_1')}}</p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="w-full mb-[22px]">
                                    <a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="v-pills-profile" class="relative inline-block w-full p-2 group" aria-current="page">
                                    <div class="after:content-[''] after:h-[65px] after:border after:border-dashed after:border-gray-100 after:absolute ltr:after:left-7 rtl:after:right-7 after:-bottom-5 after:group-[.active]:bg-green-300 hidden md:block"></div>
                                        <div class="flex">
                                            <div class="shrink-0 h-10 w-10 rounded-full text-center bg-gray-500/20 group-[.active]:bg-green-500">
                                                <span class="text-gray-900 group-[.active]:text-white text-16 leading-[2.5] dark:text-gray-50">2</span>
                                            </div>
                                            <div class="grow ltr:ml-4 rtl:mr-4">
                                                <h5 class="fs-18 text-gray-900 group-[.active]:text-green-500 dark:text-gray-50">{{useTrans('page.site_guide.h5_2')}}</h5>
                                                <p class="mt-1 mb-2 text-gray-500">{{useTrans('page.site_guide.p_2')}}</p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="w-full mb-[22px]">
                                    <a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="v-pills-messages" class="relative inline-block w-full p-2 group" aria-current="page">
                                        <div class="flex">
                                            <div class="shrink-0 h-10 w-10 rounded-full text-center bg-gray-500/20 group-[.active]:bg-green-500">
                                                <span class="text-gray-900 group-[.active]:text-white text-16 leading-[2.5] dark:text-gray-50">3</span>
                                            </div>
                                            <div class="grow ltr:ml-4 rtl:mr-4">
                                                <h5 class="fs-18 text-gray-900 group-[.active]:text-green-500 dark:text-gray-50">{{useTrans('page.site_guide.h5_3')}}</h5>
                                                <p class="mt-1 mb-2 text-gray-500">{{useTrans('page.site_guide.p_3')}}</p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <div class="col-span-12 lg:col-span-6">
                        <div class="tab-content">
                            <div class="block tab-pane" id="v-pills-home-tab">
                                <img src="/assets/user/images/process-01.png" alt="" class="max-w-full">
                            </div>
                            <div class="hidden tab-pane" id="v-pills-profile">
                                <img src="/assets/user/images/process-03.png" alt="" class="max-w-full">
                            </div>
                            <div class="hidden tab-pane" id="v-pills-messages">
                                <img src="/assets/user/images/process-02.png" alt="" class="max-w-full">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

