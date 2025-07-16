<script setup>
import '../../../../../../public/assets/user/libs/glightbox/css/glightbox.min.css';

import Index from '../Index.vue';
import Update from './Update.vue';
import Info from './Info.vue';
import SelectedSubCategories from './SelectSubCategories.vue';
import ChangePassword from './ChangePassword.vue';
import SubCategoryTags from './SubCategoryTags.vue'

import { ref, onMounted, watch } from "vue";
import { Head } from '@inertiajs/vue3';
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

// Массив для ID выбранных подкатегорий
const selectedIds = ref([]);

// Подкатегории с именами
const selectedSubCategories = ref(props.user.executor_sub_categories || []);

watch(
  () => props.user.executor_sub_categories,
  (newValue) => {
    const raw = newValue || [];
    selectedIds.value = raw.map(sub => sub.id);

    const updated = [];

    raw.forEach(sub => {
      props.categories.forEach(category => {
        const found = category.sub_categories.find(s => s.id === sub.id);
        if (found) {
          updated.push({
            id: found.id,
            name: found.name,
            color: category.color
          });
        }
      });
    });

    selectedSubCategories.value = updated;
  },
  { immediate: true }
);



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
                                                        {{ useTrans('page.nav.main') }}
                                                    </button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="inline-block w-full py-4 px-[18px] dark:text-gray-50" data-tw-toggle="tab" type="button" data-tw-target="settings-tab">
                                                        {{ useTrans('page.nav.personal_information') }}
                                                    </button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="inline-block w-full py-4 px-[18px] dark:text-gray-50" data-tw-toggle="tab" type="button" data-tw-target="subcategories-tab">
                                                      {{ useTrans('page.nav.select_categories') }}
                                                    </button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="inline-block w-full py-4 px-[18px] dark:text-gray-50" data-tw-toggle="tab" type="button" data-tw-target="password-tab">
                                                        {{ useTrans('page.nav.change_password') }}
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>

                                            <div class="p-6 tab-content block">
                                                <div class="block w-full tab-pane" id="overview-tab">
                                                    <div class="mt-2 space-y-8">
                                                        <div>
                                                            <h5 class="text-lg font-bold text-gray-900 dark:text-gray-50">{{useTrans('page.main.about')}}</h5>
                                                            <p class="mt-4 text-gray-500 dark:text-gray-300">
                                                                {{props.user.description}}
                                                            </p>

                                                        </div>
                                                    </div>

                                                    <div class="mt-2 space-y-8">
                                                        <div>
                                                            <h5 class="text-lg font-bold text-gray-900 dark:text-gray-50">{{useTrans('page.main.works')}}</h5>
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
                                                        <h6 class="text-lg font-bold text-gray-900 dark:text-gray-50">{{useTrans('page.main.selected_categories')}}</h6>
                                                        <SubCategoryTags
                                                            :subCategories="selectedSubCategories"
                                                            :withRemove="false"
                                                        />
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
                                                        @update:selectedSubCategories="selectedSubCategories = $event"
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


