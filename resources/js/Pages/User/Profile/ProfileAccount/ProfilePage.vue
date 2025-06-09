<script setup>
import '../../../../../../public/assets/user/libs/glightbox/css/glightbox.min.css';

import Index from '../Index.vue';
import Update from './Update.vue';
import Info from './Info.vue';
import SelectedSubCategories from './SelectSubCategories.vue';
import ChangePassword from './ChangePassword.vue';


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
                                                    <SelectedSubCategories
                                                        :categories="props.categories"
                                                        :selectedSubCategories="props.user.executor_sub_categories"
                                                    />
                                                </div>

                                               <!-- Change Password -->
                                                <div class="hidden w-full tab-pane" id="password-tab">
                                                    <ChangePassword :locale="props.locale" />
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


