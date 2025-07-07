<script setup>
import { defineProps } from 'vue';

const props = defineProps({
  locale: String,
  user: Object,
  socialMedias:Array,

})

</script>
<template>
    <div class="text-center">
        <img :src="props.user.avatar_url" alt="" class="w-20 h-20 mx-auto rounded-full">
        <h6 class="mt-4 mb-0 text-lg text-gray-900 dark:text-gray-50">{{props.user.name}}</h6>
        <!-- <p class="mb-4 text-gray-500 dark:text-gray-300">Creative Designer</p> -->

        <ul class="flex flex-wrap justify-center gap-2 mb-0">
            <li v-for="socialItem in props.user.social_medias" :key="socialItem.type" class="w-10 h-10 text-lg leading-10 transition-all duration-300 ease-in-out rounded bg-green-500/20 text-green-600 hover:bg-green-500 ">
                <a :href="socialItem.link" class="flex items-center justify-center w-full h-full text-green-600 hover:text-white" target="_blank">
                    <i :class="`uil uil-${props.socialMedias[socialItem.type].icon}`" rel="noopener noreferrer" ></i>
                </a>
            </li>
        </ul>

    </div>
</template>
