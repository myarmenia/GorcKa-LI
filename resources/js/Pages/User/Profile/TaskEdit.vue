<script setup>
import { Head, useForm, router  } from '@inertiajs/vue3';
import Index from './Index.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Select from '@/Components/Select.vue';
import { onMounted,ref, watch, computed,  watchEffect} from 'vue';

import { usePage } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';

import { useTrans } from '/resources/js/trans';
import InputError from '@/Components/InputError.vue';
import TaskEditSelect from '@/Components/TaskEditSelect.vue';
import axios from 'axios';


const { task, task_category_id,task_category,files } = usePage().props;

const subcategories = ref(task_category[0].sub_categories);
console.log(subcategories,'444')


const props = defineProps({
    categories: Array,
    locations: Array,
    locale: String
});

const form = useForm({

    category_id: task_category_id,
    sub_category_id: task.sub_category_id,
    location_id: task.location_id,
    title: task.title,
    price_min: task.price_min,
    price_max: task.price_max,
    description: task.description,
    start_date: task.start_date,
    end_date: task.end_date,
    task_type: task.task_type,
    lang: props.locale,
    file: [],

});
console.log(form.file,'task')



// Computed property for select options
const locationOptions = computed(() => {
    return props.locations.map(location => ({
        value: location.id,
        text: location.translation?.name || 'Без названия'
    }));
});
// Computed property for select options
const categoryOptions = computed(() => {
    return props.categories.map(category => ({
        value: category.id,
        text: category.translation?.name || 'Без названия'
    }));
});
console.log(categoryOptions,'categories')
// ======= file =========
const previewUrls = ref([]);

const handleFileUpload = (event) => {
  const files = event.target.files;

  if (files.length) {
       for (let file of files) {
            let fileName = file.name;
            let filePreview = { url: URL.createObjectURL(file), name: fileName };
                form.file.push(file);
                previewUrls.value.push(filePreview ); // Generate preview


        }
  }
};
console.log(previewUrls,'previewUrls')


// Remove file from preview and form data
const removeNewFile =async (index,event) => {
    if (!event) {
    console.log("Event is undefined");
    return;
  }

    const hasDataDb = event.target.hasAttribute('data-db');
    if (hasDataDb) {

        const element = event.target.closest(".preview-item");


            try {
                const response = await axios.delete(`/delete-item/filables/${index}`);


                // Remove file from UI after successful deletion
                if (element) {

                    const elementId = element.getAttribute("data-id"); // Get data-id attribute

                    if (parseInt(elementId) === index) { // Compare with file.id
                       element.remove(); // Remove from DOM
                    }
                }

            } catch (error) {
                console.error('Error deleting file:', error.response?.data || error.message);
            }



    // Perform your logic here for when the attribute exists
  } else {

        form.file.splice(index, 1);
        previewUrls.value.splice(index, 1);
  }
};





const subcategoryOptions = computed(() => {
  return subcategories.value.map(subcategory => ({
    value: subcategory.id,
    text: subcategory.translation?.name || 'Без названия'
  }));
});


const onCategoryChange = () => {

  if (props.categories.length==0) return;

   const selectedCategory = props.categories.find(category => category.id === form.category_id);
         subcategories.value = selectedCategory ? selectedCategory.sub_categories || [] : [];

};

// Инициализируем подкатегории при первом рендере
// watch(() => form.category_id, onCategoryChange, { immediate: true });
watch([() => form.category_id, () => props.categories,() => props.locale], () => {
  onCategoryChange();
}, { immediate: true });



const submitForm = () => {

    form.post(route('task.update',{ id:task.id, locale: props.locale }));

};


const isImage = (file) => {
//     // alert(1111)
    console.log(file,'2222')
    // console.log(file.name,'2223')
  const imageFormats = ['jpg', 'jpeg', 'png','PNG', 'gif', 'bmp', 'svg'];
  const fileExtension = file.name.split('.').pop().toLowerCase();

  return imageFormats.includes(fileExtension);
};

const isOther = (file) => {
    // alert('isOther')
//     console.log(file,'isOther')
  const documentFormats = ['doc', 'docx', 'xls', 'xlsx', 'txt'];
  const fileExtension = file.name.split('.').pop().toLowerCase();
  return documentFormats.includes(fileExtension);
};
const isPdf = (file) => {
  const fileExtension = file.name.split('.').pop().toLowerCase();
  return fileExtension === 'pdf';
};

</script>
<style>
/* .preview-container {
  display: flex;
  flex-wrap: wrap;
  gap: 50px;
  margin-top: 10px;

} */
.preview-item {
  position: relative;
  display: block;
}
.preview-img {
  width: 100px;
  height: 100px;
  object-fit: cover;
  border-radius: 5px;

}
.delete-icon {
  position: absolute;
  top: 0;
  right: 50px;

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
                    <form  @submit.prevent = submitForm  >
                        <div>
                            <h5 class="mb-3 text-gray-900 fs-17 fw-semibold dark:text-gray-50">{{ useTrans('page.edit_task') }}</h5>

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



                                            <TaskEditSelect
                                                v-model="form.location_id"
                                                :id="location"
                                                :label="useTrans('page.select_location')"
                                                :options="locationOptions"
                                                :placeholder=" useTrans('form.select_placeholder')"
                                            />

                                            <InputError class="mt-2 opacity-60" :message="form.errors.location_id" />


                                        </div>
                                        </div>
                                        <!-- Title col end -->
                                    <div class="col-span-12 lg:col-span-6">
                                        <div class="mb-3">
                                            <InputLabel for="category" value="category name" class="text-white" />
                                            <TaskEditSelect
                                                v-model="form.category_id"
                                                :id="'category'"
                                                :label="useTrans('page.select_category')"
                                                :options="categoryOptions"
                                                :placeholder=" useTrans('form.select_placeholder')"
                                                @change="handleCategoryChange"
                                            />
                                            <InputError class="mt-2 opacity-60" :message="form.errors.category_id" />

                                        </div>
                                    </div>

                                    <!--end col-->
                                    <div class="col-span-12 lg:col-span-6">
                                        <div class="mb-3">
                                            <InputLabel for="sub_category" value="sub_category name" class="text-white"/>
                                                <TaskEditSelect
                                                v-model = "form.sub_category_id"
                                                :id = "'sub_category'"
                                                :label = "useTrans('page.select_sub_category')"
                                                :options = "subcategoryOptions"
                                                :placeholder = " useTrans('form.select_placeholder')"
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
                                                id="price_min"
                                                type="number"
                                                min="0"
                                                class="w-full mt-1 text-gray-500 border rounded border-gray-100/50 text-13 dark:bg-transparent dark:border-neutral-600"

                                                autofocus
                                                :placeholder="useTrans('page.price_min')"

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
                                                :value = "task.start_date"
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
                                <!--  -->
                                <div class="col-span-12">
                                    <div class="mb-3">
                                        <InputLabel for="checkbox" :value="useTrans('page.task_type')" class="text-grey" />
                                        <div class="flex items-center space-x-2">
                                            <input
                                           type= "checkbox"
                                           id = "checkbox"
                                           v-model = "form.task_type"
                                           true-value="1"
                                           false-value="0"
                                            >
                                            <span>{{ useTrans('page.remote_task') }}</span>

                                        </div>
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
                                                    <input type="file" multiple  ref="fileInput" @change="handleFileUpload" accept=".jpg,.jpeg,.png,.gif,.bmp,.svg,.doc,.docx,.xls,.xlsx,.txt,.pdf">
                                                    <div v-if="files && files.length" >
                                                        <div v-for="(file, index) in files" :key="file.id" class="preview-item" :data-id="file.id" >
                                                            <div class="files d-flex align-items-start mt-2" v-if="isImage(file)">

                                                                <img :src="file.path" :alt="file.name"  class="preview-img"  />
                                                                <i class="bx bx-trash delete-icon bg-green-500" data-db @click.prevent="removeNewFile(file.id, $event)"></i>

                                                            </div>

                                                            <div v-else-if="isOther(file)" class="mt-2" >
                                                                <a :href="file.path" class="flex" target="_blank" >
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                                        <path fill="currentColor" d="M6 2h7l5 5v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm7 1.5V8h4.5L13 3.5z"/>
                                                                    </svg>
                                                                    {{ file.name }}
                                                                </a>
                                                                <i class="bx bx-trash delete-icon bg-green-500" data-db @click.prevent="removeNewFile(file.id, $event)"></i>

                                                            </div>
                                                            <div v-else-if="isPdf(file)" class="mt-2" >
                                                                <a :href="file.path" class="flex" target="_blank">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                                        <path fill="currentColor" d="M6 2h7l5 5v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm7 1.5V8h4.5L13 3.5z"/>
                                                                    </svg>
                                                                     {{ file.name }}
                                                                </a>
                                                                <i class="bx bx-trash delete-icon bg-green-500" data-db @click.prevent="removeNewFile(file.id, $event)"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- ----------- -->


                                                    <div v-if="previewUrls.length">

                                                        <div v-for="(file, index) in previewUrls" :key="index" class="preview-item"  >
                                                            <div class="files d-flex align-items-start mt-2" v-if="isImage(file)" >
                                                                <img :src="file.url" class="preview-img">
                                                                <i class="bx bx-trash delete-icon bg-green-500" @click="removeNewFile(index, $event)"></i>

                                                            </div>
                                                            <div v-else-if="isOther(file)" class="mt-2" style="border:1px solid red">
                                                                <a :href="file.path" class="flex" target="_blank" >
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                                        <path fill="currentColor" d="M6 2h7l5 5v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm7 1.5V8h4.5L13 3.5z"/>
                                                                    </svg>
                                                                    {{ file.name }}
                                                                </a>
                                                                <i class="bx bx-trash delete-icon bg-green-500"  @click.prevent="removeNewFile(index, $event)"></i>


                                                            </div>
                                                            <div v-else-if="isPdf(file)" class="mt-2" >
                                                                <a :href="file.path" class="flex" target="_blank">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                                        <path fill="currentColor" d="M6 2h7l5 5v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm7 1.5V8h4.5L13 3.5z"/>
                                                                    </svg>
                                                                     {{ file.name }}
                                                                </a>
                                                                <i class="bx bx-trash delete-icon bg-green-500"  @click.prevent="removeNewFile(index, $event)"></i>


                                                            </div>
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


                            <button type="submit" class="text-white btn group-data-[theme-color=violet]:bg-violet-500 group-data-[theme-color=sky]:bg-sky-500 group-data-[theme-color=red]:bg-red-500 group-data-[theme-color=green]:bg-green-500 group-data-[theme-color=pink]:bg-pink-500 group-data-[theme-color=blue]:bg-blue-500 border-transparent focus:ring group-data-[theme-color=violet]:focus:ring-violet-500/20 group-data-[theme-color=sky]:focus:ring-sky-500/20 group-data-[theme-color=red]:focus:ring-red-500/20 group-data-[theme-color=green]:focus:ring-green-500/20 group-data-[theme-color=pink]:focus:ring-pink-500/20 group-data-[theme-color=blue]:focus:ring-blue-500/20">{{ useTrans('form.save') }}</button>
                        </div>
                    </form>

                </div>
            </div>
        </template>
    </Index>

</template>
