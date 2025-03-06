<script setup>
import Layout from '@/Layouts/User/Layout.vue';
import SearchSelect from '@/Components/SearchSelect.vue';
import SearchMultiSelect from '@/Components/SearchMultiSelect.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import axios from 'axios';
import { computed, watch, ref } from "vue";
import { Head, Link, useForm } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import { useTrans } from '/resources/js/trans';

const { locale, locations, categories, specialists } = usePage().props;

const specialistsRef = ref(specialists.data);
const pagination = ref(specialists.links);
console.log(pagination,666666666)
let activePage = ref(1)

// Сохраняем locations в отдельной переменной, которая не изменяется
const initialLocations = ref(locations);
const initialCategories = ref(categories);

const searchSelectLocation = ref('');
const searchSelectCategory = ref('');


// Перерасчитываем options для locations только на основе начальных данных
const locationOptions = computed(() => {
    return initialLocations.value.map(location => ({
        value: location.id,
        text: location.item_translations[0]?.name
    }));
});


const categoryOptions = computed(() => {
    return initialCategories.value.map(category => ({
        value: category.id,
        text: category.item_translations[0]?.name
    }));
});


const form = useForm({
    name: '',
    location_id: '',
    category_id: ''
});



const submit = () => {
const savedFilters = { ...form.data() };
    form.get(route('user.specialists', { locale: locale }), {
preserveState: true,
        onSuccess: (response) => {
            console.log('Успешно555:', response.props.specialists);


            // Обновляем локальное свойство specialists
            if (response.props.specialists) {
                specialistsRef.value = response.props.specialists.data;
                pagination.value = response.props.specialists.links; // Get pagination info
                console.log(response.props.specialists.links, 111111111111)
            } else {
                console.error('Специалисты не найдены');
            }
        },
        onError: (errors) => {
            console.error('Ошибка:', errors);
        },
        onFinish: () => {
// Восстанавливаем значения формы
            form.name = savedFilters.name;
            form.location_id = savedFilters.location_id;
            form.category_id = savedFilters.category_id;
            console.log(form, 'Запрос завершен');
        }
    });
};



// Функция для сброса фильтров
const clearFilters = () => {
    console.log(form, '++++++++++++++')
    form.location_id = '';
    form.category_id = '';

    searchSelectLocation.value.clearSearch() // Вызываем метод из дочернего компонента
    searchSelectCategory.value.clearSearch() // Вызываем метод из дочернего компонента
    form.name = null

    // Если вы хотите сбросить список специалистов после очистки фильтра
    form.get(route('user.specialists', { locale: locale }), {
          preserveState: true,
        onSuccess: (response) => {
        // Обновляем список специалистов, если они изменяются

        if (response.props.specialists) {
                specialistsRef.value = response.props.specialists.data; // Get current page's specialists
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
    console.log(link.url, 1000000008)
    if(!link.url || link.active){
        return
    }

    activePage.value = link.label
console.log(form.get, '000000000')
    // form.location_id = 2
    console.log(form, 777777777777)

    form.get(link.url, {
preserveState: true,
        onSuccess: (response) => {
            if (response?.props?.specialists) {
                specialistsRef.value = response.props.specialists.data;
                pagination.value = response.props.specialists.links;
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
                                                            ref="searchSelectLocation"
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
                                                            ref="searchSelectCategory"
                                                            v-model="form.category_id"
                                                            route="category-subcategory-filter"
                                                            :options="categoryOptions"
                                                        />
                                                    </div>
                                                </div>
                                            </div>

                                            <!--end col-->
                                            <div class="col-span-12 xl:col-span-3">
                                                <PrimaryButton :class="{ 'opacity-25': form.processing }"
                                                    @click="submit"
                                                    :disabled="form.processing">
                                                    <i class="uil uil-filter"></i> Fliter
                                                </PrimaryButton>
                                                <PrimaryButton @click="clearFilters">Очистить фильтры</PrimaryButton>
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
                                <div v-for="(spec, index) in specialistsRef" class="p-4 border border-gray-100/50 rounded-md relative hover:-translate-y-1.5 transition-all duration-500 ease-in-out  group-data-[theme-color=green]:hover:border-green-500 hover:shadow-md hover:shadow-gray-100/30 dark:border-neutral-600 dark:hover:shadow-neutral-900">
                                    <div class="grid items-center grid-cols-12">
                                        <div class="col-span-12 md:col-auto">
                                            <div>
                                                <a href="javascript:void(0)">
                                                    <img :src="`${spec.avater}`" alt="Avatar" class="w-16 h-16 p-1 rounded-full outline outline-2 outline-gray-100/50 dark:outline-neutral-600 group-data-[theme-color=violet]:bg-violet-500" />
                                                </a>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-span-12 md:col-span-5">
                                            <div class="mt-3 mt-lg-0">
                                                <h5 class="mb-0 text-gray-900 text-19 dark:text-white"><a href="candidate-details.html">{{spec.user_name}}</a>
                                                    <span class="px-2 py-1 mx-2 text-sm text-white bg-green-500 rounded"><i class="align-middle uil uil-star "></i> 4.8</span>
                                                </h5>
                                                <ul class="flex flex-wrap gap-3 text-gray-500 dark:text-gray-300">
                                                    <li class="list-inline-item">
                                                        <i class="uil uil-map-marker "></i> {{spec.location}}
                                                    </li>
                                                </ul>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-span-12 md:col-span-4">
                                            <div class="flex flex-wrap gap-2 mt-2 mt-lg-0">
                                                <span v-for="subCategory in spec.sub_categories" :class="`px-2 py-1 text-sm font-medium text-${subCategory.color}-500 rounded bg-${subCategory.color}-500/20`">{{subCategory.name}}</span>
                                            </div>
                                        </div><!--end col-->
                                    </div><!--end row-->

                                </div>
                            </div>

                            <div class="grid grid-cols-12">

</div>






                            <div class="grid grid-cols-12" v-if="pagination.length > 3">
                                <div class="col-span-12">
                                    <ul class="flex justify-center gap-2 mt-8">
                                        <li v-for="(link,index) in pagination"
                                            :key="index"
                                            :class="{active: link.active, disabled: !link.url, 'group-data-[theme-color=green]:bg-green-500 text-white': link.active, 'group-data-[theme-color=green]:bg-gray-200 ': !link.url }"
                                            @click=" changePage(link)"
                                            class="w-12 h-12 text-center text-gray-900 transition-all duration-300 border rounded-full cursor-pointer border-gray-100/50 hover:bg-green-100/30 focus:bg-gray-100/30 dark:border-gray-100/20 dark:text-gray-50 dark:hover:bg-gray-500/20">
                                            <!-- <a class="cursor-auto" href="javascript:void(0)" > -->
                                                <span class="text-16 leading-[2.8]" v-html="link.label.replace(/Հաջորդը|Նախորդը/, '')"></span> <!-- Use v-html to render HTML -->
                                            <!-- </a> -->
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
