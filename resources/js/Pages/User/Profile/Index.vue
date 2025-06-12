<script setup>
import Layout from '@/Layouts/User/Layout.vue';
import { Head } from '@inertiajs/vue3';
import Sidebar from './Sidebar.vue';





</script>

<template>
    <Layout>
        <Head title = "Profile" />


                <!-- Start grid -->
                    <section class="py-20 mt-10">
                        <div class="container mx-auto">
                            <div class="grid grid-cols-12 gap-y-10 lg:gap-10">
                                <Sidebar /> <!-- Sidebar Component -->

                                <div class="col-span-12 lg:col-span-10">
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
                                                    <slot name="content"></slot>

                                            <!-- p-6 -y hanel em -->
                                            <!-- <div class="tab-content">

                                                <div class=" w-full tab-pane" id="settings-tab">
                                                    <slot name="content"></slot>

                                                </div>

                                            </div> -->



                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                <!-- End grid -->

    </Layout>

</template>
