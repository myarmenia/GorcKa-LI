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

// ======= file =========
const fileInput = ref(null);
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

const selectedFilesCountText = computed(() => {
  const count = form.file.length;
  if (count === 0) return useTrans('page.files_not_selected');
  if (count === 1) return useTrans('page.one_file_selected');
//   return useTrans('page.multiple_files_selected',{ count });
  const translation = useTrans('page.multiple_files_selected'); // это вернёт строку с ":count"
  return translation.replace(':count', count); // вручную заменяем
});







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

    form.post(route('task.update',{ id:task.id, locale: props.locale }), {
        onSuccess: () => {


        },
        onError:() =>{

              console.log(form.errors,"errors");
              }
        });

};


const isImage = (file) => {
//     // alert(1111)
    console.log(file,'2222')
    // console.log(file.name,'2223')
  const imageFormats = ['jpg', 'jpeg', 'png','PNG', 'gif', 'bmp', 'svg','webp'];
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

const triggerFileInput = () => {
  fileInput.value.click(); // открывает выбор файла
};

</script>
<style>

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
.delete-icon-position {
  position: absolute;
  top: 0;
}
.delete-icon {

  color: white;
  border-radius: 50%;
  padding: 5px;
  cursor: pointer;
  font-size: 16px;
  margin-left: 5px;
}
</style>
<template>
    <Index :title = "useTrans('page.task_edit')">
        <template #content>
            <div class="tab-pane block" id="settings-tab">

                <div class="pt-8  flex justify-center">
                   <form  @submit.prevent = "submitForm" class="w-[90%]" >
                        <div >
                            <h5 class="mb-3 text-gray-900 fs-17 fw-semibold dark:text-gray-50">{{ useTrans('page.edit_task') }}</h5>
                            <div class="mt-5" >
                                    <div class="grid grid-cols-12 gap-5">
                                        <div class="col-span-12 lg:col-span-6">
                                            <div class="mb-3">
                                                <InputLabel for="title" :value="$page.props.translations.page.task_name" class="text-grey" required/>
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
                                        <div class="col-span-12 lg:col-span-6">
                                            <div class="mb-3">
                                                <TaskEditSelect
                                                    v-model="form.location_id"
                                                    :id="location"
                                                    :label="useTrans('page.select_location')"
                                                    :options="locationOptions"
                                                    :placeholder=" useTrans('form.select_placeholder')"
                                                    required
                                                />
                                                <InputError class="mt-2 opacity-60" :message="form.errors.location_id" />
                                            </div>
                                        </div>
                                        <div class="col-span-12 lg:col-span-6">
                                            <div class="mb-3">
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
                                        <div class="col-span-12 lg:col-span-6">
                                            <div class="mb-3">
                                                <TaskEditSelect
                                                    v-model = "form.sub_category_id"
                                                    :id = "'sub_category'"
                                                    :label = "useTrans('page.select_sub_category')"
                                                    :options = "subcategoryOptions"
                                                    :placeholder = " useTrans('form.select_placeholder')"
                                                    required
                                                />
                                                <InputError class="mt-2 opacity-60" :message="form.errors.sub_category_id" />
                                            </div>
                                        </div>
                                        <div class="col-span-12 lg:col-span-6">
                                            <div class="mb-3">
                                                <InputLabel for="price_min" :value="useTrans('page.price_min')" class="text-grey" :showCurrency="true" />
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
                                        <div class="col-span-12 lg:col-span-6">
                                            <div class="mb-3">
                                                <!-- required  -->
                                                <InputLabel for="price_max" :value="useTrans('page.price_max')" class="text-grey" required :showCurrency="true"/>
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

                                    </div>
                            </div>

                            <div class="mt-5">
                                <div class="grid grid-cols-12 gap-5">
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
                                            <InputLabel for="endDate" :value="useTrans('page.end_date')" class="text-grey" required/>
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
                                </div>
                            </div>
                        </div>

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
                                <div class="col-span-12">
                                    <div class="mb-3 ">
                                        <div class="mb-3">
                                            <InputLabel for="file" :value="useTrans('page.chose_file')" class="text-grey" />

                                                <div>

                                                <div>
                                                    <button type="button" @click="triggerFileInput" class="text-green-500">
                                                        <i class="uil uil-download-alt text-4xl"></i>
                                                    </button>
                                                    <input
                                                      type="file"
                                                      multiple
                                                      ref="fileInput"
                                                      class="hidden"
                                                      @change="handleFileUpload" accept=".jpg,.jpeg,.png,.gif,.bmp,.svg,.doc,.docx,.xls,.xlsx,.txt,.pdf"

                                                      >
                                                    <p class="mt-2 text-sm text-gray-600">{{ selectedFilesCountText }}</p>
                                                    <div v-if="files && files.length" >
                                                        <div v-for="(file, index) in files" :key="file.id" class="preview-item" :data-id="file.id"  >
                                                            <div class="files  flex mt-2" v-if="isImage(file)">
                                                                <img :src="file.path" :alt="file.name"  class="preview-img inline"  />
                                                                <div class="  w-10 h-10 text-lg leading-10 text-center text-red-500 rounded bg-red-500/20" >
                                                                        <a class="text-center avatar-sm danger-bg-subtle d-inline-block rounded-circle fs-18">
                                                                            <i class="uil uil-trash-alt" data-db  @click.prevent="removeNewFile(file.id, $event)"></i>
                                                                        </a>
                                                                </div>
                                                            </div>
                                                            <div v-else-if="isOther(file)" class="mt-2 flex" >
                                                                <a :href="file.path" class="flex " target="_blank" >
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                                        <path fill="currentColor" d="M6 2h7l5 5v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm7 1.5V8h4.5L13 3.5z"/>
                                                                    </svg>
                                                                    {{ file.name }}
                                                                </a>
                                                                <div class="  w-10 h-10 text-lg leading-10 text-center text-red-500 rounded bg-red-500/20" >
                                                                        <a  class="text-center avatar-sm danger-bg-subtle d-inline-block rounded-circle fs-18">
                                                                            <i class="uil uil-trash-alt" data-db  @click.prevent="removeNewFile(file.id, $event)"></i>
                                                                        </a>
                                                                </div>

                                                            </div>
                                                            <div v-else-if="isPdf(file)" class="mt-2 flex" >
                                                                <a :href="file.path" class="flex" target="_blank">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                                        <path fill="currentColor" d="M6 2h7l5 5v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm7 1.5V8h4.5L13 3.5z"/>
                                                                    </svg>
                                                                     {{ file.name }}
                                                                </a>
                                                                 <div class="  w-10 h-10 text-lg leading-10 text-center text-red-500 rounded bg-red-500/20" >
                                                                        <a  class="text-center avatar-sm danger-bg-subtle d-inline-block rounded-circle fs-18">
                                                                            <i class="uil uil-trash-alt" data-db  @click.prevent="removeNewFile(file.id, $event)"></i>
                                                                        </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div v-if="previewUrls.length">

                                                        <div v-for="(file, index) in previewUrls" :key="index" class="preview-item"  >
                                                            <div class="files flex   mt-2" v-if="isImage(file)" >
                                                                <img :src="file.url" class="preview-img inline">
                                                                <div class="  w-10 h-10 text-lg leading-10 text-center text-red-500 rounded bg-red-500/20" >
                                                                        <a  class="text-center avatar-sm danger-bg-subtle d-inline-block rounded-circle fs-18">
                                                                            <i class="uil uil-trash-alt"  @click.prevent="removeNewFile(index, $event)"></i>
                                                                        </a>
                                                                </div>
                                                            </div>
                                                            <div v-else-if="isOther(file)" class="mt-2 flex" >
                                                                <a :href="file.path" class="flex" target="_blank" >
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                                        <path fill="currentColor" d="M6 2h7l5 5v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm7 1.5V8h4.5L13 3.5z"/>
                                                                    </svg>
                                                                    {{ file.name }}
                                                                </a>
                                                                <div class="  w-10 h-10 text-lg leading-10 text-center text-red-500 rounded bg-red-500/20" >
                                                                        <a  class="text-center avatar-sm danger-bg-subtle d-inline-block rounded-circle fs-18">
                                                                            <i class="uil uil-trash-alt"  @click.prevent="removeNewFile(index, $event)"></i>
                                                                        </a>
                                                                </div>

                                                            </div>
                                                            <div v-else-if="isPdf(file)" class="mt-2 flex" >
                                                                <a :href="file.path" class="flex" target="_blank">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                                        <path fill="currentColor" d="M6 2h7l5 5v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm7 1.5V8h4.5L13 3.5z"/>
                                                                    </svg>
                                                                     {{ file.name }}
                                                                </a>
                                                                <div class="  w-10 h-10 text-lg leading-10 text-center text-red-500 rounded bg-red-500/20" >
                                                                        <a  class="text-center avatar-sm danger-bg-subtle d-inline-block rounded-circle fs-18">
                                                                            <i class="uil uil-trash-alt"  @click.prevent="removeNewFile(index, $event)"></i>
                                                                        </a>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>



                        <div class="mt-8 text-right mb-5">
                            <button type="submit" class="text-white btn group-data-[theme-color=violet]:bg-violet-500 group-data-[theme-color=sky]:bg-sky-500 group-data-[theme-color=red]:bg-red-500 group-data-[theme-color=green]:bg-green-500 group-data-[theme-color=pink]:bg-pink-500 group-data-[theme-color=blue]:bg-blue-500 border-transparent focus:ring group-data-[theme-color=violet]:focus:ring-violet-500/20 group-data-[theme-color=sky]:focus:ring-sky-500/20 group-data-[theme-color=red]:focus:ring-red-500/20 group-data-[theme-color=green]:focus:ring-green-500/20 group-data-[theme-color=pink]:focus:ring-pink-500/20 group-data-[theme-color=blue]:focus:ring-blue-500/20">{{ useTrans('form.save') }}</button>
                        </div>
                    </form>


                </div>
            </div>
        </template>
    </Index>

</template>
