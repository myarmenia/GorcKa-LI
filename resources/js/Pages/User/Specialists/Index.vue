<script setup>
import Layout from '@/Layouts/User/Layout.vue';
import SearchSelect from '@/Components/SearchSelect.vue';
import SearchMultiSelect from '@/Components/SearchMultiSelect.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

import { computed, watch, ref } from "vue";
import { Head, Link, useForm } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import { useTrans } from '/resources/js/trans';


const props = defineProps({
    status: {
        type: String,
    },

    locations: Array,
    categories: Array,
    specialists: Array
});

console.log(props.specialists, 111112222233333)
const currentLanguage = computed(() => usePage().props.locale);

const locationOptions = computed(() =>

    props.locations.map(location => ({
        value: location.id,
        text: location.item_translations[0]?.name
    }))

);

const categoryOptions = computed(() =>

    props.categories.map(category => ({
        value: category.id,
        text: category.item_translations[0]?.name
    }))

);

console.log(props.specialists)

const selectedLocation = ref(null);

watch(currentLanguage, () => {
  form.errors = {};
});

const form = useForm({
    name: '',
    location_id: '',
    category_id: ''
});

const submit = () => {
    form.post(route('user.filter_specialists', { locale: usePage().props.locale }), {
        // onFinish: () => {
        //     console.log(22)
        // }

        onSuccess: (response) => {
            console.log('Успешно555:', response.props.specialists);
            props.specialists = response.props.specialists
        },
        onError: (errors) => {
            console.error('Ошибка:', errors);
        },
        onFinish: () => {
            console.log('Запрос завершен');
        }

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

                                <div class="job-list-header">
                                    <form @submit.prevent="submit" >
                                        <div class="grid grid-cols-12 lg:gap-3 gap-y-3">
                                            <div class="col-span-12 xl:col-span-3">
                                                <div class="relative filler-job-form">
                                                    <i class="uil uil-briefcase-alt"></i>
                                                    <input type="text" v-model="form.name" class="w-full filter-job-input-box dark:text-gray-100" id="exampleFormControlInput1" placeholder="Job, company... ">
                                                </div>
                                            </div>

                                            <div class="col-span-12 xl:col-span-3">
                                                <div class="relative filler-job-form">
                                                    <i class="uil uil-location-point"></i>
                                                    <div class="">
                                                        <SearchSelect
                                                            v-model="form.location_id"
                                                            route="location-filter"
                                                            :options="locationOptions"
                                                        />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-span-12 xl:col-span-3">
                                                <div class="relative filler-job-form">
                                                    <i class="uil uil-clipboard-notes"></i>
                                                    <div class="">
                                                        <SearchSelect
                                                            v-model="form.category_id"
                                                            route="category-subcategory-filter"
                                                            :options="categoryOptions"
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                                            <!-- model="CategoryTranslation" -->

                                            <!-- <div class="col-span-12 xl:col-span-4">
                                                <div class="relative filler-job-form">
                                                    <i class="uil uil-clipboard-notes"></i>
                                                    <div class="">
                                                        <SearchMultiSelect
                                                            v-model="form.category_id"
                                                            model="CategoryTranslation"
                                                            :options="categoryOptions"
                                                        />
                                                    </div>
                                                </div>
                                            </div> -->



                                            <!--end col-->
                                            <div class="col-span-12 xl:col-span-2">
                                                <PrimaryButton :class="{ 'opacity-25': form.processing }"
                                                @click="submit"
                                                    :disabled="form.processing">
                                                    <i class="uil uil-filter"></i> Fliter
                                                    <!-- {{useTrans('page.filter')}} -->
                                                </PrimaryButton>
                                                <!-- <a href="javascript:void(0)" class="text-white border-transparent btn group-data-[theme-color=violet]:bg-violet-500 group-data-[theme-color=sky]:bg-sky-500 group-data-[theme-color=red]:bg-red-500 group-data-[theme-color=green]:bg-green-500 group-data-[theme-color=pink]:bg-pink-500 group-data-[theme-color=blue]:bg-blue-500 focus:ring focus:ring-custom-500/30"><i class="uil uil-filter"></i> Fliter</a> -->
                                                <!-- <a href="javascript:void(0)" class="text-white bg-green-500 border-transparent btn focus:ring focus:ring-green-500/30 ltr:ml-1 rtl:mr-1"><i class="uil uil-cog"></i> Advance</a> -->
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
                                <div v-for="(specialist, index) in props.specialists" class="p-4 border border-gray-100/50 rounded-md relative hover:-translate-y-1.5 transition-all duration-500 ease-in-out group-data-[theme-color=violet]:hover:border-violet-500 group-data-[theme-color=sky]:hover:border-sky-500 group-data-[theme-color=red]:hover:border-red-500 group-data-[theme-color=green]:hover:border-green-500 group-data-[theme-color=pink]:hover:border-pink-500 group-data-[theme-color=blue]:hover:border-blue-500 hover:shadow-md hover:shadow-gray-100/30 dark:border-neutral-600 dark:hover:shadow-neutral-900">
                                    <div class="grid items-center grid-cols-12">
                                        <div class="col-span-12 md:col-auto">
                                            <div>
                                                <a href="javascript:void(0)">
                                                    <!-- <img src="/assets/user/images/user/img-01.jpg" alt="" class="w-16 h-16 p-1 rounded-full outline outline-2 outline-gray-100/50 dark:outline-neutral-600"> -->
                                                    <!-- <img src="`/${specialist.avater}`" alt="" class="w-16 h-16 p-1 rounded-full outline outline-2 outline-gray-100/50 dark:outline-neutral-600"> -->

                                                    <img :src="`${specialist.avater}`" alt="Avatar" class="w-16 h-16 p-1 rounded-full outline outline-2 outline-gray-100/50 dark:outline-neutral-600 group-data-[theme-color=violet]:bg-violet-500" />
                                                </a>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-span-12 md:col-span-5">
                                            <div class="mt-3 mt-lg-0">
                                                <h5 class="mb-0 text-gray-900 text-19 dark:text-white"><a href="candidate-details.html">{{specialist.user_name}}</a>
                                                    <span class="px-2 py-1 mx-2 text-sm text-white bg-green-500 rounded"><i class="align-middle uil uil-star "></i> 4.8</span>
                                                </h5>
                                                <!-- <p class="mb-2 text-gray-500 text-muted dark:text-gray-300"> Project Manager</p> -->
                                                <ul class="flex flex-wrap gap-3 text-gray-500 dark:text-gray-300">
                                                    <li class="list-inline-item">
                                                        <i class="uil uil-map-marker "></i> {{specialist.location}}
                                                    </li>
                                                    <!-- <li class="list-inline-item">
                                                        <i class="uil uil-wallet"></i> $650 / hours
                                                    </li> -->
                                                </ul>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-span-12 md:col-span-4">
                                            <div class="flex flex-wrap gap-2 mt-2 mt-lg-0">
                                                <span v-for="subCategory in specialist.sub_categories" :class="`px-2 py-1 text-sm font-medium text-${subCategory.color}-500 rounded bg-${subCategory.color}-500/20`">{{subCategory.name}}</span>
                                            </div>
                                        </div><!--end col-->
                                    </div><!--end row-->

                                </div>




                            </div>
                            <div class="grid grid-cols-12">
                                <div class="col-span-12">
                                    <ul class="flex justify-center gap-2 mt-8">
                                        <li class="w-12 h-12 text-center border rounded-full cursor-default border-gray-100/50 dark:border-gray-100/20">
                                            <a class="cursor-auto" href="javascript:void(0)" tabindex="-1">
                                                <i class="uil uil-chevron-double-left text-16 leading-[2.8] dark:text-white"></i>
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
                                                <i class="uil uil-chevron-double-right text-16 leading-[2.8]"></i>
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
