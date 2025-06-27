<script setup>
import { ref, watch } from "vue";
import { Head, router, Link } from '@inertiajs/vue3';
import dayjs from 'dayjs';
import Index from '../Index.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import CommentMarkModal from '@/Components/CommentMarkModal.vue'

const props = defineProps({
  notifications: {
    type: Object,
    default: () => ({
      data: [],
      links: []
    })
  },
  socialMedias: {
    type: Array,
    default: () => []
  }
});


const localNotifications = ref([...props.notifications.data]);
const paginationLinks = ref([...props.notifications.links]);

watch(
  () => props.notifications,
  (newVal) => {
    localNotifications.value = [...newVal.data];
    paginationLinks.value = [...newVal.links];
  },
  { deep: true }
);

// Удаление уведомления
const deleteNotification = async (id, index) => {
  try {
    const isLastOnPage = localNotifications.value.length === 1;
    const currentPage = props.notifications.current_page;

      // Если это последнее уведомление - сначала переходим на предыдущую страницу
      await axios.delete(`/delete-item/notifications/${id}`);
      localNotifications.value.splice(index, 1);
      localNotifications.value = [...props.notifications.data];

      if(currentPage > 1){
        await router.get(props.notifications.prev_page_url);
      }
      else{
        await router.get(props.notifications.first_page_url);
      }

  } catch (error) {
    console.error('Ошибка при удалении:', error);
  }
};


// Удаление всех уведомлений
const deleteAllNotifications = async () => {
    if (!confirm('Вы уверены, что хотите удалить это уведомление?')) return;
    try {
        await axios.get(route('user.notifications.delete_all', { locale: 'am' } ));
        localNotifications.value = [];

    } catch (error) {
        console.error('Ошибка при удалении notification:', error);
    }

};


const openModal = ref(false)

function handleFeedbackSubmitted(feedback) {
  // например, показываем тост или обновляем список
  console.log('Получен отзыв:', feedback)
}

// Пагинация через Inertia
const changePage = (url) => {
    if (!url ) return;

  router.get(url, {}, {
    // preserveState: true,
    preserveScroll: false,
    only: ['notifications'],
    onFinish: () => {
    }
  });
};

</script>

<template>
  <Index>
    <Head title="Notifications" />

    <template #content>
        <section class="py-20">
            <div class="container mx-auto">

            <div class="mt-5 flex justify-between">
                <h4 class=" text-gray-900 fs-16 dark:text-gray-50"> Notifications </h4>
                <button
                @click="deleteAllNotifications"
                class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition"
                >
                Delete all
                </button>
            </div>

            <div class="mt-8 space-y-6">
                <!-- <transition-group name="list"> -->
                <div
                    v-for="(notification, index) in localNotifications"
                    :key="notification.id"
                    class="p-4 border border-gray-100/50 rounded-md relative hover:-translate-y-1.5 transition-all duration-500 ease-in-out group-data-[theme-color=violet]:hover:border-violet-500 group-data-[theme-color=sky]:hover:border-sky-500 group-data-[theme-color=red]:hover:border-red-500 group-data-[theme-color=green]:hover:border-green-500 group-data-[theme-color=pink]:hover:border-pink-500 group-data-[theme-color=blue]:hover:border-blue-500 hover:shadow-md hover:shadow-gray-100/30 dark:border-neutral-600 dark:hover:shadow-neutral-900"
                >
                    <!-- Содержимое уведомления -->
                    <div class="grid items-center grid-cols-12">
                    <div class="col-span-12 md:col-auto">
                        <div>
                        <span class="text-5xl w-16 h-16 p-1 px-2 rounded-full outline outline-2 outline-gray-100/50 dark:outline-neutral-600 inline-flex items-center justify-center">
                            <i class="uil uil-user-check text-green-700"></i>
                        </span>
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-5">
                        <div class="mt-3 mt-lg-0">
                        <h5 class="mb-1 text-gray-900 text-19 dark:text-white">
                            {{ notification.title }}
                        </h5>
                        <p class="text-gray-500 text-muted dark:text-gray-300">
                            {{ notification.description }}
                        </p>
                        <Link :href="route('single_job', { locale: $page.props.locale, id: notification.task.id })" v-if="notification.task" class="text-gray-500 text-muted dark:text-gray-300">
                            Task name: <span class=" font-bold group-data-[theme-color=green]:text-green-500">{{ notification.task.title }}</span>
                        </Link>
                        <p class="text-gray-500 text-muted dark:text-gray-300">
                            <i class="uil uil-clock"></i>
                            {{ dayjs(notification.created_at).format('DD-MM-YY') }}
                        </p>
                        </div>
                    </div>
                    </div>

                    <div class="absolute top-1 ltr:right-4 rtl:left-4 h-full py-4 flex flex-col justify-between items-end">
                        <button
                            @click="deleteNotification(notification.id, index)"
                            class="w-10 h-10 text-lg text-red-500 rounded bg-red-500/20 flex items-center justify-center hover:bg-red-500/30 transition"
                        >
                            <i class="uil uil-trash-alt"></i>
                        </button>

                        <PrimaryButton v-if="notification.is_comment" @click="openModal = true">
                            Update
                        </PrimaryButton>

                        <CommentMarkModal
                            v-if="openModal"
                            :notification-id="notification.id"
                            :locale="$page.props.locale"
                            @close="openModal = false"
                            @submitted="handleFeedbackSubmitted"
                        />
                    </div>

                </div>
                <!-- </transition-group> -->

                <div v-if="localNotifications.length === 0" class="text-center py-10">
                <p class="text-gray-500">No notifications found</p>
                </div>
            </div>

            <!-- Пагинация -->
            <div class="grid grid-cols-12 mt-8" v-if="paginationLinks.length > 3">
                <div class="col-span-12">
                    <ul class="flex justify-center gap-2 mt-8">
                        <li v-for="(link,index) in paginationLinks"
                            :key="index"
                            :class="{active: link.active, disabled: !link.url, 'group-data-[theme-color=green]:bg-green-500 text-white': link.active, 'group-data-[theme-color=green]:bg-gray-200 ': !link.url }"
                            @click=" changePage(link.url)"
                            class="w-12 h-12 text-center text-gray-900 transition-all duration-300 border rounded cursor-pointer border-gray-100/50 hover:bg-green-100/30 focus:bg-gray-100/30 dark:border-gray-100/20 dark:text-gray-50 dark:hover:bg-gray-500/20">
                            <!-- <a class="cursor-auto" href="javascript:void(0)" > -->
                                <span class="text-16 leading-[2.8]" v-html="link.label"></span> <!-- Use v-html to render HTML -->
                            <!-- </a> -->
                        </li>
                    </ul>
                </div>
            </div>
            </div>
        </section>
    </template>

  </Index>
</template>

