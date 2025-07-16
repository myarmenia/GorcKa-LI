<script setup>
import { useTrans } from '@/trans';
import { defineProps, computed } from 'vue'
const props = defineProps({
  locale: String,
  user: Object,
})

</script>

<template>
    <h6 class="mb-3 font-semibold text-gray-900 text-17 dark:text-gray-50">{{ useTrans('page.contact_details') }}</h6>
                                            <ul>
                                                <li>
                                                    <div class="flex items-center mt-4">
                                                        <div class="group-data-[theme-color=violet]:bg-violet-500/20 group-data-[theme-color=sky]:bg-sky-500/20 group-data-[theme-color=red]:bg-red-500/20 group-data-[theme-color=green]:bg-green-500/20 group-data-[theme-color=pink]:bg-pink-500/20 group-data-[theme-color=blue]:bg-blue-500/20 h-11 w-11 text-xl text-center leading-[2.3] rounded-full group-data-[theme-color=violet]:text-violet-500 group-data-[theme-color=sky]:text-sky-500 group-data-[theme-color=red]:text-red-500 group-data-[theme-color=green]:text-green-500 group-data-[theme-color=pink]:text-pink-500 group-data-[theme-color=blue]:text-blue-500">
                                                            <i class="uil uil-envelope-alt"></i>
                                                        </div>
                                                        <div class="ltr:ml-3 rtl:mr-3">
                                                            <h6 class="mb-1 text-gray-900 text-14 dark:text-gray-50">{{ useTrans('page.email') }}</h6>
                                                            <p class="text-gray-500 dark:text-gray-300">{{ props.user.email }}</p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="flex items-center mt-4">
                                                        <div class="group-data-[theme-color=violet]:bg-violet-500/20 group-data-[theme-color=sky]:bg-sky-500/20 group-data-[theme-color=red]:bg-red-500/20 group-data-[theme-color=green]:bg-green-500/20 group-data-[theme-color=pink]:bg-pink-500/20 group-data-[theme-color=blue]:bg-blue-500/20 h-11 w-11 text-xl text-center leading-[2.3] rounded-full group-data-[theme-color=violet]:text-violet-500 group-data-[theme-color=sky]:text-sky-500 group-data-[theme-color=red]:text-red-500 group-data-[theme-color=green]:text-green-500 group-data-[theme-color=pink]:text-pink-500 group-data-[theme-color=blue]:text-blue-500">
                                                            <i class="uil uil-map-marker"></i>
                                                        </div>
                                                        <div class="ltr:ml-3 rtl:mr-3">
                                                            <h6 class="mb-1 text-gray-900 text-14 dark:text-gray-50">{{ useTrans('page.address') }}</h6>
                                                            <p class="text-gray-500 dark:text-gray-300">{{props.user.location_translation}}</p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="flex items-center mt-4">
                                                        <div class="group-data-[theme-color=violet]:bg-violet-500/20 group-data-[theme-color=sky]:bg-sky-500/20 group-data-[theme-color=red]:bg-red-500/20 group-data-[theme-color=green]:bg-green-500/20 group-data-[theme-color=pink]:bg-pink-500/20 group-data-[theme-color=blue]:bg-blue-500/20 h-11 w-11 text-xl text-center leading-[2.3] rounded-full group-data-[theme-color=violet]:text-violet-500 group-data-[theme-color=sky]:text-sky-500 group-data-[theme-color=red]:text-red-500 group-data-[theme-color=green]:text-green-500 group-data-[theme-color=pink]:text-pink-500 group-data-[theme-color=blue]:text-blue-500">
                                                            <i class="uil uil-phone"></i>
                                                        </div>
                                                        <div class="ltr:ml-3 rtl:mr-3">
                                                            <h6 class="mb-1 text-gray-900 text-14 dark:text-gray-50">{{ useTrans('page.phone') }}</h6>
                                                            <p class="text-gray-500 dark:text-gray-300">{{ props.user.phone }}</p>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>

</template>
