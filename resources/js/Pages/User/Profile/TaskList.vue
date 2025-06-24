<script setup>

import {router, Head, usePage ,Link,useForm} from '@inertiajs/vue3';
import { ref, onMounted, watch, computed  } from 'vue';
import Index from './Index.vue';
// import Layout from '@/Layouts/User/Layout.vue';
import { useTrans } from '/resources/js/trans';
import SearchSelect from '@/Components/SearchSelect.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import initNavAndTabs from "@/modules/user/nav&tabs.js";
import Layout from '@/Layouts/User/Layout.vue';


const queryString = window.location.search;
const urlParams = Object.fromEntries(new URLSearchParams(queryString));
const searchSelectCategory = ref('');

const props = defineProps({
  tasks: Array,
  categories: Array,
  locale: String,



})


// 2) Создаём локальный реф и инициализируем
const taskList = ref([...props.tasks.data])
console.log(taskList,'first taskList')
// 3) Смотрим за props.tasks.data и при изменении обновляем taskList
watch(
  () => props.tasks.data,
  (newData) => {
    taskList.value = [...newData];

  },
  { immediate: true }
)


const pagination = computed(() => props.tasks.links);

const form = useForm({
    category_id: urlParams.category_id || '',
    name: urlParams.name || '',

});

onMounted(() => {

    initNavAndTabs();

});


watch(() => props.locale, (newLocale) => {

    updateSelectedFilters()

});

// // Функция для обновления выбранных фильтров кагда ти паменаеsh ezik stranica
function updateSelectedFilters() {

    const selectedCategory = props.categories.find(cat => cat.id == form.category_id);


    if (selectedCategory) {
        searchSelectCategory.value.addInputText(selectedCategory.item_translations[0].name);
    }
}

const categoryOptions = computed(() => {
    console.log('Категории:', props.categories);
    return props.categories.map(category => ({
        value: category.id,
        text: category.item_translations[0]?.name
    }));
});

const fetchPage = (link) => {
    console.log(link.url);
    router.get(link.url, {  // <-- добавлена запятая после link
        // preserveState: true, // Сохранение состояния при обновлении
        // replace: true, // Меняет URL без перезагрузки
    });
};

const deleteElement =async (id,index) => {

        try {
            const response = await axios.delete(`/delete-item/tasks/${id}`);

            taskList.value.splice(index,1)
            taskList.value = [...props.tasks.data]
             await router.get(props.tasks.first_page_url)
               const currentPage = props.tasks.current_page;
             if(currentPage>1){
                  await router.get(props.tasks.prev_page_url)
             }else{
                await router.get(props.tasks.first_page_url)
             }

           

        } catch (error) {
            console.error('Error deleting file:', error.response?.data || error.message);
        }

};

const submitForm = () => {

    // console.log(form.errors);

    form.get(route('task.list', { locale: props.locale }), {
        // դնում ենք  որ ֆիլտրացիայից հետո կատեգորիան բերի
        preserveState: true,
        onSuccess: () => {
             if (!props.tasks?.data?.length) {
                   alert('Դատարկ է, տվյալներ չեն գտնվել');
             }


        },
        onError:() =>{
            console.log(4444)

        }

    });
};

    // Функция для сброса фильтров
    const clearFilters = () => {

        form.category_id = ''
        form.name = null
         searchSelectCategory.value.clearSearch()
    };
    console.log( props.tasks.data.length,"task data length")

const emit = defineEmits(['update:title']);

</script>

<template>
     <Index :title = "useTrans('page.task_list')">
            <template #content>
                <div class="mt-14">

                    <div>
                         <div  v-if="taskList.length" class="flex justify-center">
                                <form @submit.prevent="submitForm" class="inline-block   p-4 rounded">
                                    <div class="flex flex-wrap gap-4">

                                        <div class="relative filler-job-form">
                                            <i class="uil uil-briefcase-alt"></i>
                                            <input
                                            v-model="form.name"
                                            type="search"
                                            class="w-full filter-job-input-box dark:text-gray-100"
                                            :placeholder="useTrans('page.form_name')">
                                        </div>

                                        <div class="filler-job-form relative">
                                            <i class="uil uil-clipboard-notes"></i>
                                            <SearchSelect
                                            ref="searchSelectCategory"
                                            v-model="form.category_id"
                                            route="category-subcategory-filter"
                                            :options="categoryOptions"
                                            :border="true"
                                            />
                                        </div>


                                        <div class="flex gap-2 items-center">
                                            <PrimaryButton :class="{ 'opacity-25': form.processing }"
                                                        @click="submitForm"
                                                        :disabled="form.processing">
                                            <i class="uil uil-filter"></i>{{ useTrans('form.filter') }}
                                            </PrimaryButton>
                                            <PrimaryButton @click="clearFilters">{{ useTrans('form.cleare_filter') }}</PrimaryButton>
                                        </div>
                                    </div>
                                </form>
                            </div>


                        <div v-if="taskList.length">

                            <div v-for="(task,index) in taskList"  class=" m-6 w-[95%] deleted-item relative mt-4 overflow-hidden transition-all duration-500 ease-in-out bg-white border rounded-md border-gray-100/50 group/job group-data-[theme-color=violet]:hover:border-violet-500 group-data-[theme-color=sky]:hover:border-sky-500 group-data-[theme-color=red]:hover:border-red-500 group-data-[theme-color=green]:hover:border-green-500 group-data-[theme-color=pink]:hover:border-pink-500 group-data-[theme-color=blue]:hover:border-blue-500 hover:-translate-y-2 dark:bg-neutral-900 dark:border-neutral-600">
                                <div class="w-48 absolute -top-[5px] -left-20 -rotate-45 group-data-[theme-color=violet]:bg-violet-500/20 group-data-[theme-color=sky]:bg-sky-500/20 group-data-[theme-color=red]:bg-red-500/20 group-data-[theme-color=green]:bg-green-500/20 group-data-[theme-color=pink]:bg-pink-500/20 group-data-[theme-color=blue]:bg-blue-500/20 group-data-[theme-color=violet]:group-hover/job:bg-violet-500 group-data-[theme-color=sky]:group-hover/job:bg-sky-500 group-data-[theme-color=red]:group-hover/job:bg-red-500 group-data-[theme-color=green]:group-hover/job:bg-green-500 group-data-[theme-color=pink]:group-hover/job:bg-pink-500 group-data-[theme-color=blue]:group-hover/job:bg-blue-500 transition-all duration-500 ease-in-out p-[6px] text-center dark:bg-violet-500/20">
                                    <a href="javascript:void(0)" class="text-2xl text-white align-middle"><i class="mdi mdi-star"></i></a>
                                </div>
                                <div class="p-4">
                                    <div class="grid items-center grid-cols-12">
                                        <div class="col-span-12 lg:col-span-2">
                                            <div class="mb-4 text-center mb-md-0">
                                                <img :src="task.sub_category.category.icon
                                                ? `/assets/user/icons/categories/${task.sub_category.category.icon }.svg`
                                                : `/assets/user/icons/categories/it.svg`"
                                            alt="" class="mx-auto img-fluid rounded-3 w-1/3">

                                            </div>

                                        </div>



                                        <div class="col-span-12 lg:col-span-4 p-4">
                                            <div class="mb-2 mb-md-0">
                                                <h5 class="mb-1 fs-18"><a href="job-details.html" class="text-gray-900 dark:text-gray-50">{{ task.title }}</a>
                                                </h5>

                                            </div>
                                        </div>

                                        <div class="col-span-12 lg:col-span-2">
                                            <div class="mb-2 lg:flex">
                                                <div class="flex-shrink-0">
                                                    <i class="mr-1 mdi mdi-map-marker group-data-[theme-color=violet]:text-violet-500 group-data-[theme-color=sky]:text-sky-500 group-data-[theme-color=red]:text-red-500 group-data-[theme-color=green]:text-green-500 group-data-[theme-color=pink]:text-pink-500 group-data-[theme-color=blue]:text-blue-500"></i>
                                                </div>
                                                <p class="mb-0 text-gray-500 dark:text-gray-300">{{ task.location.translation.name }}</p>
                                            </div>
                                        </div>

                                        <div class="col-span-12 lg:col-span-2">
                                            <div>

                                            </div>
                                        </div>

                                        <div class="col-span-12 lg:col-span-2">
                                            <div class="flex flex-wrap gap-1.5">

                                                <div class="w-10 h-10 text-lg leading-10 text-center text-green-500 rounded bg-green-500/20">

                                                    <Link :href="route('task.edit',{id:task.id,locale:usePage().props.locale})"  class="text-center avatar-sm success-bg-subtle d-inline-block rounded-circle fs-18">
                                                        <i class="uil uil-edit"></i>
                                                    </Link>

                                                </div>

                                                <div class="w-10 h-10 text-lg leading-10 text-center text-red-500 rounded bg-red-500/20" >
                                                    <a  class="text-center avatar-sm danger-bg-subtle d-inline-block rounded-circle fs-18">
                                                        <i class="uil uil-trash-alt" data-db @click="deleteElement(task.id, index)"></i>
                                                    </a>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                                <div class="px-4 py-3 bg-gray-50 dark:bg-neutral-700">
                                    <div class="grid grid-cols-12">
                                        <div class="col-span-12 lg:col-span-6">
                                            <div>
                                                <p class="mb-0 text-gray-500 dark:text-gray-300"> <i class="mr-1 uil uil-clock-three group-data-[theme-color=violet]:text-violet-500 group-data-[theme-color=sky]:text-sky-500 group-data-[theme-color=red]:text-red-500  group-data-[theme-color=pink]:text-pink-500 group-data-[theme-color=blue]:text-blue-500"></i> {{ task.start_date }} - {{task.end_date  }}</p>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div v-else-if="form.name || form.category_id" class="space-y-8 text-center m-4 text-2xl">
                             {{ useTrans('page.no_results_found') }} <!-- Например: «Տվյալներ չեն գտնվել» -->
                        </div>
                        <div v-else class="space-y-8 text-center m-4 text-2xl">{{ useTrans('page.your_tasks_can_be_here') }}</div>





                        <div class="grid grid-cols-12 mb-2 w-[95%]"
                            v-if="pagination?.length > 3"
                        >
                            <div class="col-span-12">
                                <ul class="flex justify-center gap-2 mt-8">
                                    <li v-for="(link,index) in pagination"
                                        :key="index"
                                        :class="{active: link.active, disabled: !link.url, 'group-data-[theme-color=green]:bg-green-500 text-white': link.active, 'group-data-[theme-color=green]:bg-gray-200 ': !link.url }"
                                        @click="fetchPage(link)"
                                        class="w-12 h-12 text-center text-gray-900 transition-all duration-300 border rounded-full cursor-pointer border-gray-100/50 hover:bg-green-100/30 focus:bg-gray-100/30 dark:border-gray-100/20 dark:text-gray-50 dark:hover:bg-gray-500/20">
                                        <span class="text-16 leading-[2.8]" v-html="link.label.replace(/Հաջորդը|Նախորդը/, '')"></span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>

            </template>

    </Index>

        <!-- <Layout>
                 <Head title="task-list" />
                 <section>
                 </section>
        </Layout> -->

</template>
