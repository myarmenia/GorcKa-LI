<script setup>

import { computed, ref, reactive, onMounted, watch, onUnmounted, nextTick } from "vue";
import { useTrans } from '/resources/js/trans';

const props = defineProps({
  user: Object,
  locations: Array,
  socialMedias: Array,
  defaultAvatar: {
    type: String,
    default: '/assets/user/images/user.svg',
  },
});

const avatarUrl = computed(() => {
  return props.user.avatar
    ? '/storage/' + props.user.avatar
    : props.defaultAvatar;
});

const getLocationText = () => {
  const loc = props.locations.find(location => props.user.location_id === location.id);
  return loc?.item_translations[0]?.name || '-';
};

</script>

<template>
    <div class="border rounded h-full border-gray-100/50 dark:border-neutral-600">
        <div class="p-5 border-b border-gray-100/50 dark:border-neutral-600">
            <div class="text-center">
                <img :src="avatarUrl" alt="" class="w-20 h-20 p-1 mx-auto border-2 rounded-full border-gray-200/20">
                <h6 class="mt-4 mb-0 text-lg text-gray-900 dark:text-gray-50">{{props.user.name}}</h6>

                <ul class="flex flex-wrap justify-center gap-2 mb-0">
                    <li v-for="socialItem in props.user.social_medias" :key="socialItem.type" class="w-10 h-10 text-lg leading-10 transition-all duration-300 ease-in-out rounded bg-green-500/20 text-green-600 hover:bg-green-500 ">
                        <a :href="socialItem.link" class="flex items-center justify-center w-full h-full text-green-600 hover:text-white" target="_blank">
                            <i :class="`uil uil-${props.socialMedias[socialItem.type].icon}`" rel="noopener noreferrer" ></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="p-5 ">
            <h6 class="mb-3 font-semibold text-gray-900 text-17 dark:text-gray-50">{{useTrans('page.contacts.title')}}</h6>
            <ul class="mb-0">
                <li class="pb-3">
                    <div class="flex">
                        <label class="w-32 font-medium text-gray-900 dark:text-gray-50">{{ useTrans('page.contacts.email') }} </label>
                        <div>
                            <p class="mb-0 text-gray-500 text-break dark:text-gray-300">
                                {{props.user.email}}
                            </p>
                        </div>
                    </div>
                </li>
                <li class="pb-3">
                    <div class="flex">
                        <label class="w-32 font-medium text-gray-900 dark:text-gray-50">{{ useTrans('page.contacts.phone') }}</label>
                        <div>
                            <p class="mb-0 text-gray-500 dark:text-gray-300">{{props.user.phone ?? ' - '}}</p>
                        </div>
                    </div>
                </li>
                <li class="pb-3">
                    <div class="flex">
                        <label class="w-32 font-medium text-gray-900 dark:text-gray-50">{{ useTrans('page.contacts.location') }}</label>
                        <div>
                            <p class="mb-0 text-gray-500 dark:text-gray-300">{{getLocationText()}}</p>
                        </div>
                    </div>
                </li>
            </ul>
        </div>

    </div>
</template>
