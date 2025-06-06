<script setup>
import '../../../../../../public/assets/user/libs/glightbox/css/glightbox.min.css';

import Index from '../Index.vue';
import Update from './Update.vue';
import Info from './Info.vue';
import SelectedSubCategories from './SelectSubCategories.vue';

import { computed, ref, reactive, onMounted, watch, onUnmounted, nextTick } from "vue";
import { Head} from '@inertiajs/vue3';
import initNavAndTabs from "@/modules/user/nav&tabs.js";
import { initLightbox } from '@/modules/user/lightbox.init.js';
import gFunLightbox from '@/modules/user/glightbox.min';
import { useTrans } from '/resources/js/trans';

onMounted(() => {
    gFunLightbox();
    initLightbox();
    initNavAndTabs();

});

const props = defineProps({
  locations: Array,
  langs: Array,
  locale: String,
  categories: Array,
  socialMedias: Array,
  user: Object,
  defaultAvatar: {
    type: String,
    default: '/assets/user/images/user.svg',
  },
});

console.log(props.user, 11111111111111)


</script>

<template>
    <Index>
        <Head title = "Account" />
        <template #content>
             <!-- Start grid -->
             <section class="">
                        <div class="container mx-auto p-0">
                            <div class="grid grid-cols-12 gap-y-10 lg:gap-10">
                                <div class="col-span-12 lg:col-span-4">
                                    <Info
                                        :user="props.user"
                                        :locations="locations"
                                        :socialMedias="props.socialMedias"
                                    />
                                </div>
                                <div class="col-span-12 lg:col-span-8">
                                    <div class="border rounded border-gray-100/50 dark:border-neutral-600 nav-tabs bottom-border-tab">
                                        <div class="px-6 py-0 border-b border-gray-100/50 dark:border-neutral-600">

                                            <ul class="items-center text-sm font-medium text-center text-gray-700 nav md:flex">
                                                <li class="active" role="presentation">
                                                    <button class="inline-block w-full py-4 px-[18px] dark:text-gray-50 active"  data-tw-toggle="tab" type="button" data-tw-target="overview-tab">
                                                        Overview 1
                                                    </button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="inline-block w-full py-4 px-[18px] dark:text-gray-50" data-tw-toggle="tab" type="button" data-tw-target="settings-tab">
                                                        Settings 2
                                                    </button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="inline-block w-full py-4 px-[18px] dark:text-gray-50" data-tw-toggle="tab" type="button" data-tw-target="subcategories-tab">
                                                       Select Sub categories
                                                    </button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="inline-block w-full py-4 px-[18px] dark:text-gray-50" data-tw-toggle="tab" type="button" data-tw-target="password-tab">
                                                        Change Password
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>

                                            <div class="p-6 tab-content block">
                                                <div class="block w-full tab-pane" id="overview-tab">
                                                    <div class="mt-2 space-y-8">
                                                        <div>
                                                            <h5 class="text-lg font-bold text-gray-900 dark:text-gray-50">About</h5>
                                                            <p class="mt-4 text-gray-500 dark:text-gray-300">
                                                                {{props.user.description}}
                                                            </p>

                                                        </div>
                                                    </div>

                                                    <div class="mt-2 space-y-8">
                                                        <div>
                                                            <h5 class="text-lg font-bold text-gray-900 dark:text-gray-50">Works</h5>
                                                            <div class="mt-4 ">
                                                                <div class="grid grid-cols-12 gap-5 ">
                                                                    <div v-for="file in props.user.files" class="col-span-4 ">
                                                                        <div class="relative overflow-hidden rounded-md group/project h-[160px]">
                                                                            <img :src="`/storage/${file.path}`" alt="" class="transition-all duration-300 ease-in-out group-hover/project:scale-110">
                                                                            <div class="transition-all duration-300 ease-in-out group-hover/project:bg-black/40 group-hover/project:absolute group-hover/project:inset-0"></div>
                                                                            <div class="absolute top-[50%] left-[50%] -translate-x-5 -translate-y-5 group-hover/project:block hidden transition-all duration-300 ease-in-out text-2xl">
                                                                                <a :href="`/storage/${file.path}`" class="text-white image-popup" ><i class="uil uil-search-alt"></i></a>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="mt-6">
                                                        <h6 class="text-lg font-bold text-gray-900 dark:text-gray-50">Skills</h6>
                                                        <div class="flex flex-wrap gap-3 mt-3">
                                                            <span class="mt-2 text-13 px-2 py-0.5 bg-violet-500/20 text-violet-500 rounded font-medium">Cloud Management</span>
                                                            <span class="mt-2 text-13 px-2 py-0.5 bg-violet-500/20 text-violet-500 rounded font-medium">Responsive Design</span>
                                                            <span class="mt-2 text-13 px-2 py-0.5 bg-violet-500/20 text-violet-500 rounded font-medium">Network Architecture</span>
                                                            <span class="mt-2 text-13 px-2 py-0.5 bg-violet-500/20 text-violet-500 rounded font-medium">PHP</span>
                                                            <span class="mt-2 text-13 px-2 py-0.5 bg-violet-500/20 text-violet-500 rounded font-medium">Bootstrap</span>
                                                            <span class="mt-2 text-13 px-2 py-0.5 bg-violet-500/20 text-violet-500 rounded font-medium">UI &amp; UX Designer</span>
                                                        </div>
                                                    </div>
                                                    <div class="mt-6">
                                                        <h6 class="text-lg font-bold text-gray-900 dark:text-gray-50">Spoken languages</h6>
                                                        <div class="flex flex-wrap gap-3 mt-3">
                                                            <span class="mt-2 text-13 px-2 py-0.5 bg-red-500/20 text-red-500 rounded font-medium">English</span>
                                                            <span class="mt-2 text-13 px-2 py-0.5 bg-green-500/20 text-green-500 rounded font-medium">German</span>
                                                            <span class="mt-2 text-13 px-2 py-0.5 bg-sky-500/20 text-sky-500 rounded font-medium">French</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="hidden w-full tab-pane" id="settings-tab">
                                                    <Update
                                                        :categories="props.categories"
                                                        :locations="props.locations"
                                                        :langs="props.langs"
                                                        :locale="props.locale"
                                                        :user="props.user"
                                                        :socialMedias="props.socialMedias"
                                                    />

                                                </div>

                                                <div class="hidden w-full tab-pane" id="subcategories-tab">
                                                    <!-- Категория -->
                                                    <SelectedSubCategories :categories="props.categories" />
                                                    <!-- End Select -->
                                                </div>

                                               <!-- Social Media -->
                                                <div class="hidden w-full tab-pane" id="password-tab">
                                                    <div class="pt-8 space-x-8">
                                                        <!-- <form action="#"> -->
                                                        <form  class="mt-8">



                                                            <!--end socia-media-->
                                                            <div class="mt-4">
                                                                <h5 class="mb-3 font-semibold text-17 dark:text-gray-50">
                                                                    Change Password
                                                                </h5>
                                                                <div class="grid grid-cols-12 gap-5">
                                                                    <div class="col-span-12">
                                                                        <div class="mb-3">
                                                                            <label for="current-password-input" class="text-sm text-gray-900 dark:text-gray-50">Current
                                                                                password</label>
                                                                            <input type="password" class="w-full mt-1 text-gray-500 border rounded border-gray-100/50 text-13 dark:bg-transparent dark:border-neutral-600" placeholder="Enter Current password" id="current-password-input">
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                    <div class="col-span-12 lg:col-span-6">
                                                                        <div class="mb-3">
                                                                            <label for="new-password-input" class="text-sm text-gray-900 dark:text-gray-50">New
                                                                                password</label>
                                                                            <input type="password" class="w-full mt-1 text-gray-500 border rounded border-gray-100/50 text-13 dark:bg-transparent dark:border-neutral-600" placeholder="Enter new password" id="new-password-input">
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                    <div class="col-span-12 lg:col-span-6">
                                                                        <div class="mb-3">
                                                                            <label for="confirm-password-input" class="text-sm text-gray-900 dark:text-gray-50">Confirm Password</label>
                                                                            <input type="password" class="w-full mt-1 text-gray-500 border rounded border-gray-100/50 text-13 dark:bg-transparent dark:border-neutral-600" placeholder="Confirm Password" id="confirm-password-input">
                                                                        </div>
                                                                    </div>

                                                                    <!--end col-->
                                                                </div>
                                                                <!--end row-->
                                                            </div>
                                                            <!--end Change-password-->
                                                            <div class="mt-8 text-right">
                                                                <a href="javascript:void(0)" class="text-white btn group-data-[theme-color=violet]:bg-violet-500 group-data-[theme-color=sky]:bg-sky-500 group-data-[theme-color=red]:bg-red-500 group-data-[theme-color=green]:bg-green-500 group-data-[theme-color=pink]:bg-pink-500 group-data-[theme-color=blue]:bg-blue-500 border-transparent focus:ring group-data-[theme-color=violet]:focus:ring-violet-500/20 group-data-[theme-color=sky]:focus:ring-sky-500/20 group-data-[theme-color=red]:focus:ring-red-500/20 group-data-[theme-color=green]:focus:ring-green-500/20 group-data-[theme-color=pink]:focus:ring-pink-500/20 group-data-[theme-color=blue]:focus:ring-blue-500/20">Update</a>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>



                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                <!-- End grid -->
        </template>

    </Index>

</template>


