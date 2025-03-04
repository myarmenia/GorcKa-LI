<script setup>


import { Head, useForm, router  } from '@inertiajs/vue3';
import Index from './Index.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Select from '@/Components/Select.vue';
import { onMounted,ref, watch , computed} from 'vue';

import { usePage } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import FileInput from '@/Components/FileInput.vue';
import { useTrans } from '/resources/js/trans';
import InputError from '@/Components/InputError.vue';




// =====for lang =====
const props = defineProps({
    categories: Array,
    locations: Array,
    locale: String
});


// ===== Получаем категории с подкатегориями из props
const { categories } = usePage().props; //
const { locations } = usePage().props;

const {locale } = usePage().props;

// ===== Подкатегории для выбранной категории
const subcategories = ref([]);
const selectedFiles = ref([]);


// ======= file =========
const previewUrls = ref([]);


const handleFileUpload = (event) => {
  const files = event.target.files;

  if (files.length) {

    for (let file of files) {
            form.file.push(file);
            previewUrls.value.push(URL.createObjectURL(file)); // Generate preview
        }


  }
};


// Remove file from preview and form data
const removeNewFile = (index) => {
    form.file.splice(index, 1);
    previewUrls.value.splice(index, 1);
};


const form = useForm({

    category_id: categories.length > 0 ? categories[0].id : '',
    sub_category_id: '',
    location_id: '',
    title: '',
    price_min: '',
    price_max: '',
    description: '',
    start_date: '',
    end_date: "",
    lang: locale,
    file: [],

});






// Метод для обработки изменения категории


const onCategoryChange = () => {
  if (!props.categories) return;
   const selectedCategory = props.categories.find(category => category.id === form.category_id);
  subcategories.value = selectedCategory ? selectedCategory.sub_categories || [] : [];

};



// Массив подкатегорий с переведенными названиями
const subcategoryOptions = computed(() => {
  return subcategories.value.map(subcategory => ({
    value: subcategory.id,
    text: subcategory.translation?.name || 'Без названия'
  }));
});
console.log(subcategoryOptions)










const submitForm = () => {
    console.log(form.errors)
    form.post(route('task.store',{ locale: usePage().props.locale }));

};

// Инициализируем подкатегории при первом рендере
watch(() => form.category_id, onCategoryChange, { immediate: true });



</script>
<style>
.preview-container {
  display: flex;
  flex-wrap: wrap;
  gap: 50px;
  margin-top: 10px;

}
.preview-item {
  position: relative;
  display: inline-block;
}
.preview-img {
  width: 100px;
  height: 100px;
  object-fit: cover;
  border-radius: 5px;

}
.delete-icon {
  position: absolute;
  top: -10px;
  right: -30px;

  color: white;
  border-radius: 50%;
  padding: 5px;
  cursor: pointer;
  font-size: 16px;
}
</style>

<template>
    <Index>
        <Head title = "Task" />
        <template #content>
            <div class="w-full tab-pane block" id="settings-tab">
                                                    <div class="pt-8 space-x-8">
                                                        <form  @submit.prevent = submitForm >
                                                            <div>
                                                                <h5 class="mb-3 text-gray-900 fs-17 fw-semibold dark:text-gray-50">{{ useTrans('page.create_task') }}</h5>

                                                                <div class="mt-5">
                                                                    <div class="grid grid-cols-12 gap-5">
                                                                         <!--Title col-->
                                                                         <div class="col-span-12 lg:col-span-6">
                                                                            <div class="mb-3">
                                                                                 <!-- <pre>{{ $page.props }}</pre> -->

                                                                                <InputLabel for="title" :value="$page.props.translations.page.task_name" class="text-grey"/>
                                                                                <TextInput
                                                                                 v-model="form.title"
                                                                                 id="title"
                                                                                 type="text"
                                                                                 class="w-full mt-1 text-gray-500 border rounded border-gray-100/50 text-13 dark:bg-transparent dark:border-neutral-600"
                                                                                 autofocus
                                                                                 autocomplete="title"
                                                                                 :placeholder="useTrans('page.enter_task_name')"

                                                                                />
                                                                                <InputError class="mt-2 opacity-60" :message="form.errors.title" />



                                                                            </div>
                                                                         </div>
                                                                         <!-- Title col end -->
                                                                          <!--Title col-->
                                                                         <div class="col-span-12 lg:col-span-6">
                                                                            <div class="mb-3">
                                                                                <InputLabel for="category" value="category name" class="text-white" />
                                                                                <Select
                                                                                    v-model="form.location_id"
                                                                                    :id="'location'"
                                                                                    :label="useTrans('page.select_location')"
                                                                                    :name="'location_id'"
                                                                                    :options="locations.map(location => ({
                                                                                        value: location.id,
                                                                                        text: location.translation?.name || 'Без названия'
                                                                                    }))"


                                                                                />
                                                                                <InputError class="mt-2 opacity-60" :message="form.errors.location_id" />


                                                                            </div>
                                                                         </div>
                                                                         <!-- Title col end -->
                                                                        <div class="col-span-12 lg:col-span-6">
                                                                            <div class="mb-3">
                                                                                <InputLabel for="category" value="category name" class="text-white" />


                                                                                <Select
                                                                                    v-model="form.category_id"
                                                                                    :id="'category'"
                                                                                    :label="useTrans('page.select_category')"
                                                                                    :name="'category_id'"
                                                                                    :options="categories.map(category => ({
                                                                                        value: category.id,
                                                                                        text: category.translation?.name || 'Без названия'
                                                                                    }))"


                                                                                />
                                                                                <InputError class="mt-2 opacity-60" :message="form.errors.category_id" />




                                                                            </div>
                                                                        </div>

                                                                        <!--end col-->
                                                                        <div class="col-span-12 lg:col-span-6">
                                                                            <div class="mb-3">
                                                                                <InputLabel for="sub_category" value="sub_category name" class="text-white"/>
                                                                                <Select
                                                                                    v-model = "form.sub_category_id"
                                                                                    :id = "'sub_category'"
                                                                                    :label = "useTrans('page.select_sub_category')"
                                                                                    :name = "'sub_category_id'"
                                                                                    :options = "subcategoryOptions"


                                                                                />
                                                                                <InputError class="mt-2 opacity-60" :message="form.errors.sub_category_id" />
                                                                            </div>
                                                                        </div>
                                                                        <!--end col-->
                                                                        <!-- min price start -->
                                                                        <div class="col-span-12 lg:col-span-6">
                                                                            <div class="mb-3">
                                                                                <InputLabel for="price_min" :value="useTrans('page.price_min')" class="text-grey" />
                                                                                <TextInput
                                                                                    v-model="form.price_min"
                                                                                    id = "price_min"
                                                                                    min = "0"
                                                                                    type = "number"
                                                                                    class = "w-full mt-1 text-gray-500 border rounded border-gray-100/50 text-13 dark:bg-transparent dark:border-neutral-600"
                                                                                    autofocus
                                                                                    :placeholder = "useTrans('page.price_min')"

                                                                                />
                                                                                <InputError class="mt-2 opacity-60" :message="form.errors.price_min" />
                                                                            </div>
                                                                        </div>
                                                                        <!-- min price end -->
                                                                            <!-- location end -->
                                                                        <div class="col-span-12 lg:col-span-6">
                                                                            <div class="mb-3">
                                                                                <InputLabel for="price_max" :value="useTrans('page.price_max')" class="text-grey" />
                                                                                <TextInput
                                                                                 v-model="form.price_max"
                                                                                 id="price_max"
                                                                                 type="number"
                                                                                 min="0"
                                                                                 class="w-full mt-1 text-gray-500 border rounded border-gray-100/50 text-13 dark:bg-transparent dark:border-neutral-600"

                                                                                 autofocus
                                                                                 :placeholder="useTrans('page.price_max')"

                                                                                />
                                                                                <InputError class="mt-2 opacity-60" :message="form.errors.price_max" />
                                                                            </div>
                                                                        </div>



                                                                        <!--end col-->
                                                                    </div>
                                                                </div>
                                                                <!-- ----second section -->
                                                                <div class="mt-5">
                                                                    <div class="grid grid-cols-12 gap-5">

                                                                        <!--end col-->
                                                                        <div class="col-span-12 lg:col-span-6">
                                                                            <div class="mb-3">
                                                                                <InputLabel for="startDate" :value="useTrans('page.start_date')" class="text-grey" />
                                                                                <TextInput
                                                                                v-model="form.start_date"
                                                                                 :id="startDate"
                                                                                 type="date"
                                                                                 class="w-full mt-1 text-gray-500 border rounded border-gray-100/50 text-13 dark:bg-transparent dark:border-neutral-600"
                                                                                 autofocus
                                                                                 :placeholder="useTrans('page.start_date')"

                                                                                />
                                                                                <InputError class="mt-2 opacity-60" :message="form.errors.start_date" />


                                                                            </div>
                                                                        </div>
                                                                        <div class="col-span-12 lg:col-span-6">
                                                                            <div class="mb-3">

                                                                                <InputLabel for="endDate" :value="useTrans('page.end_date')" class="text-grey" />
                                                                                <TextInput
                                                                                v-model="form.end_date"
                                                                                :id="endDate"
                                                                                type="date"
                                                                                class="w-full mt-1 text-gray-500 border rounded border-gray-100/50 text-13 dark:bg-transparent dark:border-neutral-600"
                                                                                autofocus
                                                                                :placeholder="useTrans('page.end_date')"

                                                                                />
                                                                                <InputError class="mt-2 opacity-60" :message="form.errors.end_date" />
                                                                            </div>

                                                                        </div>
                                                                        <!--end col-->


                                                                    </div>
                                                                </div>

                                                                <!--end row-->
                                                            </div>
                                                            <!--end account-->
                                                            <div class="mt-4">

                                                                <div class="grid grid-cols-12 gap-5">
                                                                    <div class="col-span-12">
                                                                        <div class="mb-3">
                                                                            <InputLabel for="textarea" :value="useTrans('page.description')" class="text-grey" />
                                                                            <TextArea
                                                                             id="textarea"
                                                                             v-model = "form.description"
                                                                             :placeholder = "useTrans('page.description')"
                                                                             rows="5" />




                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->

                                                                    <!--end col-->
                                                                    <div class="col-span-12">
                                                                        <div class="mb-3 ">
                                                                            <div class="mb-3">
                                                                                <InputLabel for="file" :value="useTrans('page.chose_file')" class="text-grey" />

                                                                                 <div>

                                                                                    <div>
                                                                                        <input type="file" multiple @change="handleFileUpload">

                                                                                        <div v-if="previewUrls.length" class="preview-container">

                                                                                            <!-- <img v-for="(url, index) in previewUrls" :key="index" :src="url" class="preview-img"> -->
                                                                                            <div v-for="(url, index) in previewUrls" :key="index" class="preview-item">
                                                                                                <img :src="url" class="preview-img">
                                                                                                <i class="bx bx-trash delete-icon bg-green-500" @click="removeNewFile(index)"></i>
                                                                                            </div>

                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                </div>
                                                                <!--end row-->
                                                            </div>


                                                            <!--end Change-password-->
                                                            <div class="mt-8 text-right">


                                                                <button type="submit" class="text-white btn group-data-[theme-color=violet]:bg-violet-500 group-data-[theme-color=sky]:bg-sky-500 group-data-[theme-color=red]:bg-red-500 group-data-[theme-color=green]:bg-green-500 group-data-[theme-color=pink]:bg-pink-500 group-data-[theme-color=blue]:bg-blue-500 border-transparent focus:ring group-data-[theme-color=violet]:focus:ring-violet-500/20 group-data-[theme-color=sky]:focus:ring-sky-500/20 group-data-[theme-color=red]:focus:ring-red-500/20 group-data-[theme-color=green]:focus:ring-green-500/20 group-data-[theme-color=pink]:focus:ring-pink-500/20 group-data-[theme-color=blue]:focus:ring-blue-500/20">{{ useTrans('form.create') }}</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
        </template>
    </Index>

</template>
