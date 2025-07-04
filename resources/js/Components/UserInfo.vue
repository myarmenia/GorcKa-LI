<script setup>
import { defineProps, computed } from 'vue';


const props = defineProps({
  locale: String,
  user: Object,
  socialMedias:Array,
  defaultAvatar: {
    type: String,
    default: '/assets/user/images/user.svg',
  },
})

const avatarUrl = computed(() => {
  return props.user.avatar
    ? '/storage/' + props.user.avatar
    : props.defaultAvatar;
});
console.log(props.user.executor_sub_categories,'executor_sub_categories')

</script>
<template>
    <div class="text-center">
        <img :src="avatarUrl" alt="" class="w-20 h-20 mx-auto rounded-full">
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
