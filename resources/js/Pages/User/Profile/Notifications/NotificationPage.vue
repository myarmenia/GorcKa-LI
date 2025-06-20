<script setup>
import '../../../../../../public/assets/user/libs/glightbox/css/glightbox.min.css';

import Index from '../Index.vue';
import { ref, onMounted, watch } from "vue";
import { Head } from '@inertiajs/vue3';
import initNavAndTabs from "@/modules/user/nav&tabs.js";
import { initLightbox } from '@/modules/user/lightbox.init.js';
import gFunLightbox from '@/modules/user/glightbox.min';
import dayjs from 'dayjs';

// onMounted(() => {
//     gFunLightbox();
//     initLightbox();
//     initNavAndTabs();
// });

const props = defineProps({
  notifications: Array,
  socialMedias: Array,
//   user: Object,

});


// Локальная копия уведомлений
const localNotifications = ref([...props.notifications])

// Следим за изменением пропса и обновляем локальное значение (если нужно)
watch(
  () => props.notifications,
  (newVal) => {
    localNotifications.value = [...newVal]
  }
)

const deleteNotification = async (id, index) => {
  try {
console.log(id, index, 555555555444)
    await axios.delete(`/delete-item/notifications/${id}`)
    localNotifications.value.splice(index, 1)

  } catch (error) {
    console.error('Ошибка при удалении уведомления:', error)
    alert('Не удалось удалить уведомление')
  }
}

</script>


<template>
    <Index>
        <Head title = "Notifications" />
        <template #content>
            <section class="py-20">
                <div class="container mx-auto">

                    <div class="mt-5 flex justify-end">
                        <button class="bg-red-600 text-white px-4 py-2 rounded">Delete all</button>
                    </div>

                    <div  class="mt-8 space-y-6">
                        <div v-for="(notification, index) in localNotifications" class="p-4 border border-gray-100/50 rounded-md relative hover:-translate-y-1.5 transition-all duration-500 ease-in-out group-data-[theme-color=violet]:hover:border-violet-500 group-data-[theme-color=sky]:hover:border-sky-500 group-data-[theme-color=red]:hover:border-red-500 group-data-[theme-color=green]:hover:border-green-500 group-data-[theme-color=pink]:hover:border-pink-500 group-data-[theme-color=blue]:hover:border-blue-500 hover:shadow-md hover:shadow-gray-100/30 dark:border-neutral-600 dark:hover:shadow-neutral-900">
                            <div class="grid items-center grid-cols-12">
                                <div class="col-span-12 md:col-auto">
                                    <div>
                                        <a href="javascript:void(0)" class="text-5xl w-16 h-16 p-1 px-2 rounded-full outline outline-2 outline-gray-100/50 dark:outline-neutral-600 ">
                                            <!-- <i class="uil uil-info-circle text-green-700"></i> -->
                                            <!-- <i class="uil uil-file-plus-alt text-green-700"></i> -->

                                            <!-- <i class="uil uil-check-circle text-green-700"></i> -->

                                            <!-- <i class="uil uil-ban text-green-700"></i> -->
                                            <i class="uil uil-user-check text-green-700"></i>



                                        </a>
                                    </div>
                                </div><!--end col-->

                                <div class="col-span-12 md:col-span-5">
                                    <div class="mt-3 mt-lg-0">
                                        <h5 class="mb-1 text-gray-900 text-19 dark:text-white">
                                            <a href="candidate-details.html">{{notification.title}}</a>
                                        </h5>
                                        <p class="text-gray-500 text-muted dark:text-gray-300"> {{notification.description}}</p>
                                        <p class="text-gray-500 text-muted dark:text-gray-300"> {{notification.task_id ? 'Task name: ' : ''}} {{notification.task.title}} </p>
                                        <p class="text-gray-500 text-muted dark:text-gray-300"><i class="uil uil-clock"></i> {{dayjs(notification.created_at).format('DD-MM-YY')}}</p>
                                    </div>
                                </div><!--end col-->


                            </div><!--end row-->
                            <div class="absolute top-4 ltr:right-4 rtl:left-4">
                                <div class="w-10 h-10 text-lg leading-10 text-center text-red-500 rounded bg-red-500/20" >
                                    <!-- <a href=""  class="text-center avatar-sm danger-bg-subtle d-inline-block rounded-circle fs-18">
                                        <i class="uil uil-trash-alt"></i>
                                    </a> -->
                                    <button class="text-center avatar-sm danger-bg-subtle d-inline-block rounded-circle fs-18" @click="deleteNotification(notification.id, index)"><i class="uil uil-trash-alt"></i></button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="grid grid-cols-12">
                        <div class="col-span-12">
                            <ul class="flex justify-center gap-2 mt-8">
                                <li class="w-12 h-12 text-center border rounded-full cursor-default border-gray-100/50 dark:border-gray-100/20">
                                    <a class="cursor-auto" href="javascript:void(0)" tabindex="-1">
                                        <i class="mdi mdi-chevron-double-left text-16 leading-[2.8] dark:text-white"></i>
                                    </a>
                                </li>
                                <li class="w-12 h-12 text-center text-white border border-transparent rounded-full cursor-pointer group-data-[theme-color=violet]:bg-violet-500 group-data-[theme-color=sky]:bg-sky-500 group-data-[theme-color=red]:bg-red-500 group-data-[theme-color=green]:bg-green-500 group-data-[theme-color=pink]:bg-pink-500 group-data-[theme-color=blue]:bg-blue-500">
                                    <a class="text-16 leading-[2.8]" href="javascript:void(0)">1</a>
                                </li>
                                <li class="w-12 h-12 text-center text-gray-900 transition-all duration-300 border rounded-full cursor-pointer border-gray-100/50 hover:bg-gray-100/30 focus:bg-gray-100/30 dark:border-gray-100/20 dark:text-gray-50 dark:hover:bg-gray-500/20">
                                    <a class="text-16 leading-[2.8]" href="javascript:void(0)">2</a>
                                </li>
                                <li class="w-12 h-12 text-center text-gray-900 transition-all duration-300 border rounded-full cursor-pointer border-gray-100/50 hover:bg-gray-100/30 focus:bg-gray-100/30 dark:border-gray-100/20 dark:text-gray-50 dark:hover:bg-gray-500/20">
                                    <a class="text-16 leading-[2.8]" href="javascript:void(0)">3</a>
                                </li>
                                <li class="w-12 h-12 text-center text-gray-900 transition-all duration-300 border rounded-full cursor-pointer border-gray-100/50 hover:bg-gray-100/30 focus:bg-gray-100/30 dark:border-gray-100/20 dark:text-gray-50 dark:hover:bg-gray-500/20">
                                    <a class="text-16 leading-[2.8]" href="javascript:void(0)">4</a>
                                </li>
                                <li class="w-12 h-12 text-center text-gray-900 transition-all duration-300 border rounded-full cursor-pointer border-gray-100/50 hover:bg-gray-100/30 focus:bg-gray-100/30 dark:border-gray-100/20 dark:text-gray-50 dark:hover:bg-gray-500/20">
                                    <a href="javascript:void(0)" tabindex="-1">
                                        <i class="mdi mdi-chevron-double-right text-16 leading-[2.8]"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!--end col-->
                    </div>
                </div>
            </section>
        </template>

    </Index>

</template>


