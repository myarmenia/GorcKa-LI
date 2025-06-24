<script setup>
import Index from '../Index.vue';
import Messages from './Messages.vue';
import axios from 'axios';
import { computed, ref, reactive, onMounted, watch, onUnmounted, nextTick } from "vue";
import { Head, useForm, usePage } from '@inertiajs/vue3';
import initNavAndTabs from "@/modules/user/nav&tabs.js";
import initChatApp from "@/modules/user/chat-app";

import { globalOnlineUsers } from '@/global/globalOnlineUsers';


const props = defineProps({
  rooms: Array,
});

const jobs = ref(props.rooms);

const selectedRoomId = ref(null);
const selectedRoomEmployerId = ref(null);
const selectedUser = ref(null)
const authUserId = ref(usePage().props?.auth?.user.id || null)
const unreadCounts = ref({});
const selectedJobExecutirId = ref({})
const selectedJobStatus = ref({})
const searchText = ref('');


function selectRoom(room) {

    selectedUser.value = room.interlocutor
    selectedRoomId.value = room.id
    selectedRoomEmployerId.value = room.employer_id
    selectedJobExecutirId.value = room.task.executor_id
    selectedJobStatus.value = room.task.status

    // сбросить индикатор
    unreadCounts.value[room.id] = 0;
    removeUnreadCount(room.id)
    readMessages(room.id)
}



function isUserOnline(userId) {
  return globalOnlineUsers.value.some(u => u.id === userId);
}


// сбросить индикатор
function removeUnreadCount (roomId){
    Object.values(jobs.value).forEach(group => {
        const foundRoom = group.find(r => r.id === roomId);
        if (foundRoom) {
            foundRoom.unread_count = 0;
        }
    });
}



function updateRoomExecutor(roomId, executorId, status) {
  Object.values(jobs.value).forEach(group => {
    let targetJobId = null;

    // Сначала найдём ту комнату, где был выбор исполнителя
    group.forEach(room => {
      if (room.id === roomId) {
        room.task.executor_id = executorId;
        room.task.status = status;
        targetJobId = room.task.id; // сохраняем id задачи
      }
    });

    // Потом обновим статус у остальных комнат той же задачи
    if (targetJobId) {
      group.forEach(room => {
        if (room.task.id === targetJobId && room.id !== roomId) {
          room.task.status = status;
          room.task.executor_id = null; // можно сбросить, если это важно
        }
      });
    }
  });

  // Обновим текущую выбранную комнату
  selectedJobExecutirId.value = executorId;
  selectedJobStatus.value = status;
}


const removeRoom = async (roomId) => {
    try {
        await axios.get(`chat/room/${roomId}/delete`);

        for (const key in jobs.value) {
            // Фильтруем и перезаписываем массив
            jobs.value[key] = jobs.value[key].filter(room => room.id !== roomId);
        }

        selectedRoomId.value = null

    } catch (error) {
        console.error('Ошибка при удалении room:', error);
    }
};



// read messages in room via auth user
async function readMessages (roomId){
    try {
        await axios.get(`chat/messages/${roomId}/${authUserId.value}/read`);
    } catch (error) {
        console.error('Ошибка при обновлении сообщений:', error);
    }
}


// ================= search ========================
async function filterJobsBySearch() {
  try {
    const response = await axios.get('chat/search', {
      params: { search: searchText.value }
    })

    jobs.value = response.data.rooms


  } catch (error) {
    console.error('Ошибка при поиске:', error)
  }
}


watch(jobs, (newJobs, oldJobs) => {
    // Немного задержим, чтобы DOM успел обновиться
    nextTick(() => {
        initNavAndTabs();
    });
});



onMounted(() => {
    initNavAndTabs();
    initChatApp();

    // ========== style =============
    //   const link = document.createElement('link');
    //         link.rel = 'stylesheet';
    //         link.href = '/assets/user/tailwind2.css'; // путь к стилю
    //         link.id = 'chat-css';
    //         document.head.appendChild(link);
    // ==============================

    Object.values(props.rooms).forEach((roomArray) => {
        roomArray.forEach((room) => {
            window.Echo.private(`room-unread-message-count.${room.id}.${authUserId.value}`)
                .listen(".RoomUnreadMessageCount", (e) => {
                    console.log(`Room ${room.id} unread count:`, e.count);
                            console.log(jobs.value)

                        Object.values(jobs.value).forEach(group => {
                            const foundRoom = group.find(r => r.id === room.id);
                            if (foundRoom) {
                                foundRoom.unread_count = e.count;
                            }
                        });
                });
        });
    });


});



onUnmounted(() => {
    const link = document.getElementById('chat-css');

    console.log(link,333333)
    if (link) {
        link.remove(); // удаляет элемент <link>
    }
});



const unreadCountsPerJob = computed(() => {
    const result = {};
    for (const [jobName, rooms] of Object.entries(jobs.value)) {
        result[jobName] = rooms.reduce((sum, room) => sum + (room.unread_count || 0), 0);
    }
    return result;
});


</script>

<template>
    <Index>
        <Head title = "Chat" />
        <template #content>
            <div class="w-full flex tab-pane">
                <div class="flex w-full">
                    <div class="chat-leftsidebar w-full lg:w-[380px] group-data-[theme-color=green]:bg-green-500/20  shadow overflow-y-hidden mb-[80px] lg:mb-0 group-data-[theme-color=green]:dark:bg-zinc-700">
                        <div>
                            <div class="tab-content active">
                                <!-- Start chat content -->
                                <div>
                                    <div class="p-2">
                                        <h4 class="mb-0 text-gray-700 dark:text-gray-50">Chats</h4>

                                        <div class="flex items-center  py-1 mt-5 mb-5 rounded bg-search group-data-[theme-color=green]:dark:bg-zinc-600 ">

                                            <input v-model="searchText" type="text" class="w-5/6 border-0  bg-search placeholder:text-[14px] focus:ring-offset-0 focus:outline-none focus:ring-0  placeholder:text-gray-400" placeholder="Search messages or users" aria-label="Search messages or users" aria-describedby="basic-addon1">
                                            <span @click="filterJobsBySearch" class=" pe-1 ps-3  group-data-[theme-color=green]:dark:bg-zinc-600 " id="basic-addon1">
                                                <i class="text-lg text-gray-400 uil uil-search search-icon dark:text-gray-200 cursor-pointer"></i>
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Start chat-message-list -->
                                    <div>
                                        <h5 class="px-2 mb-4 text-16 text-gray-700 dark:text-gray-50">Recent</h5>

                                        <div class="h-[610px] px-2" data-simplebar="init">
                                            <div class="simplebar-wrapper" style="margin: 0px -8px;">
                                                <div class="simplebar-height-auto-observer-wrapper">
                                                    <div class="simplebar-height-auto-observer"></div>
                                                </div>
                                                <div class="simplebar-mask">
                                                    <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                                        <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: auto; overflow: hidden;">
                                                            <div class="simplebar-content" style="padding: 0px 8px;">

                                                                <ul class="chat-user-list">
                                                                    <li v-for="job, index in jobs" :id="job.id" class="mb-2">
                                                                        <div data-tw-accordion="collapse">
                                                                            <div class="text-gray-700 accordion-item dark:text-gray-300">
                                                                                <h6>
                                                                                    <button type="button" class="flex items-center justify-between w-full px-4 py-2 font-medium text-left accordion-header  group group-data-[theme-color=green]:bg-green-500/20">
                                                                                        <span class="text-gray-900 text-15 dark:text-gray-50"> {{index}}</span>
                                                                                        <div>
                                                                                            <span  class="px-2 py-1 mr-2 text-red-500 rounded-full bg-red-500/20 text-11"> {{ unreadCountsPerJob[index] }}</span>
                                                                                            <i class="mdi mdi-chevron-down text-xl group-[.active]:rotate-180 text-gray-900 dark:text-gray-50"></i>
                                                                                        </div>
                                                                                    </button>
                                                                                </h6>
                                                                                <div class="accordion-body hidden">
                                                                                    <div class="cursor-pointer">
                                                                                        <div v-for="room in job"
                                                                                            class="mt-2 p-2 room"
                                                                                            :class="{'active-room': selectedRoomId === room.id}"
                                                                                            @click="selectRoom(room)">
                                                                                                <div class="relative flex">
                                                                                                    <div class="relative self-center ltr:mr-3 rtl:ml-3">
                                                                                                        <img :src="room.interlocutor.avatar ? room.interlocutor.avatar : '/assets/user/images/user.svg'" class="rounded-full w-9 h-9" alt="">
                                                                                                         <span :class="isUserOnline(room.interlocutor.id) ? 'bg-green-600' : 'bg-yellow-700/20'"
                                                                                                                class=" absolute w-3 h-3  border-2 border-white rounded-full top-7 ltr:right-1 rtl:left-1 dark:border-zinc-600"></span>
                                                                                                    </div>
                                                                                                    <div class="flex-grow overflow-hidden">
                                                                                                        <h5 class="mb-1 text-base truncate dark:text-gray-50">{{room.interlocutor.name}}</h5>
                                                                                                    </div>
                                                                                                    <div v-if="room.unread_count > 0" class="absolute  ltr:right-0 rtl:left-0">
                                                                                                        <span class="px-2 py-1 text-red-500 rounded-full bg-red-500/20 text-11"> {{ room.unread_count }}</span>
                                                                                                    </div>
                                                                                                </div>
                                                                                        </div>

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>

                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="simplebar-placeholder" style="width: 0px; height: 0px;"></div>
                                            </div>


                                        </div>
                                    </div>
                                    <!-- End chat-message-list -->

                                </div>

                            </div>


                        </div>
                    </div>
                    <div class="w-full overflow-hidden transition-all duration-150 bg-white user-chat dark:bg-zinc-800">
                        <div class="lg:flex">

                            <Messages
                                :roomId="selectedRoomId"
                                :interlocutor="selectedUser"
                                :removeRoom="removeRoom"
                                :employerId="selectedRoomEmployerId"
                                :selectedJobExecutirId="selectedJobExecutirId"
                                :jobStatus="selectedJobStatus"
                                :updateRoomExecutor="updateRoomExecutor"
                            />

                        </div>
                    </div>
                </div>
            </div>
        </template>

    </Index>

</template>

<style scoped>

.room:hover, .active-room, .bg-search {
    background-color: #f0fdf4;
}

.bg-dot{
    background: #048565;
}


</style>

