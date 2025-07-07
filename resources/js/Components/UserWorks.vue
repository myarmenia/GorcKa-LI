<script setup>
import { defineProps, onMounted } from 'vue';
import { useTrans } from '/resources/js/trans';
import { initLightbox } from '@/modules/user/lightbox.init.js';

onMounted(() => {

    initLightbox();
    console.log( initLightbox())

});

const props = defineProps({
  files: Array,
})


</script>
<template>

    <h5 class="text-lg font-bold text-gray-900 dark:text-gray-50">{{ useTrans('page.works') }}</h5>
    <div class="mt-4 ">
        <div class="grid grid-cols-12 gap-5 ">
            <div v-for="file in files" class="col-span-4 ">
                <div class="relative overflow-hidden rounded-md group/project h-[160px]">
                    <img :src="`/storage/${file.path}`" alt="" class="transition-all duration-300 ease-in-out group-hover/project:scale-110">
                    <div class="transition-all duration-300 ease-in-out group-hover/project:bg-black/40 group-hover/project:absolute group-hover/project:inset-0"></div>
                    <div class="absolute top-[50%] left-[50%] -translate-x-5 -translate-y-5 group-hover/project:block hidden transition-all duration-300 ease-in-out text-2xl">
                        <a :href="`/storage/${file.path}`" class="text-white image-popup" ><i class="uil uil-search-alt"></i></a>
                    </div>
                </div>
            </div>

        </div>
    </div>

</template>
