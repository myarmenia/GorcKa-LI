<script setup>
import SearchSelect from '@/Components/SearchSelect.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { computed, ref, watch } from "vue";
import { Head, useForm, router } from '@inertiajs/vue3';
import { useTrans } from '/resources/js/trans';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
  locale: String,
  categories: Array,
});

const searchSelectCategory = ref('');

const form = useForm({
    name: '',
    category_id: ''
});

const categoryOptions = computed(() => {
    return props.categories.map(category => ({
        value: category.id,
        text: category.item_translations[0]?.name
    }));
});

watch(() => props.locale, (newLocale) => {

    const selectedCategory = props.categories.find(cat => cat.id == form.category_id);

    if (selectedCategory) {
        const catName = selectedCategory.item_translations[0].name

        searchSelectCategory.value.addInputText(catName)
    }
});

const submit = () => {

    Inertia.get(route('jobs', { locale: props.locale }), {
        category_id: form.category_id,
        name: form.name
    });
};


</script>

<template>
    <section class="relative bg-opacity-10 py-28 dark:bg-violet-900 group-data-[theme-color=green]:bg-green-500/20 ">
        <div class="container mx-auto">
            <div class="grid items-center grid-cols-12 rtl:gap-10">
                <div class="col-span-12 lg:col-span-7">
                    <div class="mb-3 ltr:mr-14 rtl:ml-14">
                        <h1 class="hidden">{{ useTrans('page.find_job.h1') }}</h1>
                        <h2 class="mb-3 text-4xl font-semibold leading-tight text-gray-900 dark:text-gray-50">{{ useTrans('page.find_job.h1_1') }} <br>  <span class="font-bold group-data-[theme-color=green]:text-green-500 "> {{ useTrans('page.find_job.h1_2') }}</span> {{ useTrans('page.find_job.h1_3') }}   </h2>
                        <p class="text-lg font-light text-gray-500 whitespace-pre-line dark:text-gray-300">{{ useTrans('page.find_job.p') }}</p>
                    </div>
                    <form @submit.prevent="submit">
                        <div class="registration-form">
                            <div class="grid grid-cols-12">
                                <div class="col-span-12 xl:col-span-4">
                                    <div class="mt-3 rounded-l filter-search-form filter-border mt-md-0">
                                        <i class="uil uil-briefcase-alt"></i>
                                        <input type="search" v-model="form.name" id="job-title" class="w-full filter-input-box placeholder:text-gray-100 placeholder:text-13 dark:text-gray-100" :placeholder="useTrans('page.find_job.name')">
                                    </div>
                                </div><!--end col-->


                                <div class="col-span-12 xl:col-span-4">
                                    <div class="mt-3 rounded-l filter-search-form filter-border mt-md-0">
                                            <i class="uil uil-clipboard-notes"></i>
                                            <div class="py-2 bg-white">
                                                <SearchSelect
                                                    ref="searchSelectCategory"
                                                    v-model="form.category_id"
                                                    route="category-subcategory-filter"
                                                    :options="categoryOptions"
                                                    :border="false"
                                                />
                                            </div>
                                    </div>
                                </div>

                                <div class="col-span-12 xl:col-span-4">
                                    <div class="h-full mt-3">
                                        <PrimaryButton class="ltr:xl:rounded-l-none rtl:xl:rounded-r-none w-full py-[18px] text-white "
                                            :class="{ 'opacity-25': form.processing }"
                                            @click="submit"
                                            :disabled="form.processing">
                                            <i class="uil uil-search me-1"></i>{{useTrans('page.find_job.find_job')}}
                                        </PrimaryButton>
                                    </div>
                                </div><!--end col-->
                            </div><!--end row-->
                        </div>
                    </form>
                </div>
                <div class="col-span-12 lg:col-span-5 flex justify-end">
    <div class="mt-5 ml-auto">
        <img src="assets/user/images/process-02.png" alt="" class="mb-5 home-img max-w-[300px] hidden lg:block">
    </div>
</div>
            </div>
        </div>
        <img src="assets/user/images/bg-shape.png" alt="" class="absolute block -bottom-5 dark:hidden">
        <img src="assets/user/images/bg-shape-dark.png" alt="" class="absolute hidden -bottom-5 dark:block">
    </section>

</template>


