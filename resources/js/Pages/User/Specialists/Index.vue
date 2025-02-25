<script setup>
import { computed, watch, ref } from "vue";

import Checkbox from '@/Components/Checkbox.vue';
import Layout from '@/Layouts/User/Layout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import WhiteButton from '@/Components/WhiteButton.vue';
import SearchSelect from '@/Components/SearchSelect.vue';


import { Head, Link, useForm } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import { useTrans } from '/resources/js/trans';

// import '../node_modules/preline/dist/preline'
// import '../../../../../node_modules/preline/dist/select'






const props = defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },

    locations: Array
});


const locationOptions = computed(() =>
  props.locations?.map(location => ({
    value: location.id,
    text: location.translations?.[0]?.name ?? 'Без названия'
  })) ?? []
);


const selectedLocation = ref(null);
const currentLanguage = computed(() => usePage().props.locale);

watch(currentLanguage, () => {
  form.errors = {};
});

const form = useForm({
    email: '',
    password: ''
});

const submit = () => {
    form.post(route('login', { locale: usePage().props.locale }), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Layout>
        <Head :title="useTrans('page.title')" />

        <section class="pt-28 lg:pt-44 pb-28 group-data-[theme-color=violet]:bg-violet-500 group-data-[theme-color=sky]:bg-sky-500 group-data-[theme-color=red]:bg-red-500 group-data-[theme-color=green]:bg-green-500 group-data-[theme-color=pink]:bg-pink-500 group-data-[theme-color=blue]:bg-blue-500 dark:bg-neutral-900 bg-[url('../images/home/page-title.png')] bg-center bg-cover relative" >
                    <div class="container mx-auto">
                        <div class="grid">
                            <div class="col-span-12">
                                <div class="text-center text-white">
                                    <h3 class="mb-4 text-[26px]">Candidate List</h3>
                                    <div class="page-next">
                                        <nav class="inline-block" aria-label="breadcrumb text-center">
                                            <ol class="flex flex-wrap justify-center text-sm font-medium uppercase">
                                                <li><a href="index.html">Home</a></li>
                                                <li><i class="bx bxs-chevron-right align-middle px-2.5"></i><a href="javascript:void(0)">Pages</a></li>
                                                <li class="active" aria-current="page"><i class="bx bxs-chevron-right align-middle px-2.5"></i>Candidate List</li>
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
                            <div class="col-span-12">

                                                        <!-- <SearchSelect /> -->

                                                        <!-- Select -->

<!-- End Select -->
                                <!-- Select -->
<!-- <select  data-hs-select='{
  "hasSearch": true,
  "isSearchDirectMatch": false,
  "searchPlaceholder": "Search...",
  "searchClasses": "block w-full text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 py-2 px-3",
  "searchWrapperClasses": "bg-white p-2 -mx-1 sticky top-0 dark:bg-neutral-900",
  "placeholder": "Select multiple options...",
  "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
  "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 ps-4 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-neutral-600",
  "dropdownClasses": "mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 dark:bg-neutral-900 dark:border-neutral-700",
  "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800",
  "optionTemplate": "<div class=\"flex items-center\"><div class=\"me-2\" data-icon></div><div><div class=\"hs-selected:font-semibold text-sm text-gray-800 \" data-title></div></div><div class=\"ms-auto\"><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-4 text-blue-600\" xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" viewBox=\"0 0 16 16\"><path d=\"M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z\"/></svg></span></div></div>",
  "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
}' class="hidden">
  <option value="">Choose</option>
  <option selected="" value="1" data-hs-select-option='{
    "icon": "<img class=\"shrink-0 size-5 rounded-full\" src=\"https://images.unsplash.com/photo-1659482633369-9fe69af50bfb?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=3&w=320&h=320&q=80\" alt=\"James Collins\" />"}'>
    James Collins
  </option>
  <option value="2" data-hs-select-option='{
    "icon": "<img class=\"shrink-0 size-5 rounded-full\" src=\"https://images.unsplash.com/photo-1541101767792-f9b2b1c4f127?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=3&w=320&h=320&q=80\" alt=\"Amanda Harvey\" />"}'>
    Amanda Harvey
  </option>
  <option value="3" data-hs-select-option='{
    "icon": "<img class=\"shrink-0 size-5 rounded-full\" src=\"https://images.unsplash.com/photo-1601935111741-ae98b2b230b0?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2.5&w=320&h=320&q=80\" alt=\"Costa Quinn\" />"}'>
    Costa Quinn
  </option>

</select> -->


<!-- End Select -->
                                <div class="job-list-header">
                                    <form action="#">
                                        <div class="grid grid-cols-12 lg:gap-3 gap-y-3">
                                            <div class="col-span-12 xl:col-span-3">
                                                <div class="relative filler-job-form">
                                                    <i class="uil uil-briefcase-alt"></i>
                                                    <input type="search" class="w-full filter-job-input-box dark:text-gray-100" id="exampleFormControlInput1" placeholder="Job, company... ">
                                                </div>
                                            </div>
                                            <!--end col-->
                                             <div class="col-span-12 xl:col-span-3">
                                                <div class="relative filler-job-form">
                                                    <i class="uil uil-location-point"></i>
                                                  <div class="">
                                                    <SearchSelect
                                                            id="location_id"
                                                            :options="locationOptions"
                                                            v-model="selectedLocation"
                                                            :autoSelectFirst="false"

                                                        />
                                                  </div>

                                                </div>
                                            </div>


                                            <!--end col-->
                                            <div class="col-span-12 xl:col-span-3">
                                                <a href="javascript:void(0)" class="text-white border-transparent btn group-data-[theme-color=violet]:bg-violet-500 group-data-[theme-color=sky]:bg-sky-500 group-data-[theme-color=red]:bg-red-500 group-data-[theme-color=green]:bg-green-500 group-data-[theme-color=pink]:bg-pink-500 group-data-[theme-color=blue]:bg-blue-500 focus:ring focus:ring-custom-500/30"><i class="uil uil-filter"></i> Fliter</a>
                                                <a href="javascript:void(0)" class="text-white bg-green-500 border-transparent btn focus:ring focus:ring-green-500/30 ltr:ml-1 rtl:mr-1"><i class="uil uil-cog"></i> Advance</a>
                                            </div>
                                            <!--end col-->
                                        </div>
                                        <!--end grid-->
                                    </form>
                                </div>
                            </div>
                            <div class="mt-5">
                                <div class="grid items-center grid-cols-12">
                                    <div class="col-span-12 lg:col-span-8">
                                        <h6 class="mb-0 text-gray-900 fs-16 dark:text-gray-50"> Showing 1 – 8 of 11 results </h6>
                                    </div>

                                </div>
                            </div>

                            <div class="mt-8 space-y-6">
                                <div class="p-4 border border-gray-100/50 rounded-md relative hover:-translate-y-1.5 transition-all duration-500 ease-in-out group-data-[theme-color=violet]:hover:border-violet-500 group-data-[theme-color=sky]:hover:border-sky-500 group-data-[theme-color=red]:hover:border-red-500 group-data-[theme-color=green]:hover:border-green-500 group-data-[theme-color=pink]:hover:border-pink-500 group-data-[theme-color=blue]:hover:border-blue-500 hover:shadow-md hover:shadow-gray-100/30 dark:border-neutral-600 dark:hover:shadow-neutral-900">
                                    <div class="grid items-center grid-cols-12">
                                        <div class="col-span-12 md:col-auto">
                                            <div>
                                                <a href="javascript:void(0)"><img src="/assets/user/images/user/img-01.jpg" alt="" class="w-16 h-16 p-1 rounded-full outline outline-2 outline-gray-100/50 dark:outline-neutral-600"></a>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-span-12 md:col-span-5">
                                            <div class="mt-3 mt-lg-0">
                                                <h5 class="mb-0 text-gray-900 text-19 dark:text-white"><a href="candidate-details.html">Charles Dickens</a> <span class="px-2 py-1 text-sm text-white bg-green-500 rounded"><i class="align-middle mdi mdi-star"></i> 4.8</span></h5>
                                                <p class="mb-2 text-gray-500 text-muted dark:text-gray-300"> Project Manager</p>
                                                <ul class="flex flex-wrap gap-3 text-gray-500 dark:text-gray-300">
                                                    <li class="list-inline-item">
                                                        <i class="mdi mdi-map-marker"></i> Oakridge Lane Richardson
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <i class="uil uil-wallet"></i> $650 / hours
                                                    </li>
                                                </ul>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-span-12 md:col-span-4">
                                            <div class="flex flex-wrap gap-2 mt-2 mt-lg-0">
                                                <span class="px-2 py-1 text-sm font-medium text-green-500 rounded bg-green-500/20">Leader</span>
                                                <span class="px-2 py-1 text-sm font-medium rounded bg-violet-500/20 text-violet-500">Manager</span>
                                                <span class="px-2 py-1 text-sm font-medium text-yellow-500 rounded bg-yellow-500/20">Developer</span>
                                            </div>
                                        </div><!--end col-->
                                    </div><!--end row-->
                                    <div class="absolute top-4 ltr:right-4 rtl:left-4">
                                        <div class="w-8 h-8 text-center text-gray-100 transition-all duration-300 bg-transparent border rounded border-gray-100/50 hover:bg-red-600 hover:text-white dark:border-neutral-600 dark:hover:border-transparent">
                                            <a href="javascript:void(0)"><i class="uil uil-heart-alt text-lg leading-[1.8]"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="p-4 border border-gray-100/50 rounded-md relative hover:-translate-y-1.5 transition-all duration-500 ease-in-out group-data-[theme-color=violet]:hover:border-violet-500 group-data-[theme-color=sky]:hover:border-sky-500 group-data-[theme-color=red]:hover:border-red-500 group-data-[theme-color=green]:hover:border-green-500 group-data-[theme-color=pink]:hover:border-pink-500 group-data-[theme-color=blue]:hover:border-blue-500 hover:shadow-md hover:shadow-gray-100/30 dark:border-neutral-600 dark:hover:shadow-neutral-900">
                                    <div class="grid items-center grid-cols-12">
                                        <div class="col-span-12 md:col-auto">
                                            <div>
                                                <a href="javascript:void(0)"><img src="/assets/user/images/user/img-02.jpg" alt="" class="w-16 h-16 p-1 rounded-full outline outline-2 outline-gray-100/50 dark:outline-neutral-600"></a>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-span-12 md:col-span-5">
                                            <div class="mt-3 mt-lg-0">
                                                <h5 class="mb-0 text-gray-900 text-19 dark:text-gray-50"><a href="candidate-details.html">Gabriel Palmer</a> <span class="px-2 py-1 text-sm text-white bg-yellow-500 rounded"><i class="align-middle mdi mdi-star"></i> 3.4</span></h5>
                                                <p class="mb-2 text-gray-500 text-muted dark:text-gray-300">Gabriel Palmer</p>
                                                <ul class="flex flex-wrap gap-3 text-gray-500 dark:text-gray-300">
                                                    <li class="list-inline-item">
                                                        <i class="mdi mdi-map-marker"></i> Oakridge Lane Richardson
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <i class="uil uil-wallet"></i> $250 / hours
                                                    </li>
                                                </ul>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-span-12 md:col-span-4">
                                            <div class="flex flex-wrap gap-2 mt-2 mt-lg-0">
                                                <span class="px-2 py-1 text-sm font-medium rounded bg-sky-500/20 text-sky-500">design</span>
                                                <span class="px-2 py-1 text-sm font-medium rounded bg-violet-500/20 text-violet-500">Developer</span>
                                            </div>
                                        </div><!--end col-->
                                    </div><!--end row-->
                                    <div class="absolute top-4 ltr:right-4 rtl:left-4">
                                        <div class="w-8 h-8 text-center text-white bg-red-600 rounded">
                                            <a href="javascript:void(0)"><i class="uil uil-heart-alt text-lg leading-[1.9]"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="p-4 border border-gray-100/50 rounded-md relative hover:-translate-y-1.5 transition-all duration-500 ease-in-out group-data-[theme-color=violet]:hover:border-violet-500 group-data-[theme-color=sky]:hover:border-sky-500 group-data-[theme-color=red]:hover:border-red-500 group-data-[theme-color=green]:hover:border-green-500 group-data-[theme-color=pink]:hover:border-pink-500 group-data-[theme-color=blue]:hover:border-blue-500 hover:shadow-md hover:shadow-gray-100/30 dark:border-neutral-600 dark:hover:shadow-neutral-900">
                                    <div class="grid items-center grid-cols-12">
                                        <div class="col-span-12 md:col-auto">
                                            <div>
                                                <a href="javascript:void(0)"><img src="/assets/user/images/user/img-03.jpg" alt="" class="w-16 h-16 p-1 rounded-full outline outline-2 outline-gray-100/50 dark:outline-neutral-600"></a>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-span-12 md:col-span-5">
                                            <div class="mt-3 mt-lg-0">
                                                <h5 class="mb-0 text-gray-900 text-19 dark:text-gray-50"><a href="candidate-details.html">Rebecca Swartz </a> <span class="px-2 py-1 text-sm text-white bg-green-500 rounded"><i class="align-middle mdi mdi-star"></i> 4.3</span></h5>
                                                <p class="mb-2 text-gray-500 text-muted dark:text-gray-300"> Graphic Designer</p>
                                                <ul class="flex flex-wrap gap-3 text-gray-500 dark:text-gray-300">
                                                    <li class="list-inline-item">
                                                        <i class="mdi mdi-map-marker"></i> Oakridge Lane Richardson
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <i class="uil uil-wallet"></i> $380 / hours
                                                    </li>
                                                </ul>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-span-12 md:col-span-4">
                                            <div class="flex flex-wrap gap-2 mt-2 mt-lg-0">
                                                <span class="px-2 py-1 text-sm font-medium text-green-500 rounded bg-green-500/20">design</span>
                                                <span class="px-2 py-1 text-sm font-medium rounded bg-violet-500/20 text-violet-500">Developer</span>
                                            </div>
                                        </div><!--end col-->
                                    </div><!--end row-->
                                    <div class="absolute top-4 ltr:right-4 rtl:left-4">
                                        <div class="w-8 h-8 text-center text-gray-100 transition-all duration-300 bg-transparent border rounded border-gray-100/50 hover:bg-red-600 hover:text-white dark:border-neutral-600 dark:hover:border-transparent">
                                            <a href="javascript:void(0)"><i class="uil uil-heart-alt text-lg leading-[1.8]"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="p-4 border border-gray-100/50 rounded-md relative hover:-translate-y-1.5 transition-all duration-500 ease-in-out group-data-[theme-color=violet]:hover:border-violet-500 group-data-[theme-color=sky]:hover:border-sky-500 group-data-[theme-color=red]:hover:border-red-500 group-data-[theme-color=green]:hover:border-green-500 group-data-[theme-color=pink]:hover:border-pink-500 group-data-[theme-color=blue]:hover:border-blue-500 hover:shadow-md hover:shadow-gray-100/30 dark:border-neutral-600 dark:hover:shadow-neutral-900">
                                    <div class="grid items-center grid-cols-12">
                                        <div class="col-span-12 md:col-auto">
                                            <div>
                                                <a href="javascript:void(0)"><img src="/assets/user/images/user/img-04.jpg" alt="" class="w-16 h-16 p-1 rounded-full outline outline-2 outline-gray-100/50 dark:outline-neutral-600"></a>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-span-12 md:col-span-5">
                                            <div class="mt-3 mt-lg-0">
                                                <h5 class="mb-0 text-gray-900 text-19 dark:text-gray-50"><a href="candidate-details.html">Betty Richards</a> <span class="px-2 py-1 text-sm text-white bg-green-500 rounded"><i class="align-middle mdi mdi-star"></i> 4.3</span></h5>
                                                <p class="mb-2 text-gray-500 text-muted dark:text-gray-300">Education Training</p>
                                                <ul class="flex flex-wrap gap-3 text-gray-500 dark:text-gray-300">
                                                    <li class="list-inline-item">
                                                        <i class="mdi mdi-map-marker"></i> Oakridge Lane Richardson
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <i class="uil uil-wallet"></i> $380 / hours
                                                    </li>
                                                </ul>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-span-12 md:col-span-4">
                                            <div class="flex flex-wrap gap-2 mt-2 mt-lg-0">
                                                <span class="px-2 py-1 text-sm font-medium text-yellow-500 rounded bg-yellow-500/20">Trainer</span>
                                                <span class="px-2 py-1 text-sm font-medium rounded bg-sky-500/20 text-sky-500">Adobe Illustrator</span>
                                            </div>
                                        </div><!--end col-->
                                    </div><!--end row-->
                                    <div class="absolute top-4 ltr:right-4 rtl:left-4">
                                        <div class="w-8 h-8 text-center text-white bg-red-600 rounded">
                                            <a href="javascript:void(0)"><i class="uil uil-heart-alt text-lg leading-[1.9]"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="p-4 border border-gray-100/50 rounded-md relative hover:-translate-y-1.5 transition-all duration-500 ease-in-out group-data-[theme-color=violet]:hover:border-violet-500 group-data-[theme-color=sky]:hover:border-sky-500 group-data-[theme-color=red]:hover:border-red-500 group-data-[theme-color=green]:hover:border-green-500 group-data-[theme-color=pink]:hover:border-pink-500 group-data-[theme-color=blue]:hover:border-blue-500 hover:shadow-md hover:shadow-gray-100/30 dark:border-neutral-600 dark:hover:shadow-neutral-900">
                                    <div class="grid items-center grid-cols-12">
                                        <div class="col-span-12 md:col-auto">
                                            <div>
                                                <a href="javascript:void(0)"><img src="/assets/user/images/user/img-05.jpg" alt="" class="w-16 h-16 p-1 rounded-full outline outline-2 outline-gray-100/50 dark:outline-neutral-600"></a>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-span-12 md:col-span-5">
                                            <div class="mt-3 mt-lg-0">
                                                <h5 class="mb-0 text-gray-900 text-19 dark:text-gray-50"><a href="candidate-details.html">Jeffrey Montgomery</a> <span class="px-2 py-1 text-sm text-white bg-green-500 rounded"><i class="align-middle mdi mdi-star"></i> 4.5</span></h5>
                                                <p class="mb-2 text-gray-500 text-muted dark:text-gray-300">Restaurant Team Member</p>
                                                <ul class="flex flex-wrap gap-3 text-gray-500 dark:text-gray-300">
                                                    <li class="list-inline-item">
                                                        <i class="mdi mdi-map-marker"></i> Oakridge Lane Richardson
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <i class="uil uil-wallet"></i> $125 / hours
                                                    </li>
                                                </ul>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-span-12 md:col-span-4">
                                            <div class="flex flex-wrap gap-2 mt-2 mt-lg-0">
                                                <span class="px-2 py-1 text-sm font-medium rounded bg-violet-500/20 text-violet-500">Trainer</span>
                                                <span class="px-2 py-1 text-sm font-medium text-yellow-500 rounded bg-yellow-500/20">Adobe Illustrator</span>
                                            </div>
                                        </div><!--end col-->
                                    </div><!--end row-->
                                    <div class="absolute top-4 ltr:right-4 rtl:left-4">
                                        <div class="w-8 h-8 text-center text-gray-100 transition-all duration-300 bg-transparent border rounded border-gray-100/50 hover:bg-red-600 hover:text-white dark:border-neutral-600 dark:hover:border-transparent">
                                            <a href="javascript:void(0)"><i class="uil uil-heart-alt text-lg leading-[1.8]"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="p-4 border border-gray-100/50 rounded-md relative hover:-translate-y-1.5 transition-all duration-500 ease-in-out group-data-[theme-color=violet]:hover:border-violet-500 group-data-[theme-color=sky]:hover:border-sky-500 group-data-[theme-color=red]:hover:border-red-500 group-data-[theme-color=green]:hover:border-green-500 group-data-[theme-color=pink]:hover:border-pink-500 group-data-[theme-color=blue]:hover:border-blue-500 hover:shadow-md hover:shadow-gray-100/30 dark:border-neutral-600 dark:hover:shadow-neutral-900">
                                    <div class="grid items-center grid-cols-12">
                                        <div class="col-span-12 md:col-auto">
                                            <div>
                                                <a href="javascript:void(0)"><img src="/assets/user/images/user/img-06.jpg" alt="" class="w-16 h-16 p-1 rounded-full outline outline-2 outline-gray-100/50 dark:outline-neutral-600"></a>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-span-12 md:col-span-5">
                                            <div class="mt-3 mt-lg-0">
                                                <h5 class="mb-0 text-gray-900 text-19 dark:text-gray-50"><a href="candidate-details.html">Milton Osborn</a> <span class="px-2 py-1 text-sm text-white bg-red-600 rounded"><i class="align-middle mdi mdi-star"></i> 2.5</span></h5>
                                                <p class="mb-2 text-gray-500 text-muted dark:text-gray-300"> Assistant / Store Keeper</p>
                                                <ul class="flex flex-wrap gap-3 text-gray-500 dark:text-gray-300">
                                                    <li class="list-inline-item">
                                                        <i class="mdi mdi-map-marker"></i> Oakridge Lane Richardson
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <i class="uil uil-wallet"></i> $455 / hours
                                                    </li>
                                                </ul>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-span-12 md:col-span-4">
                                            <div class="flex flex-wrap gap-2 mt-2 mt-lg-0">
                                                <span class="px-2 py-1 text-sm font-medium rounded bg-sky-500/20 text-sky-500">Trainer</span>
                                                <span class="px-2 py-1 text-sm font-medium rounded bg-violet-500/20 text-violet-500">Adobe Illustrator</span>
                                            </div>
                                        </div><!--end col-->
                                    </div><!--end row-->
                                    <div class="absolute top-4 ltr:right-4 rtl:left-4">
                                        <div class="w-8 h-8 text-center text-gray-100 transition-all duration-300 bg-transparent border rounded border-gray-100/50 hover:bg-red-600 hover:text-white dark:border-neutral-600 dark:hover:border-transparent">
                                            <a href="javascript:void(0)"><i class="uil uil-heart-alt text-lg leading-[1.8]"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="p-4 border border-gray-100/50 rounded-md relative hover:-translate-y-1.5 transition-all duration-500 ease-in-out group-data-[theme-color=violet]:hover:border-violet-500 group-data-[theme-color=sky]:hover:border-sky-500 group-data-[theme-color=red]:hover:border-red-500 group-data-[theme-color=green]:hover:border-green-500 group-data-[theme-color=pink]:hover:border-pink-500 group-data-[theme-color=blue]:hover:border-blue-500 hover:shadow-md hover:shadow-gray-100/30 dark:border-neutral-600 dark:hover:shadow-neutral-900">
                                    <div class="grid items-center grid-cols-12">
                                        <div class="col-span-12 md:col-auto">
                                            <div>
                                                <a href="javascript:void(0)"><img src="/assets/user/images/user/img-07.jpg" alt="" class="w-16 h-16 p-1 rounded-full outline outline-2 outline-gray-100/50 dark:outline-neutral-600"></a>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-span-12 md:col-span-5">
                                            <div class="mt-3 mt-lg-0">
                                                <h5 class="mb-0 text-gray-900 text-19 dark:text-gray-50"><a href="candidate-details.html">Harold Jordan</a> <span class="px-2 py-1 text-sm text-white bg-green-500 rounded"><i class="align-middle mdi mdi-star"></i> 4.8</span></h5>
                                                <p class="mb-2 text-gray-500 text-muted dark:text-gray-300">Executive, HR Operations</p>
                                                <ul class="flex flex-wrap gap-3 text-gray-500 dark:text-gray-300">
                                                    <li class="list-inline-item">
                                                        <i class="mdi mdi-map-marker"></i> Oakridge Lane Richardson
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <i class="uil uil-wallet"></i> $799 / hours
                                                    </li>
                                                </ul>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-span-12 md:col-span-4">
                                            <div class="flex flex-wrap gap-2 mt-2 mt-lg-0">
                                                <span class="px-2 py-1 text-sm font-medium text-green-500 rounded bg-green-500/20">Trainer</span>
                                                <span class="px-2 py-1 text-sm font-medium rounded bg-violet-500/20 text-violet-500">Adobe Illustrator</span>
                                            </div>
                                        </div><!--end col-->
                                    </div><!--end row-->
                                    <div class="absolute top-4 ltr:right-4 rtl:left-4">
                                        <div class="w-8 h-8 text-center text-gray-100 transition-all duration-300 bg-transparent border rounded border-gray-100/50 hover:bg-red-600 hover:text-white dark:border-neutral-600 dark:hover:border-transparent">
                                            <a href="javascript:void(0)"><i class="uil uil-heart-alt text-lg leading-[1.8]"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="p-4 border border-gray-100/50 rounded-md relative hover:-translate-y-1.5 transition-all duration-500 ease-in-out group-data-[theme-color=violet]:hover:border-violet-500 group-data-[theme-color=sky]:hover:border-sky-500 group-data-[theme-color=red]:hover:border-red-500 group-data-[theme-color=green]:hover:border-green-500 group-data-[theme-color=pink]:hover:border-pink-500 group-data-[theme-color=blue]:hover:border-blue-500 hover:shadow-md hover:shadow-gray-100/30 dark:border-neutral-600 dark:hover:shadow-neutral-900">
                                    <div class="grid items-center grid-cols-12">
                                        <div class="col-span-12 md:col-auto">
                                            <div>
                                                <a href="javascript:void(0)"><img src="/assets/user/images/user/img-08.jpg" alt="" class="w-16 h-16 p-1 rounded-full outline outline-2 outline-gray-100/50 dark:outline-neutral-600"></a>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-span-12 md:col-span-5">
                                            <div class="mt-3 mt-lg-0">
                                                <h5 class="mb-0 text-gray-900 text-19 dark:text-gray-50"><a href="candidate-details.html">MichaeL Drake </a> <span class="px-2 py-1 text-sm text-white bg-yellow-500 rounded"><i class="align-middle mdi mdi-star"></i> 3.9</span></h5>
                                                <p class="mb-2 text-gray-500 text-muted dark:text-gray-300">Full Stack Engineer</p>
                                                <ul class="flex flex-wrap gap-3 text-gray-500 dark:text-gray-300">
                                                    <li class="list-inline-item">
                                                        <i class="mdi mdi-map-marker"></i> Oakridge Lane Richardson
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <i class="uil uil-wallet"></i> $240 / hours
                                                    </li>
                                                </ul>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-span-12 md:col-span-4">
                                            <div class="flex flex-wrap gap-2 mt-2 mt-lg-0">
                                                <span class="px-2 py-1 text-sm font-medium rounded bg-sky-500/20 text-sky-500">Trainer</span>
                                                <span class="px-2 py-1 text-sm font-medium text-yellow-500 rounded bg-yellow-500/20">Adobe Illustrator</span>
                                            </div>
                                        </div><!--end col-->
                                    </div><!--end row-->
                                    <div class="absolute top-4 ltr:right-4 rtl:left-4">
                                        <div class="w-8 h-8 text-center text-gray-100 transition-all duration-300 bg-transparent border rounded border-gray-100/50 hover:bg-red-600 hover:text-white dark:border-neutral-600 dark:hover:border-transparent">
                                            <a href="javascript:void(0)"><i class="uil uil-heart-alt text-lg leading-[1.8]"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="grid grid-cols-12">
                                <div class="col-span-12">
                                    <ul class="flex justify-center gap-2 mt-8">
                                        <li class="w-12 h-12 text-center border rounded-full cursor-default border-gray-100/50 dark:border-gray-100/20">
                                            <a class="cursor-auto" href="javascript:void(0)" tabindex="-1">
                                                <i class="mdi mdi-chevron-double-left text-16 leading-[2.8] dark:text-white"></i>
                                            </a>
                                        </li>
                                        <li class="w-12 h-12 text-center text-white border border-transparent rounded-full cursor-pointer group-data-[theme-color=violet]:bg-violet-500 group-data-[theme-color=sky]:bg-sky-500 group-data-[theme-color=red]:bg-red-500 group-data-[theme-color=green]:bg-green-500 group-data-[theme-color=pink]:bg-pink-500 group-data-[theme-color=blue]:bg-blue-500">
                                            <a class="text-16 leading-[2.8]" href="javascript:void(0)">1</a>
                                        </li>
                                        <li class="w-12 h-12 text-center text-gray-900 transition-all duration-300 border rounded-full cursor-pointer border-gray-100/50 hover:bg-gray-100/30 focus:bg-gray-100/30 dark:border-gray-100/20 dark:text-gray-50 dark:hover:bg-gray-500/20">
                                            <a class="text-16 leading-[2.8]" href="javascript:void(0)">2</a>
                                        </li>
                                        <li class="w-12 h-12 text-center text-gray-900 transition-all duration-300 border rounded-full cursor-pointer border-gray-100/50 hover:bg-gray-100/30 focus:bg-gray-100/30 dark:border-gray-100/20 dark:text-gray-50 dark:hover:bg-gray-500/20">
                                            <a class="text-16 leading-[2.8]" href="javascript:void(0)">3</a>
                                        </li>
                                        <li class="w-12 h-12 text-center text-gray-900 transition-all duration-300 border rounded-full cursor-pointer border-gray-100/50 hover:bg-gray-100/30 focus:bg-gray-100/30 dark:border-gray-100/20 dark:text-gray-50 dark:hover:bg-gray-500/20">
                                            <a class="text-16 leading-[2.8]" href="javascript:void(0)">4</a>
                                        </li>
                                        <li class="w-12 h-12 text-center text-gray-900 transition-all duration-300 border rounded-full cursor-pointer border-gray-100/50 hover:bg-gray-100/30 focus:bg-gray-100/30 dark:border-gray-100/20 dark:text-gray-50 dark:hover:bg-gray-500/20">
                                            <a href="javascript:void(0)" tabindex="-1">
                                                <i class="mdi mdi-chevron-double-right text-16 leading-[2.8]"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!--end col-->
                            </div>
                        </div>
                    </section>
                <!-- End grid -->



    </Layout>
</template>
