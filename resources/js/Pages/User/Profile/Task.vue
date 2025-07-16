<script setup>

    import { Head, useForm, router  } from '@inertiajs/vue3';
    import Index from './Index.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import Select from '@/Components/Select.vue';
    import { onMounted,ref, watch , computed} from 'vue';

    import { usePage } from '@inertiajs/vue3';
    import TextInput from '@/Components/TextInput.vue';
    import TextArea from '@/Components/TextArea.vue';
    import { useTrans } from '/resources/js/trans';
    import InputError from '@/Components/InputError.vue';


    const props = defineProps({
        categories: Array,
        locations: Array,
        locale: String
    });
    console.log(props.categories,'categories')

    const form = useForm({
            category_id: props.categories.length > 0 ? props.categories[0].id : '',
            sub_category_id: '',
            location_id: '',
            title: '',
            price_min: '',
            price_max: '',
            description: '',
            start_date: '',
            end_date: "",
            task_type: '',
            lang: props.locale,
            file: [],

        });
console.log(form.category_id,'category_id')




// Computed property for select options
const locationOptions = computed(() => {
    return props.locations.map(location => ({
        value: location.id,
        text: location.translation?.name || 'Без названия'
    }));
});



// ===== Подкатегории для выбранной категории
const subcategories = ref([]);
const selectedFiles = ref([]);








// ======= file =========
const fileInput = ref(null);

const triggerFileInput = () => {
  fileInput.value.click(); // открывает выбор файла
};
const previewUrls = ref([]);


const handleFileUpload = (event) => {
  console.log('handleFileUpload triggered');

  const files = event.target.files;

  if (files.length) {

    for (let file of files) {
        let fileName = file.name;
        let filePreview = { url: URL.createObjectURL(file), name: fileName };
            form.file.push(file);
            // form.file = [...form.file, file];
            previewUrls.value.push(filePreview ); // Generate preview
            console.log()
    }

  }

};
console.log(form.file,'515')



const isImage = (file) => {
    // alert(1111)
    console.log(file,'2222')
  const imageFormats = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg'];
  const fileExtension = file.name.split('.').pop().toLowerCase();

  return imageFormats.includes(fileExtension);
};

const isOther = (file) => {
  const documentFormats = ['doc', 'docx', 'xls', 'xlsx', 'txt'];
  const fileExtension = file.name.split('.').pop().toLowerCase();
  return documentFormats.includes(fileExtension);
};

const isPdf = (file) => {
  const fileExtension = file.name.split('.').pop().toLowerCase();
  return fileExtension === 'pdf';
};
// console.log(fileInput.value.value,'7444')


// Remove file from preview and form data
const removeNewFile = (index) => {
    console.log(index,'kkk')
    form.file.splice(index, 1);
    console.log(previewUrls)
    previewUrls.value.splice(index, 1);

    // 🧹 Очистить input если все файлы удалены
    console.log(fileInput.value.files,'778888')

  if (form.file.length===0 && fileInput.value ) {

     fileInput.value.value = null;
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

// Computed property for select options
const categoryOptions = computed(() => {
    return props.categories.map(category => ({
        value: category.id,
        text: category.translation?.name || 'Без названия'
    }));
});


// Метод для обработки изменения категории
const onCategoryChange = () => {
  if (!props.categories) return;
   const selectedCategory = props.categories.find(category => category.id === form.category_id);
         subcategories.value = selectedCategory ? selectedCategory.sub_categories || [] : [];
         console.log(subcategories,"subcategories, onCategoryChange")

};



// Массив подкатегорий с переведенными названиями
const subcategoryOptions = computed(() => {
  return subcategories.value.map(subcategory => ({
    value: subcategory.id,
    text: subcategory.translation?.name || 'Без названия'
  }));
});
// console.log(subcategoryOptions)
const category_id = ref(null);

const submitForm = () => {
    // console.log(form.errors);

    form.post(route('task.store', { locale: props.locale }), {
        onSuccess: () => {

        },
        onError:() =>{
          console.log(form.errors,"errors");

        }

    });
};
// Инициализируем подкатегории при первом рендере

watch([() => form.category_id, () => props.categories,() => props.locale], () => {
  onCategoryChange();
}, { immediate: true });

// console.log(useTrans('page.files_not_selected'))


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
  color: rgb(42 181 125);
  /* color: green; */
  border-radius: 50%;
  padding: 5px;
  cursor: pointer;
  font-size: 16px;
  margin-left: 5px;
}
</style>

<template>
    <Index :title = "useTrans('page.task')">


            <template #content>
                <!-- <div>
                    <p v-if="flash.message">{{ flash.message }}</p>

                </div> -->
                <div class="w-full tab-pane block" id="settings-tab">
                                                        <div class="pt-8 space-x-8 flex justify-center">
                                                            <form  @submit.prevent = "submitForm"  class="w-[90%]">
                                                                <div>
                                                                    <h5 class="mb-3 text-gray-900 fs-17 fw-semibold dark:text-gray-50">{{ useTrans('page.create_task') }}</h5>

                                                                    <div class="mt-5">
                                                                        <div class="grid grid-cols-12 gap-5" >
                                                                            <!--Title col-->
                                                                            <div class="col-span-12 lg:col-span-6" >
                                                                                <div class="mb-3">
                                                                                    <InputLabel for="title" :value="$page.props.translations.page.task_name" class="text-grey" required />
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
                                                                            <div class="col-span-12 lg:col-span-6" >
                                                                                <div class="mb-3" >
                                                                                    <Select
                                                                                        v-model="form.location_id"
                                                                                        :id="'location'"
                                                                                        :label="useTrans('page.select_location')"
                                                                                        :name="'location_id'"
                                                                                        :options="locationOptions"
                                                                                        required
                                                                                    />
                                                                                    <InputError class="mt-2 opacity-60" :message="form.errors.location_id" />
                                                                                </div>
                                                                            </div>
                                                                            <!-- Title col end -->
                                                                            <div class="col-span-12 lg:col-span-6">
                                                                                <div class="mb-3">
                                                                                    <Select
                                                                                        v-model="form.category_id"
                                                                                        :value="form.category_id"
                                                                                        :id="'category'"
                                                                                        :label="useTrans('page.select_category')"
                                                                                        :name="'category_id'"
                                                                                        :options="categoryOptions"
                                                                                    />
                                                                                    <InputError class="mt-2 opacity-60" :message="form.errors.category_id" />

                                                                                </div>
                                                                            </div>

                                                                            <!--end col-->
                                                                            <div class="col-span-12 lg:col-span-6">
                                                                                <div class="mb-3">
                                                                                    <Select
                                                                                        v-model = "form.sub_category_id"
                                                                                        :id = "'sub_category'"
                                                                                        :label = "useTrans('page.select_sub_category')"
                                                                                        :name = "'sub_category_id'"
                                                                                        :options = "subcategoryOptions"
                                                                                        required
                                                                                    />
                                                                                    <InputError class="mt-2 opacity-60" :message="form.errors.sub_category_id" />
                                                                                </div>
                                                                            </div>
                                                                            <!--end col-->
                                                                            <!-- min price start -->
                                                                            <div class="col-span-12 lg:col-span-6">
                                                                                <div class="mb-3">
                                                                                    <InputLabel for="price_min" :value="useTrans('page.price_min')" class="text-grey" :showCurrency="true" />
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
                                                                                    <!-- required  -->
                                                                                    <InputLabel for="price_max" :value="useTrans('page.price_max')" class="text-grey" required :showCurrency="true" />
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
                                                                                    <!-- required -->
                                                                                    <InputLabel for="endDate" :value="useTrans('page.end_date')" class="text-grey"  />
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
                                                                        <div class="col-span-12">
                                                                            <div class="mb-3 ">
                                                                                <div class="mb-3">
                                                                                    <InputLabel for="file" :value="useTrans('page.chose_file')" class="text-grey" />
                                                                                    <div>
                                                                                        <div>
                                                                                            <!-- ========= file section start -->
                                                                                            <button type="button" @click="triggerFileInput" class="text-green-500">
                                                                                                <i class="uil uil-download-alt text-4xl "></i>
                                                                                            </button>


                                                                                        <input type="file"
                                                                                            multiple
                                                                                                ref="fileInput"
                                                                                                class="hidden"
                                                                                                @change="handleFileUpload">

                                                                                                <p class="mt-2 text-sm text-gray-600">{{ selectedFilesCountText }}</p>
                                                                                        <div v-if="previewUrls.length">
                                                                                            <div v-for="(file, index) in previewUrls" :key="index" class="preview-item"  >
                                                                                                <div class="files flex   mt-2" v-if="isImage(file)" >
                                                                                                    <img :src="file.url" class="preview-img inline">
                                                                                                    <!-- <i class="bx bx-trash delete-icon delete-icon-position ml-1 text-2xl inline " @click="removeNewFile(index, $event)"></i> -->
                                                                                                    <div class="  w-10 h-10 text-lg leading-10 text-center text-red-500 rounded bg-red-500/20" >
                                                                                                        <a href="javascript:void(0)"  class="text-center avatar-sm danger-bg-subtle d-inline-block rounded-circle fs-18">
                                                                                                            <i class="uil uil-trash-alt" data-db @click="removeNewFile(index, $event)"></i>
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
                                                                                                    <!-- <i class="bx bx-trash delete-icon inline  bg-green-500"  @click.prevent="removeNewFile(index, $event)"></i> -->
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
                                                                                                    <!-- <i class="bx bx-trash delete-icon bg-green-500 ml-2"  @click.prevent="removeNewFile(index, $event)"></i> -->
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

                                                                        <!--end col-->
                                                                    </div>
                                                                    <!--end row-->
                                                                </div>


                                                                <!--end Change-password-->
                                                                <div class="mt-8 text-right mb-5" >
                                                                    <button type="submit" class=" text-white btn group-data-[theme-color=violet]:bg-violet-500 group-data-[theme-color=sky]:bg-sky-500 group-data-[theme-color=red]:bg-red-500 group-data-[theme-color=green]:bg-green-500 group-data-[theme-color=pink]:bg-pink-500 group-data-[theme-color=blue]:bg-blue-500 border-transparent focus:ring group-data-[theme-color=violet]:focus:ring-violet-500/20 group-data-[theme-color=sky]:focus:ring-sky-500/20 group-data-[theme-color=red]:focus:ring-red-500/20 group-data-[theme-color=green]:focus:ring-green-500/20 group-data-[theme-color=pink]:focus:ring-pink-500/20 group-data-[theme-color=blue]:focus:ring-blue-500/20">{{ useTrans('form.create') }}</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
            </template>

    </Index>

</template>
