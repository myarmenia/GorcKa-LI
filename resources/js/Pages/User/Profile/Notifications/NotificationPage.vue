<script setup>
import { ref, watch } from "vue";
import { Head, router } from '@inertiajs/vue3';
import dayjs from 'dayjs';
import Index from '../Index.vue';

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

console.log(props.notifications, 777777777)
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
//   if (!confirm('Вы уверены, что хотите удалить это уведомление?')) return;
    try {
        await axios.delete(`/delete-item/notifications/${id}`);
            localNotifications.value.splice(index, 1);

            if (localNotifications.value.length === 0 ) {
                props.notifications.current_page > 1 ?
                router.get(props.notifications.prev_page_url) :
                router.get(props.notifications.first_page_url);
            }

    } catch (error) {
        console.error('Ошибка при удалении notification:', error);
    }

};


// Удаление всех уведомлений
const deleteAllNotifications = async () => {
    if (!confirm('Вы уверены, что хотите удалить это уведомление?')) return;
    try {
        await axios.get(route('user.notifications.delete_all', { locale: 'am' } ));
        localNotifications.value = null

    } catch (error) {
        console.error('Ошибка при удалении notification:', error);
    }

};


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
          <div class="mt-5 flex justify-end">
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
                      <p v-if="notification.task" class="text-gray-500 text-muted dark:text-gray-300">
                        Task name: {{ notification.task.title }}
                      </p>
                      <p class="text-gray-500 text-muted dark:text-gray-300">
                        <i class="uil uil-clock"></i>
                        {{ dayjs(notification.created_at).format('DD-MM-YY') }}
                      </p>
                    </div>
                  </div>
                </div>

                <div class="absolute top-4 ltr:right-4 rtl:left-4">
                  <button
                    @click="deleteNotification(notification.id, index)"
                    class="w-10 h-10 text-lg text-red-500 rounded-full bg-red-500/20 flex items-center justify-center hover:bg-red-500/30 transition"
                  >
                    <i class="uil uil-trash-alt"></i>
                  </button>
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
              <div class="flex justify-center">
                <nav class="flex items-center gap-1">
                  <template v-for="(link, index) in paginationLinks" :key="index">
                    <button
                      v-if="link.url"
                      @click="changePage(link.url)"
                      :disabled="link.active"
                      :class="{
                        'bg-green-500 text-white': link.active,
                        'hover:bg-gray-100 dark:hover:bg-gray-700': !link.active,

                      }"
                      class="min-w-10 h-10 flex items-center justify-center px-3 rounded-full transition"
                      v-html="link.label"
                    />
                    <span
                      v-else
                      class="min-w-10 h-10 flex items-center justify-center px-3 rounded-full text-gray-400"
                      v-html="link.label"
                    />
                  </template>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </section>
    </template>
  </Index>
</template>

<!-- <style scoped>
.list-enter-active,
.list-leave-active {
  transition: all 0.5s ease;
}
.list-enter-from,
.list-leave-to {
  opacity: 0;
  transform: translateY(30px);
}
</style> -->
