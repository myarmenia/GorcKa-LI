<script setup>
import Layout from '@/Layouts/User/Layout.vue';
import SearchSelect from '@/Components/SearchSelect.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { computed, ref, onMounted, watch } from "vue";
import { Head, useForm, Link } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import { useTrans } from '/resources/js/trans';


const props = defineProps({
  locale: String,
  locations: Array,
  categories: Array,
  specialists: Array
});

const specialistsRef = ref(props.specialists.data);
const pagination = ref(props.specialists.links);
const paginationInfo = ref(props.specialists);

let activePage = ref(1)

const searchSelectLocation = ref('');
const searchSelectCategory = ref('');

// Используем query параметры из текущего запроса
const query = new URLSearchParams(window.location.search);

const form = useForm({
    category_id: query.get('category_id') || '',
    location_id: query.get('location_id') || '',
    name: query.get('name') || ''
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
    // submit();
    updateSelectedFilters()

});

watch(() => props.locale, (newLocale) => {

    updateSelectedFilters()

    specialistsRef.value = props.specialists.data;
    paginationInfo.value = props.specialists;
    pagination.value = props.specialists.links
});


// Функция для обновления выбранных фильтров
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


const submit = () => {

    form.get(route('specialists', { locale: props.locale }), {
        preserveState: true,
        onSuccess: (response) => {

            // Обновляем локальное свойство specialists
            if (response.props.specialists) {

                specialistsRef.value = response.props.specialists.data;
                paginationInfo.value = response.props.specialists;
                pagination.value = response.props.specialists.links; // Get pagination info

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

    form.location_id = '';
    form.category_id = '';

    searchSelectLocation.value.clearSearch() // Вызываем метод из дочернего компонента
    searchSelectCategory.value.clearSearch() // Вызываем метод из дочернего компонента
    form.name = null

    // Если вы хотите сбросить список специалистов после очистки фильтра
    form.get(route('specialists', { locale: props.locale }), {
          preserveState: true,
        onSuccess: (response) => {
        // Обновляем список специалистов, если они изменяются

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
            if (response?.props?.specialists) {
                specialistsRef.value = response.props.specialists.data;
                paginationInfo.value = response.props.specialists;
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
                            <h3 class="mb-4 text-[26px]">{{useTrans('page.title')}}</h3>
                            <div class="page-next">
                                <nav class="inline-block" aria-label="breadcrumb text-center">
                                    <ol class="flex flex-wrap justify-center text-sm font-medium uppercase">
                                        <li><a href="index.html">{{useTrans('page.nav_home')}}</a></li>
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
                                            <input type="text" v-model="form.name" class="w-full filter-job-input-box dark:text-gray-100" id="exampleFormControlInput1" :placeholder="useTrans('form.name_surname')">
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
                                            <i class="uil uil-filter"></i>{{useTrans('form.filter')}}
                                        </PrimaryButton>
                                        <PrimaryButton @click="clearFilters" class="ml-2">{{useTrans('form.cleare_filter')}}</PrimaryButton>
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
                                <h6 class="mb-0 text-gray-900 fs-16 dark:text-gray-50"> {{ useTrans('page.showing') }} {{paginationInfo.from}} – {{paginationInfo.to}} {{ useTrans('page.of') }} {{paginationInfo.total}} {{ useTrans('page.results') }} </h6>
                            </div>

                        </div>
                    </div>

                    <div class="mt-8 space-y-6">

                         <!-- <Link :href="route('specialist_details', {id: 1  })">aaaa</Link> -->

                        <div v-for="(spec, index) in specialistsRef" class="p-4 border border-gray-100/50 rounded-md relative hover:-translate-y-1.5 transition-all duration-500 ease-in-out  group-data-[theme-color=green]:hover:border-green-500 hover:shadow-md hover:shadow-gray-100/30 dark:border-neutral-600 dark:hover:shadow-neutral-900">
                            <Link :href="`specialist/${spec.user_id}`">

                                <div class="grid items-center grid-cols-12">
                                    <div class="col-span-12 md:col-auto">
                                        <div>
                                             <img :src="`${spec.avater}`" alt="Avatar" class="w-16 h-16 p-1 rounded-full outline outline-2 outline-gray-100/50 dark:outline-neutral-600 group-data-[theme-color=violet]:bg-violet-500" />
                                        </div>
                                    </div><!--end col-->

                                    <div class="col-span-12 md:col-span-5">
                                        <div class="mt-3 mt-lg-0">
                                            <h5 class="mb-0 text-gray-900 text-19 dark:text-white">{{spec.user_name}}
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
                            </Link>
                        </div>
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
            </section>
        <!-- End grid -->

    </Layout>
</template>
