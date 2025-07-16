<script setup>

import axios from 'axios';

import { computed, ref, reactive, onMounted, watch, onUnmounted, nextTick } from "vue";
import { useForm } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Select from '@/Components/Select.vue';
import TextArea from '@/Components/TextArea.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';


import { useTrans } from '/resources/js/trans';

const props = defineProps({
  locations: Array,
  langs: Array,
  locale: String,
  categories: Array,
  user: Object,
  socialMedias: Array,
  defaultAvatar: {
    type: String,
    default: '/assets/user/images/user.svg',
  },
});

console.log(props.user, props.socialMedias, 44444433333)

const imagePreviews = ref([]);
const selectedFiles = ref([]);
const removedImageIds = ref([]);
const fileInput = ref(null);
const imageError = ref('');
const totalImages = computed(() => existingImages.value.length + imagePreviews.value.length);

const locationOptions = computed(() =>
    props.locations.map(location => ({
        value: location.id,
        text: location.item_translations[0]?.name
    }))

);

const langOptions = computed(() =>
  props.langs.map(lang => ({
    value: lang.name,
    text: lang.name_uc
  }))

);


// const socialItems = Object.fromEntries(
//     props.socialMedias.map(type => {
//         const match = props.user.social_medias?.find(item => item.type === type);
//         return [type, match?.link || ''];
//     })
// );

const socialItems = Object.fromEntries(
    Object.keys(props.socialMedias).map(type => {
        const match = props.user.social_medias?.find(item => item.type === type);
        return [type, match?.link || ''];
    })
);


const form = useForm({
    name: props.user.name || '',
    phone: props.user.phone || '',
    location_id: props.user.location_id || '',
    lang: props.user.lang || '',
    description: props.user.description || '',
    socials: socialItems,
    locale: props.user.locale || 'am',
    avatar: null,
    remove_avatar: false,
    work_images: [],
});


function capitalize(text) {
    if (!text) return ''
    return text.charAt(0).toUpperCase() + text.slice(1)
}


// Для превью картинки (если выбрали новую)
const previewImage = ref(null);

// Если у пользователя есть аватар — показываем его, иначе дефолт
const avatarUrl = computed(() => {
    if (previewImage.value) {
    return previewImage.value;
  }

  if (form.remove_avatar) {
    return props.defaultAvatar;
  }

  return props.user.avatar
    ? '/storage/' + props.user.avatar
    : props.defaultAvatar;
});



// Обработка выбора файла
function handleImageChange(event) {
  const file = event.target.files[0];
  if (!file) return;

  form.avatar = file;
  form.remove_avatar = false
  // Создаём временный URL для превью
  previewImage.value = URL.createObjectURL(file);
}


// Удаление картинки (сбросить выбор и указать флаг на удаление)
function removeImage() {
  previewImage.value = null;
  form.avatar = null
  form.remove_avatar = true

}



// Преобразуем props.user.files (или works) в нужный формат
const existingImages = ref(
    props.user?.files?.map((img) => ({
        id: img.id,
        url: img.path.startsWith('http') ? img.path : `/storage/${img.path}`,

    })) || []
);




function triggerFileInput() {
  fileInput.value.click();
}

function handleFileChange(event) {
  const files = Array.from(event.target.files);
  const availableSlots = 10 - totalImages.value;

  if (files.length > availableSlots) {
    imageError.value = `Вы можете добавить ещё только ${availableSlots} изображений`;
    event.target.value = '';
    return;
  }

  imageError.value = '';

  for (const file of files) {
    const reader = new FileReader();
    reader.onload = (e) => {
      imagePreviews.value.push({ file, url: e.target.result });
      selectedFiles.value.push(file);
    };
    reader.readAsDataURL(file);
  }

  event.target.value = '';
}

function removeNewImage(index) {
  imagePreviews.value.splice(index, 1);
  selectedFiles.value.splice(index, 1);
}


const deleteExistingImage = async (id, index) => {
    if (totalImages.value < 4) {
        alert('Нужно минимум 3 изображения');
        return;
    }

    if (!confirm('Удалить это изображение?')) return;

    try {
        await axios.delete(`/delete-item/filables/${id}`);
        existingImages.value.splice(index, 1); // убираем из отображения
    } catch (error) {
        console.error('Ошибка при удалении изображения:', error);
        alert('Не удалось удалить изображение');
    }
};

const submit = () => {
    if (selectedFiles.value.length && totalImages.value < 3) {
        alert('Нужно минимум 3 изображения');
        return;
    }

    // Добавляем изображения в form (Inertia form helper)
    selectedFiles.value.forEach((file) => {
        form.work_images.push(file); // где form.images = []
    });


    form.post(route('user.profile.update', { locale: props.locale }), {
        // forceFormData: true, // очень важно для передачи файлов
        onFinish: () => {

            selectedFiles.value = [];
            form.work_images = [];

            console.log( selectedFiles.value, form.work_images, 222222222)
        }
    });
};

</script>

<template>
    <div class="space-x-8">
        <!-- <form action="#"> -->
        <form  @submit.prevent="submit" class="mt-8">
            <div>
                <h5 class="mb-3 text-gray-900 fs-17 fw-semibold dark:text-gray-50">{{ useTrans('page.personal_information.my_account') }}</h5>

                <div class="text-center">
                    <div class="relative mb-4">

                        <img
                            :src="avatarUrl"
                            class="w-40 h-40 p-1 mx-auto border-2 rounded-full border-gray-100/50 dark:border-neutral-600"
                            id="profile-img"
                            alt="Profile"
                        />
                        <div class="absolute w-8 h-8 leading-8 text-center rounded-full shadow-md bottom-2 right-[42%] z-40 bg-gray-50 dark:bg-neutral-700 dark:text-white">
                            <input
                                id="profile-img-file-input"
                                type="file"
                                class="hidden"
                                ref="fileInput"
                                @change="handleImageChange"
                                accept="image/*"
                            />
                            <label for="profile-img-file-input" class="cursor-pointer">
                            <i class="uil uil-edit"></i>
                            </label>
                        </div>

                    </div>
                    <!-- Кнопка удалить -->

                    <button
                        type="button"
                        @click="removeImage"
                        class="mt-2 text-sm text-red-500 hover:underline"
                        >
                        {{ useTrans('page.personal_information.delete_photo') }}
                    </button>
                </div>
                <div class="mt-5">
                    <div class="grid grid-cols-12 gap-5">
                        <div class="col-span-12 lg:col-span-6">
                            <div class="mb-3">
                                <InputLabel for="name" :value="useTrans('form.name')" class="text-sm text-gray-900 dark:text-gray-50" />

                                <TextInput id="name" type="text"
                                    class="w-full mt-1 text-gray-500 border rounded border-gray-100/80 text-13 dark:bg-transparent dark:border-neutral-600"
                                    v-model="form.name"
                                    :placeholder="useTrans('form.name_placeholder')" />

                                <InputError class="mt-2 opacity-60 "
                                    :message="form.errors.name" />
                            </div>
                        </div>

                        <div class="col-span-12 lg:col-span-6">
                            <div class="mb-3">
                                <InputLabel for="email" :value="useTrans('form.email')" class="text-sm text-gray-900 dark:text-gray-50" />

                                <div id="email" type="text"
                                    class="w-full mt-1 text-gray-500 border rounded border-gray-100/80 text-13 dark:bg-transparent dark:border-neutral-600"

                                    desiblade
                                    :placeholder="useTrans('form.email_placeholder')" >{{ props.user.email }}</div>

                                <InputError class="mt-2 opacity-60"
                                    :message="form.errors.email" />
                            </div>
                        </div>

                        <div class="col-span-12 lg:col-span-6">
                            <div class="mb-3">
                                <InputLabel for="phone" :value="useTrans('form.phone')" class="text-sm text-gray-900 dark:text-gray-50" />

                                <TextInput id="phone" type="text"
                                    class="w-full mt-1 text-gray-500 border rounded border-gray-100/80 text-13 dark:bg-transparent dark:border-neutral-600"
                                    v-model="form.phone"
                                    :placeholder="useTrans('form.phone_placeholder')" />

                                <InputError class="mt-2 opacity-60"
                                    :message="form.errors.phone" />
                            </div>
                        </div>
                        <!--end col-->

                        <!--end col-->

                        <div class="col-span-12 lg:col-span-6">
                            <InputLabel for="location_id" :value="useTrans('form.location')"  class="text-sm text-gray-900 dark:text-gray-50"  />
                            <Select
                                id="location_id"
                                :options="locationOptions"
                                v-model="form.location_id"
                                :value="form.location_id"
                            />
                            <InputError :message="form.errors.location_id" />
                        </div>
                        <!--end col-->

                        <div class="col-span-12 lg:col-span-6">
                            <InputLabel for="lang_id" :value="useTrans('page.personal_information.lang')"  class="text-sm text-gray-900 dark:text-gray-50"  />
                            <Select
                                id="lang_id"
                                :options="langOptions"
                                v-model="form.lang"
                                :value="form.lang"
                            />
                            <InputError :message="form.errors.lang_id" />
                        </div>
                        <!--end col-->
                    </div>
                </div>
                <!--end row-->
            </div>
            <!--end account-->

            <div class="mt-5">
                <div class="col-span-12">
                    <div class="mb-3">
                        <InputLabel for="textarea" :value="useTrans('page.main.about')" class="text-grey" />
                            <TextArea
                                id="textarea"
                                v-model = "form.description"
                                :placeholder = "useTrans('page.main.about')"
                                rows="5" />
                    </div>
                </div>

            </div>
            <!-- =============** -->
            <div class="mt-4">
                <h5 class="mb-3 font-semibold text-gray-900 text-17 dark:text-gray-50"> {{ useTrans('page.main.works') }} </h5>

                <div class="grid grid-cols-12 gap-5 mt-4">
                <!-- Сначала старые (из бэка) -->
                    <div
                        v-for="(image, index) in existingImages"
                        :key="'existing-' + index"
                        class="relative col-span-3"
                    >
                        <img
                            :src="image.url"
                            class="object-cover w-full h-32 border rounded"
                            alt="Saved"
                        />

                        <button
                            type="button"
                            class="absolute top-0 right-0 p-1 text-white bg-red-600 rounded-bl"
                            @click="deleteExistingImage(image.id, index)"
                            >✕
                        </button>
                    </div>

                    <!-- Потом новые загруженные -->
                    <div
                        v-for="(image, index) in imagePreviews"
                        :key="'preview-' + index"
                        class="relative col-span-3"
                        >
                            <img
                                :src="image.url"
                                class="object-cover w-full h-32 border rounded"
                                alt="Preview"
                            />
                            <button
                                type="button"
                                class="absolute top-0 right-0 p-1 text-white bg-red-600 rounded-bl"
                                @click="removeNewImage(index)"
                                > ✕
                            </button>
                    </div>

                    <!-- Кнопка +, если меньше 10 -->
                    <div
                        v-if="totalImages < 10"
                        class="col-span-3 flex items-center justify-center"
                    >
                        <button
                            type="button"
                            @click="triggerFileInput"
                            class="flex items-center justify-center w-full h-32 border-2 border-dashed rounded hover:bg-gray-100 dark:hover:bg-gray-800"
                        >
                            <span class="text-4xl text-gray-500">+</span>
                        </button>
                        <input
                            ref="fileInput"
                            type="file"
                            multiple
                            accept="image/*"
                            class="hidden"
                            @change="handleFileChange"
                        >
                    </div>
                </div>

                <!-- <p v-if="totalImages < 3" class="mt-2 text-red-600">
                Минимум 3 изображения обязательно
                </p> -->
                <p v-if="totalImages < 3" class="mt-2 text-red-600">  </p>
                <p v-if="imageError" class="mt-2 text-red-600">{{ imageError }}</p>
            </div>


            <!--end profile-->
            <div class="mt-4">
                <h5 class="mb-3 font-semibold text-gray-900 text-17 dark:text-gray-50">{{ useTrans('page.personal_information.social_media') }}</h5>
                <div class="grid grid-cols-12 gap-5">
                    <!-- <div v-for="socialItem in props.socialMedias" class="col-span-12 lg:col-span-6"> -->
                        <div v-for="(baseUrl, socialType) in props.socialMedias" :key="socialType" class="col-span-12 lg:col-span-6">

                        <InputLabel for="phone" :value="capitalize(socialType)" class="text-sm text-gray-900 dark:text-gray-50" />

                        <TextInput id="phone" type="text"
                            class="w-full mt-1 text-gray-500 border rounded border-gray-100/80 text-13 dark:bg-transparent dark:border-neutral-600"
                            v-model="form.socials[socialType]"
                            :placeholder="baseUrl.link" />

                        <InputError class="mt-2 opacity-60"
                            :message="form.errors.social_link" />
                    </div>
                    <!--end col-->

                </div>
                <!--end row-->
            </div>
            <!--end socia-media-->

            <div class="mt-8 text-right">
                <PrimaryButton :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing">
                    {{ useTrans('page.default.save') }}
                </PrimaryButton>
            </div>
        </form>
    </div>
</template>
