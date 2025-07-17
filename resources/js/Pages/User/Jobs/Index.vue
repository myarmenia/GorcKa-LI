<script setup>
import Layout from '@/Layouts/User/Layout.vue';
import Jobs from '@/Components/Jobs.vue'
import SearchSelect from '@/Components/SearchSelect.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { computed, ref, onMounted, watch } from "vue";
import { Head, useForm } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import { useTrans } from '/resources/js/trans';
import initNavAndTabs from "@/modules/user/nav&tabs.js";

const props = defineProps({
  locale: String,
  locations: Array,
  categories: Array,
  jobs: Array,
});

const jobsRef = ref(props.jobs.data);
const pagination = ref(props.jobs.links);
const paginationInfo = ref(props.jobs);
console.log(props.jobs, '/////pppp')
let activePage = ref(1)

const searchSelectLocation = ref('');
const searchSelectCategory = ref('');
const remoteValue = ref(0);

// Используем query параметры из текущего запроса
const queryString = window.location.search;
const urlParams = Object.fromEntries(new URLSearchParams(queryString));

const categoryIds = Object.keys(urlParams)
    .filter(key => key.startsWith('category_ids[')) // Ищем параметры вида category_ids[0], category_ids[1]...
    .map(key => urlParams[key]);

const form = useForm({
    category_id: urlParams.category_id || '',
    location_id: urlParams.location_id || '',
    name: urlParams.name || '',
    task_type: urlParams.task_type || '',
    category_ids: categoryIds
});

// Перерасчитываем options для locations только на основе начальных данных
const locationOptions = computed(() => {
    return props.locations.map(location => ({
        value: location.id,
        text: location.item_translations[0]?.name
    }));
});


const categoryOptions = computed(() => {
    return props.categories.map(category => ({
        value: category.id,
        text: category.item_translations[0]?.name
    }));
});

onMounted(() => {
    remoteValue.value = form.task_type
    initNavAndTabs();
    updateSelectedFilters()

});

watch(() => props.locale, (newLocale) => {

    updateSelectedFilters()

    jobsRef.value = props.jobs.data;
    paginationInfo.value = props.jobs;
    pagination.value = props.jobs.links
});

// // Функция для обновления выбранных фильтров
function updateSelectedFilters() {
    const selectedLocation = props.locations.find(loc => loc.id == form.location_id);
    const selectedCategory = props.categories.find(cat => cat.id == form.category_id);

    if (selectedLocation) {
        searchSelectLocation.value.addInputText(selectedLocation.item_translations[0].name);
    }

    if (selectedCategory) {
        searchSelectCategory.value.addInputText(selectedCategory.item_translations[0].name);
    }
}

watch(remoteValue, (newValue) => {

    if (newValue === null) {
        form.task_type = ''; // Очищаем task_type
    } else {
        form.task_type = newValue ? 1 : ''; // Преобразуем true/false в 1/0
    }
});

const submit = () => {

    form.get(route('jobs', { locale: props.locale }), {
        preserveState: true,
        onSuccess: (response) => {

            if (response.props.jobs) {

                jobsRef.value = response.props.jobs.data;
                paginationInfo.value = response.props.jobs;
                pagination.value = response.props.jobs.links; // Get pagination info

            } else {
                console.error('Специалисты не найдены');
            }
        },
        onError: (errors) => {
            console.error('Ошибка:', errors);
        },
        onFinish: () => {
        }
    });
};



// Функция для сброса фильтров
const clearFilters = () => {

    form.location_id = ''
    form.category_id = ''
    remoteValue.value = null
    form.task_type = ''
    form.category_ids = []
    form.name = null


    searchSelectLocation.value.clearSearch() // Вызываем метод из дочернего компонента
    searchSelectCategory.value.clearSearch() // Вызываем метод из дочернего компонента

    form.get(route('specialists', { locale: props.locale }), {
          preserveState: true,
        onSuccess: (response) => {

        if (response.props.specialists) {
                specialistsRef.value = response.props.specialists.data; // Get current page's specialists
                paginationInfo.value = response.props.specialists;
                pagination.value = response.props.specialists.links; // Get pagination info
            }
        },
        onError: (errors) => {
            console.error('Ошибка при очистке фильтров:', errors);
        },
        onFinish: () => {
            console.log('Запрос на сброс фильтров завершён');
        }
    });
};


const changePage = (link) =>{

    if(!link.url || link.active){
        return
    }

    activePage.value = link.label

    form.get(link.url, {
        preserveState: true,
        onSuccess: (response) => {
            if (response?.props?.jobs) {
                jobsRef.value = response.props.jobs.data;
                paginationInfo.value = response.props.jobs;
                pagination.value = response.props.jobs.links;

                console.log(jobsRef.value, 888888)
            } else {
                console.error('Данные специалистов отсутствуют:', response);
            }
        },
        onError: (errors) => {
            console.error('Ошибка:', errors);
        }
    });


}


</script>

<template>
    <Layout>
        <Head :title="useTrans('page.title')" />
        <section class="pt-28 lg:pt-44 pb-28 group-data-[theme-color=violet]:bg-violet-500 group-data-[theme-color=sky]:bg-sky-500 group-data-[theme-color=red]:bg-red-500 group-data-[theme-color=green]:bg-green-500 group-data-[theme-color=pink]:bg-pink-500 group-data-[theme-color=blue]:bg-blue-500 dark:bg-neutral-900 bg-[url('../images/home/page-title.png')] bg-center bg-cover relative">
            <div class="container mx-auto">
                <div class="grid">
                    <div class="col-span-12">
                        <div class="text-center text-white">
                            <h3 class="mb-4 text-[26px]">{{useTrans('page.title')}}</h3>
                            <div class="page-next">
                                <nav class="inline-block" aria-label="breadcrumb text-center">
                                    <ol class="flex flex-wrap justify-center text-sm font-medium uppercase">
                                        <li><Link :href="route('welcome', { locale: $page.props.locale })" class="text-white block ">{{useTrans('navbar.home')}}</Link></li>
                                        <li class="active" aria-current="page"><i class="bx bxs-chevron-right align-middle px-2.5"></i>{{useTrans('page.title')}}</li>
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

        <section class="py-16">
            <div class="container mx-auto">
                <div class="grid grid-cols-12 gap-y-10 lg:gap-10">
                    <div class="col-span-12 xl:col-span-9">
                        <div class="job-list-header">
                            <form @submit.prevent="submit">
                                <div class="grid grid-cols-12 gap-3">
                                    <div class="col-span-12 xl:col-span-3">
                                        <div class="relative filler-job-form">
                                            <i class="uil uil-briefcase-alt"></i>
                                            <input type="search" v-model="form.name" class="w-full filter-job-input-box dark:text-gray-100" id="exampleFormControlInput1" :placeholder="useTrans('page.form_name')">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-span-12 xl:col-span-3">
                                        <div class="relative filler-job-form">
                                            <i class="uil uil-location-point"></i>
                                            <div class="">
                                                <SearchSelect
                                                    ref="searchSelectLocation"
                                                    v-model="form.location_id"
                                                    route="location-filter"
                                                    :options="locationOptions"
                                                    :border="true"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-span-12 xl:col-span-3">
                                        <div class="relative filler-job-form">
                                            <i class="uil uil-clipboard-notes"></i>
                                            <div class="">
                                                <SearchSelect
                                                    ref="searchSelectCategory"
                                                    v-model="form.category_id"
                                                    route="category-subcategory-filter"
                                                    :options="categoryOptions"
                                                    :border="true"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <!--end col-->

                                    <div class="col-span-12 xl:col-span-3">
                                        <PrimaryButton :class="{ 'opacity-25': form.processing }"
                                            @click="submit"
                                            :disabled="form.processing">
                                            <i class="uil uil-filter"></i>{{useTrans('form.filter')}}
                                        </PrimaryButton>
                                        <PrimaryButton @click="clearFilters" class="ml-2">{{useTrans('form.cleare_filter')}}</PrimaryButton>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end grid-->
                            </form>
                        </div>

                        <div class="mt-12">
                            <div class="grid items-center grid-cols-12">
                                <div class="col-span-12 lg:col-span-8">
                                    <h6 class="mb-0 text-gray-900 fs-16 dark:text-gray-50"> {{ useTrans('page.showing') }} {{paginationInfo.from}} – {{paginationInfo.to}} {{ useTrans('page.of') }} {{paginationInfo.total}} {{ useTrans('page.results') }} </h6>
                                </div>

                            </div>
                        </div>


                        <div class="mt-5">
                            <Jobs :jobs="props.jobs.data"  />
                        </div>

                        <!-- pagination -->
                        <div class="grid grid-cols-12" v-if="paginationInfo.total > 3">
                            <div class="col-span-12">
                                <ul class="flex justify-center gap-2 mt-8">
                                    <li v-for="(link,index) in pagination"
                                        :key="index"
                                        :class="{active: link.active, disabled: !link.url, 'group-data-[theme-color=green]:bg-green-500 text-white': link.active, 'group-data-[theme-color=green]:bg-gray-200 ': !link.url }"
                                        @click=" changePage(link)"
                                        class="w-12 h-12 text-center text-gray-900 transition-all duration-300 border rounded-full cursor-pointer border-gray-100/50 hover:bg-green-100/30 focus:bg-gray-100/30 dark:border-gray-100/20 dark:text-gray-50 dark:hover:bg-gray-500/20">
                                        <!-- <a class="cursor-auto" href="javascript:void(0)" > -->
                                            <span class="text-16 leading-[2.8]" v-html="link.label"></span> <!-- Use v-html to render HTML -->
                                        <!-- </a> -->
                                    </li>
                                </ul>
                            </div>
                            <!--end col-->
                        </div>
                    </div>


                    <div class="col-span-12 space-y-5 lg:col-span-3">
                        <div data-tw-accordion="collapse">
                            <div class="text-gray-700 accordion-item dark:text-gray-300">
                                <h6>
                                    <button type="button" class="flex items-center justify-between w-full px-4 py-2 font-medium text-left accordion-header group group-data-[theme-color=green]:bg-green-500/20 group active">
                                        <span class="text-gray-900 text-15 dark:text-gray-50"> {{useTrans('page.job_type')}}</span>
                                        <i class="mdi mdi-chevron-down text-xl group-[.active]:rotate-180 text-gray-900 dark:text-gray-50"></i>
                                    </button>
                                </h6>
                                <div class="block accordion-body">
                                    <div class="p-5">
                                        <div class="mt-2">
                                            <input  v-model="remoteValue" :checked="remoteValue == 1"
                                            class="rounded cursor-pointer group-data-[theme-color=green]:checked:bg-green-500 focus:ring-0 focus:ring-offset-0 dark:bg-neutral-600 dark:checked:bg-violet-500/20" type="checkbox" id="flexCheckChecked1">
                                            <label class="text-gray-500 cursor-pointer ltr:ml-2 rtl:mr-2 dark:text-gray-300">{{useTrans('page.remote')}}</label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div data-tw-accordion="collapse">
                            <div class="text-gray-700 accordion-item dark:text-gray-300">
                                <h6>
                                    <button type="button" class="flex items-center justify-between w-full px-4 py-2 font-medium text-left accordion-header group-data-[theme-color=green]:bg-green-500/20 group active">
                                        <span class="text-gray-900 text-15 dark:text-gray-50"> {{useTrans('page.categories')}}</span>
                                        <i class="mdi mdi-chevron-down text-xl group-[.active]:rotate-180 text-gray-900 dark:text-gray-50"></i>
                                    </button>
                                </h6>
                                <div class="block accordion-body">
                                    <div class="p-5">
                                        <div v-for="(category, index) in categoryOptions" class="mt-2">
                                            <input
                                                v-model="form.category_ids"
                                                :value="category.value"
                                                class="rounded cursor-pointer group-data-[theme-color=green]:checked:bg-green-500 focus:ring-0 focus:ring-offset-0 dark:bg-neutral-600 dark:checked:bg-violet-500/20" type="checkbox" id="flexCheckChecked1">
                                            <label class="text-gray-500 cursor-pointer ltr:ml-2 rtl:mr-2 dark:text-gray-300">{{ category.text }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </Layout>

</template>

