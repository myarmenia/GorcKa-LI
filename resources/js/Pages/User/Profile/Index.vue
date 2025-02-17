<script setup>
import Layout from '@/Layouts/User/Layout.vue';
import { Head } from '@inertiajs/vue3';
import Sidebar from './Sidebar.vue';





</script>

<template>
    <Layout>
        <Head title = "Profile" />
        <section class="pt-28 lg:pt-44 pb-28 group-data-[theme-color=violet]:bg-violet-500 group-data-[theme-color=sky]:bg-sky-500 group-data-[theme-color=red]:bg-red-500 group-data-[theme-color=green]:bg-green-500 group-data-[theme-color=pink]:bg-pink-500 group-data-[theme-color=blue]:bg-blue-500 dark:bg-neutral-900 bg-[url('../images/home/page-title.png')] bg-center bg-cover relative" >
                    <div class="container mx-auto">
                        <div class="grid">
                            <div class="col-span-12">
                                <div class="text-center text-white">
                                    <h3 class="mb-4 text-[26px]">My Profile</h3>
                                    <div class="page-next">
                                        <nav class="inline-block" aria-label="breadcrumb text-center">
                                            <ol class="flex justify-center text-sm font-medium uppercase">
                                                <li><a href="index.html">Home</a></li>
                                                <li><i class="bx bxs-chevron-right align-middle px-2.5"></i><a href="javascript:void(0)">My Profile</a></li>
                                                <li class="active" aria-current="page"><i class="bx bxs-chevron-right align-middle px-2.5"></i>My Profile</li>
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

                <!-- Start grid -->
                    <section class="py-20">
                        <div class="container mx-auto">
                            <div class="grid grid-cols-12 gap-y-10 lg:gap-10">
                                <Sidebar /> <!-- Sidebar Component -->

                                <div class="col-span-12 lg:col-span-8">
                                    <div class="border rounded border-gray-100/50 dark:border-neutral-600 nav-tabs bottom-border-tab">
                                        <!-- <div class="px-6 py-0 border-b border-gray-100/50 dark:border-neutral-600">

                                            <ul class="items-center text-sm font-medium text-center text-gray-700 nav md:flex">
                                                <li class="active" role="presentation">
                                                    <button class="inline-block w-full py-4 px-[18px] dark:text-gray-50 active"  data-tw-toggle="tab" type="button" data-tw-target="overview-tab">
                                                        Overview
                                                    </button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="inline-block w-full py-4 px-[18px] dark:text-gray-50" data-tw-toggle="tab" type="button" data-tw-target="settings-tab">
                                                        Settings
                                                    </button>
                                                </li>
                                            </ul>
                                        </div> -->

                                            <div class="p-6 tab-content">

                                                <div class=" w-full tab-pane" id="settings-tab">
                                                    <slot name="content"></slot>

                                                </div>

                                            </div>



                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                <!-- End grid -->

    </Layout>

</template>
