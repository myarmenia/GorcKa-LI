<script setup>
import { watch, ref, reactive, onMounted, computed, nextTick, onBeforeUnmount } from 'vue';
import { router } from '@inertiajs/vue3'
import axios from 'axios';
import dayjs from 'dayjs';
import { useTrans } from '/resources/js/trans';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import CommentMarkModal from '@/Components/CommentMarkModal.vue'


const props = defineProps({
  locale: String,
  roomId: Number,
  employerId: Number,
  interlocutor: Object,
  removeRoom: Function,
  selectedJobExecutirId: Number,
  jobStatus: String,
  jobEvaluate: Object,
  updateRoomExecutor: Function
});


const messages = ref([])
const loading = ref(false)
// const messages = reactive({});
const interlocutor = computed(() => props.interlocutor)
const jobEvaluate = computed(() => props.jobEvaluate)
const commentSentMap = ref({})
const currentYear = dayjs().year();
const message = ref('')
const files = ref([])
const successMessage = ref('')
const errorMessage = ref('')
const now = dayjs().format('YYYY-MM-DD')
const usersOnlineGlobal = ref([]);
const scrollContainer = ref(null)
const usersInRoomIds = ref(new Set());
const isSelected = ref(false)
const isExecutorSelecting = ref(false);

let echoChannel = null;
let globalUsersChannel = null;

const emit = defineEmits(['update:roomId']);

let jobStatusChannel = null;



watch(() => props.roomId, async (newId, oldId) => {
    if (newId) {
        try {
            const response = await axios.get(`chat/messages/${newId}`);
            messages.value = response.data.messages;
            isSelected.value = false
            isExecutorSelecting.value = false


            console.log( response.data, 'MMMMMMMM')
            console.log(props.selectedJobExecutirId, props.jobStatus, '- 222222222222 -');


            await nextTick();
            scrollToBottom();

            // Отписка от предыдущего канала
            if (echoChannel) {
                echoChannel.stopListening(".MessageSent");
                window.Echo.leave(`presence-room.${oldId}`);
                console.log(`presence-room.${oldId}`, `anjatec room ${oldId}`)
            }


            console.log(newId,'nor id')
            echoChannel = window.Echo.join(`presence-room.${newId}`)
                .here((users) => {
                    console.log('Пользователи уже в комнате:', users);
                    // можно сохранить в ref

                    usersInRoomIds.value = new Set(users.map(u => u.id));
                })
                .joining((user) => {
                    console.log('Пользователь вошел в комнату с id:', user.id); // Логируем только id
                    // usersInRoom.value.push(user);
                     usersInRoomIds.value.add(user.id);
                    console.log('Обновленный список пользователей:', usersInRoomIds.value);
                })
                .leaving((user) => {
                        console.log('Пользователь вышел из комнаты:', user);

                        // usersInRoom.value = usersInRoom.value.filter(u => {
                        //     console.log('Сравнение:', u.id, user.id);
                        //     return u.id !== user.id;
                        // });
                        usersInRoomIds.value.delete(user.id);

                        console.log('Обновленный список пользователей после ухода:', usersInRoomIds.value);
                })
                .listen(".MessageSent", (e) => {
                    console.log(e.message, ' получено событие MessageSent');

                    // const now = new Date().toISOString().split('T')[0]; // либо другой ключ
                    const now = dayjs().format('YYYY-MM-DD')

                    if (!messages.value[now]) {
                        messages.value[now] = { other: [] };
                    }

                    if (!Array.isArray(messages.value[now].other)) {
                        messages.value[now].other = [];
                    }

                    // Убедимся, что files хотя бы массив, даже если пустой
                    if (!Array.isArray(e.message.files)) {
                        e.message.files = [];
                    }

                    messages.value[now].other.push(e.message);
                    // console.log(messages.value, 888888)
                    nextTick(() => {
                        scrollToBottom()
                    })
                })
                  // Здесь добавляем обработчик события для удаления сообщения
                .listen('.MessageDeleted', (e) => {
                    const { messageId, date } = e;

                    // Если сообщение на клиенте найдено, удаляем его
                    if (messages.value[date]) {
                        messages.value[date].other = messages.value[date].other.filter(msg => msg.id !== messageId);

                        // Если после удаления сообщений по этой дате не осталось, удаляем саму дату
                        if (messages.value[date].other.length === 0 && !messages.value[date]?.from_app) {
                            delete messages.value[date];
                        }

                    }
                });


        // console.log(messages.value)
    } catch (error) {
      console.error('Ошибка при загрузке сообщений:', error);
    }
  }
});


const handleFileChange = (e) => {
  const selected = Array.from(e.target.files)

  if (selected.length > 3) {
    alert('Можно выбрать максимум 3 файла!')
    return
  }

  files.value = selected
}


// deleting upload file
const removeFile = (index) => {
  files.value.splice(index, 1)
}


//delete message
const removeMessage = async (date, messageId) => {
  try {

    await axios.get(`chat/messages/${messageId}/delete`);

  } catch (error) {
    console.error('Ошибка при удалении сообщения:', error);
  }
};


//select Executor
const selectExecutor = async (roomId) => {
  try {
    loading.value = true
    isExecutorSelecting.value = true;

    await axios.get(`chat/select-executor/${roomId}/room`);

    isSelected.value = true
    const executorId = interlocutor.value.id;
    props.updateRoomExecutor(roomId, executorId, 'in_process');

  } catch (error) {
    console.error('Ошибка при удалении сообщения:', error);
  }
};



watch(successMessage, (val) => {
  if (val) setTimeout(() => (successMessage.value = ''), 3000)
})

watch(errorMessage, (val) => {
  if (val) setTimeout(() => (errorMessage.value = ''), 3000)
})


// Скроллинг в самый низ
const scrollToBottom = () => {
  if (scrollContainer.value) {
    scrollContainer.value.scrollTo({
      top: scrollContainer.value.scrollHeight,
      behavior: 'smooth'
    })
  }
}

// Скролл при загрузке компонента
onMounted(() => {
  nextTick(() => {
    scrollToBottom()
  })

  globalUsersChannel = window.Echo.join('presence-users')
    .here((users) => {
      console.log('Пользователи онлайн глобально:', users);
      usersOnlineGlobal.value = users;
    })
    .joining((user) => {
      console.log('Пользователь появился онлайн:', user);
      usersOnlineGlobal.value.push(user);
    })
    .leaving((user) => {
      console.log('Пользователь вышел с сайта:', user);
      usersOnlineGlobal.value = usersOnlineGlobal.value.filter(u => u.id !== user.id);
    });
})



// Очистка при уничтожении компонента
onBeforeUnmount(() => {
  if (echoChannel) {
    echoChannel.stopListening(".MessageSent");
    window.Echo.leave(`presence-room.${props.roomId}`);
  }

  try {
        if (typeof globalUsersChannel !== 'undefined' && globalUsersChannel) {
            globalUsersChannel.stopListening();
        }
    } catch (error) {
        console.error('Ошибка при остановке прослушивания:', error);
    }

    try {
        if (window.Echo && window.Echo.options && window.Echo.connector) {
            window.Echo.leave('presence-users');
        }
    } catch (error) {
        console.error('Ошибка при выходе из канала:', error);
    }
});



const isInterlocutorInCurrentRoom = computed(() =>
    usersInRoomIds.value.has(interlocutor.value.id)
);

const sendMessage = () => {
    if (!message.value.trim() && files.value.length === 0) return

    loading.value = true
    const formData = new FormData()
    formData.append('message', message.value)
    formData.append('room_id', props.roomId)

    files.value.forEach((file, index) => {
        formData.append(`files[${index}]`, file)
    })


    if (isInterlocutorInCurrentRoom.value) {
        formData.append('read_at', now);
    }

    router.post('chat/messages/send', formData, {
        preserveScroll: true,
        forceFormData: true,

        onSuccess: () => {
            loading.value = false
            successMessage.value = 'Сообщение отправлено!'

            message.value = ''
            files.value = []

            nextTick(() => {
                    scrollToBottom();
                });
            },

        onError: (errors) => {
            // если вернули просто message
            if (typeof errors === 'string') {
                errorMessage.value = errors
            }
            else{
                errorMessage.value = errors.message
            }

        },

        onFinish: () => {
        // Можно использовать для скрытия лоадера
        }
        
    })

}



// ======= comment/mark ==============
const openModal = ref({ show: false, taskId: null, notificationId: null })

function handleFeedbackSubmitted(feedback) {
    console.log('Получен отзыв:', feedback)


    if (feedback.notificationId) {
        props.jobEvaluate = null
        commentSentMap.value[props.roomId] = true
        loading.value = false
    }
}

</script>

<template>

    <div v-show="props.roomId" class="relative w-full overflow-hidden chat-contain">
        <div class="p-4 border-b border-gray-100 lg:p-6 dark:border-zinc-600">
            <div class="grid items-center grid-cols-12">
                <div class="col-span-4 sm:col-span-4">
                    <div class="flex items-center">
                        <div class="block ltr:mr-2 rtl:ml-2 lg:hidden">
                            <a href="javascript: void(0);" class="p-2 text-gray-500 user-chat-remove text-16"><i class="uil uil-arrow-left"></i></a>
                        </div>
                        <div class="rtl:ml-3 ltr:mr-3">
                            <img :src="interlocutor && interlocutor.avatar ? interlocutor.avatar : '/assets/user/images/user.svg'" class="rounded-full w-9 h-9" alt="">
                            <!-- <span v-if="isInterlocutorOnline" class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-white rounded-full">yyyy</span> -->

                        </div>
                        <div class="flex-grow overflow-hidden">
                            <h5 class="mb-0 truncate text-16 ltr:block rtl:hidden">
                                <a href="#" class="text-gray-800 dark:text-gray-50">{{ interlocutor ? interlocutor.name : '' }} </a>
                            </h5>
                            <h5 class="mb-0 truncate text-16 rtl:block ltr:hidden">
                                <a href="#" class="text-gray-800 dark:text-gray-50">{{ interlocutor ? interlocutor.name : '' }}</a>
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="col-span-8 sm:col-span-8">
                    <ul class="flex items-center justify-end lg:gap-4">
                        <!-- <li class="px-3">
                            <a href="#" class="hidden text-gray-500 dark:text-gray-300 lg:block profileTab">
                                <i class="text-xl ri-group-line"></i>
                            </a>
                        </li> -->
                        <li v-if="props.employerId == $page.props.auth.user.id">

                            <template v-if="props.jobStatus == 'active'">
                                <button  v-if="!isSelected" @click="selectExecutor(props.roomId)" :disabled="isExecutorSelecting" type="submit"
                                    class="btn transition-all duration-300 ease-in-out rounded cursor-pointer"
                                    :class="isExecutorSelecting ? 'bg-gray-500/20 text-gray' : 'bg-green-500 text-green-500'"
                                    >
                                    {{useTrans('page.select_specialist')}}
                                </button>

                                <!-- <div v-else class="text-green-600">
                                    <i class="uil uil-check-circle text-xl"></i> {{ useTrans('page.selected_specialist') }}
                                </div> -->
                            </template>
                            <template v-if="props.jobStatus == 'in_process' || props.jobStatus == 'done'">
                                <template  v-if="props.selectedJobExecutirId == interlocutor.id">
                                    <span class="text-green-600">
                                        <i class="uil uil-check-circle text-xl"></i> {{ useTrans('page.selected_specialist') }}
                                    </span>
                                    <span v-if="props.jobStatus == 'done' && props.jobEvaluate && !commentSentMap[props.roomId]" class="text-green-600 ml-2">
                                        <PrimaryButton
                                            :loading="loading"
                                            @click="openModal = { show: true, taskId: jobEvaluate.task_id, notificationId: jobEvaluate.id}"
                                        >
                                            {{ useTrans('page.button_comment') }}
                                        </PrimaryButton>
                                    </span>
                                </template>
                            </template>
                        </li>

                        <li v-else>
                            <template v-if="props.jobStatus == 'in_process' || props.jobStatus == 'done'">
                                <template v-if="props.selectedJobExecutirId == $page.props.auth.user.id">
                                    <span  class="text-green-600">
                                        <i class="uil uil-check-circle text-xl"></i> {{useTrans('page.selected_specialist')}}
                                    </span>
                                    <span v-if="props.jobStatus == 'done' && props.jobEvaluate && !commentSentMap[props.roomId]" class="text-green-600 ml-2">
                                        <PrimaryButton :loading="loading"
                                            @click="openModal = { show: true, taskId: jobEvaluate.task_id, notificationId: jobEvaluate.id}"
                                        >
                                            {{ useTrans('page.button_comment') }}
                                        </PrimaryButton>
                                    </span>
                                </template>
                            </template>

                        </li>

                        <!-- <li>
                            <button type="button" class="hidden text-xl text-gray-500 border-0 btn dark:text-gray-300 lg:block">
                                <i class="uil uil-bookmark-full"></i>
                            </button>
                        </li> -->
                        <li>
                            <button  @click="props.removeRoom(props.roomId)" type="button" class="hidden text-xl text-gray-500 border-0 btn dark:text-gray-300 lg:block">
                                <i class="uil uil-trash-alt"></i>
                            </button>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <!-- end chat user head -->

        <!-- start chat conversation ***-->
        <div  class="h-[80vh] p-4 lg:p-6 simplebar-scrollable-y" data-simplebar="init"><div class="simplebar-wrapper" style="margin: -24px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;">
            <div  ref="scrollContainer" class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: 100%; overflow: hidden scroll;">

                <div class="simplebar-content" style="padding: 24px;">

                    <ul class="mb-0">
                        <template  v-for="(items, date) in messages" :key="date">
                            <li  class="clear-both py-4">
                                <div class="relative mt-3 mb-6 text-center">
                                    <div class="before:content-['] before:absolute before:w-full before:h-[1px] before:left-0 before:right-0 before:bg-gray-50 before:top-[10px] dark:before:bg-zinc-600"></div>
                                    <span class="relative bg-gray-50 text-13 py-[6px] px-3 rounded dark:bg-zinc-600 dark:text-gray-50">{{ currentYear == dayjs(date).year() ? dayjs(date).format('DD.MM') : dayjs(date).format('DD.MM.YYYY') }}</span>
                                </div>
                            </li>

                            <!-- =============================== -->
                            <template v-for="first,key in items.from_app">
                                <li v-if="first.user_id == $page.props.auth.user.id && key == 1" >
                                    <div  class="flex items-end gap-3">
                                        <div>
                                            <div class="flex gap-2 mb-2">
                                                <div class="relative px-5 py-3 text-gray-700 rounded-lg ltr:rounded-bl-none rtl:rounded-br-none  group-data-[theme-color=green]:bg-green-500 0">
                                                    <p class="mb-0">
                                                        {{first.message}} - {{ $page.props.auth.user.id }}
                                                    </p>
                                                    <p class="mt-1 mb-0 text-xs text-right text-gray-700/50"><i class="align-middle uil uil-clock"></i> <span class="align-middle">{{dayjs(first.created_at).format('HH:mm')}}</span></p>
                                                    <div class="before:content-[''] before:absolute before:border-[5px] before:border-transparent   group-data-[theme-color=green]:ltr:before:border-l-green-500 group-data-[theme-color=green]:ltr:before:border-t-green-500 group-data-[theme-color=red]:ltr:before:border-l-red-500 group-data-[theme-color=red]:ltr:before:border-t-red-500 group-data-[theme-color=violet]:rtl:before:border-r-violet-500  group-data-[theme-color=green]:rtl:before:border-r-green-500 group-data-[theme-color=green]:rtl:before:border-t-green-500 group-data-[theme-color=red]:rtl:before:border-r-red-500 group-data-[theme-color=red]:rtl:before:border-t-red-500 ltr:before:left-0 rtl:before:right-0 before:-bottom-2"></div>
                                                </div>
                                                <!-- <a class="p-0 text-gray-400 border-0 btn dropdown-toggle dark:text-gray-100" href="#" role="button" data-bs-toggle="dropdown" :id="'dropdownMenuButton' + first.id">
                                                    <i class="uil uil-trash-alt"></i>
                                                </a> -->
                                            </div>
                                        </div>
                                        <!-- <div class="font-medium text-gray-700 text-14 dark:text-gray-300">Doris Brown</div> -->
                                    </div>
                                </li>

                                <li v-if="first.user_id == $page.props.auth.user.id && key == 0">
                                    <div  class="flex gap-2 mb-2 ltr:justify-end rtl:justify-start">
                                        <div class="relative order-2 px-5 py-3 text-gray-700 rounded-lg ltr:rounded-br-none rtl:rounded-bl-none bg-gray-50 dark:bg-zinc-700 dark:text-gray-50">
                                            <p class="mb-0">
                                                {{first.message}} - {{ $page.props.auth.user.id }}
                                            </p>
                                            <p class="mt-1 mb-0 text-xs text-left text-gray-500 dark:text-gray-300"><i class="align-middle uil uil-clock"></i> <span class="align-middle">{{dayjs(first.created_at).format('HH:mm')}}</span></p>
                                            <div class="before:content-[''] before:absolute before:border-[5px] before:border-transparent ltr:before:border-r-gray-50 ltr:before:border-t-gray-50 rtl:before:border-l-gray-50 rtl:before:border-t-gray-50 ltr:before:right-0 rtl:before:left-0 before:-bottom-2 ltr:dark:before:border-t-zinc-700 ltr:dark:before:border-r-zinc-700 rtl:dark:before:border-t-zinc-700 rtl:dark:before:border-l-zinc-700"></div>
                                        </div>
                                        <!-- <a class="p-0 text-gray-400 border-0 btn dropdown-toggle dark:text-gray-100" href="#" role="button" data-bs-toggle="dropdown" :id="'dropdownMenuButton' + first.id">
                                            <i class="uil uil-trash-alt"></i>
                                        </a> -->
                                        <!-- <button @click="removeMessage(date, first.id)" class="p-0 text-gray-400 border-0 btn dropdown-toggle dark:text-gray-100" role="button" >
                                            <i class="uil uil-trash-alt"></i>
                                        </button> -->
                                    </div>
                                </li>
                            </template>


                            <template v-for="item in items.other">
                                <li v-if="item.user_id != interlocutor.id">
                                    <div  class="flex items-end gap-3">
                                        <div>
                                            <div class="flex gap-2 mb-2">
                                                <div class="relative px-5 py-3 text-gray-700 rounded-lg ltr:rounded-bl-none rtl:rounded-br-none  group-data-[theme-color=green]:bg-green-500 0">
                                                    <p class="mb-0">
                                                        {{item.message}}
                                                    </p>
                                                    <template v-if="Array.isArray(item.files) && item.files.length > 0">
                                                        <ul class="flex flex-wrap relative mb-0 mt-2">
                                                            <li v-for="file in item.files" class="relative inline-block mr-2">
                                                                <div v-if="['jpg', 'jpeg', 'png'].includes(file.ext)">
                                                                    <div>
                                                                        <a class="inline-block m-1 popup-img" :href="`${file.file_path}`" title="Project 1">
                                                                            <img :src="`${file.file_path}`" alt="" class="border rounded h-28">
                                                                        </a>
                                                                    </div>
                                                                    <div class="absolute right-[10px] left-auto bottom-[10px]">
                                                                        <a :download="`${file.name}`" :href="`${file.file_path}`" class="font-medium">
                                                                            <i class="text-lg text-white uil uil-import"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                <div v-else>
                                                                    <div class="p-2 mb-2 bg-white rounded dark:bg-zinc-800">
                                                                        <div class="flex flex-wrap items-center gap-2 attached-file">
                                                                            <div
                                                                                class="flex items-center justify-center w-12 h-12 rounded group-data-[theme-color=violet]:bg-violet-500/20 group-data-[theme-color=green]:bg-green-500/20 group-data-[theme-color=red]:bg-red-500/20 group-data-[theme-color=violet]:text-violet-500 group-data-[theme-color=green]:text-green-500 group-data-[theme-color=red]:text-red-500">
                                                                                <i class="uil uil-file-alt"></i>
                                                                            </div>
                                                                            <div class="overflow-hidden flex-grow-1">
                                                                                <div class="text-start">
                                                                                    <h5 class="mb-1 truncate text-14 dark:text-gray-50">
                                                                                        {{file.name}}</h5>
                                                                                </div>
                                                                            </div>
                                                                            <div>
                                                                                <a  :download="`${file.name}`"
                                                                                    :href="`${file.file_path}`"
                                                                                    class="font-medium ">
                                                                                    <i class="text-lg group-data-[theme-color=green]:text-green-500 uil uil-import"></i>
                                                                                </a>
                                                                            </div>
                                                                    </div>
                                                                    </div>

                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </template>
                                                    <p class="mt-1 mb-0 text-xs text-right text-gray-700/50"><i class="align-middle uil uil-clock"></i> <span class="align-middle">{{dayjs(item.created_at).format('HH:mm')}}</span></p>
                                                    <div class="before:content-[''] before:absolute before:border-[5px] before:border-transparent   group-data-[theme-color=green]:ltr:before:border-l-green-500 group-data-[theme-color=green]:ltr:before:border-t-green-500 group-data-[theme-color=red]:ltr:before:border-l-red-500 group-data-[theme-color=red]:ltr:before:border-t-red-500 group-data-[theme-color=violet]:rtl:before:border-r-violet-500  group-data-[theme-color=green]:rtl:before:border-r-green-500 group-data-[theme-color=green]:rtl:before:border-t-green-500 group-data-[theme-color=red]:rtl:before:border-r-red-500 group-data-[theme-color=red]:rtl:before:border-t-red-500 ltr:before:left-0 rtl:before:right-0 before:-bottom-2"></div>
                                                </div>
                                                <!-- <a class="p-0 text-gray-400 border-0 btn dropdown-toggle dark:text-gray-100" href="#" role="button" data-bs-toggle="dropdown" :id="'dropdownMenuButton' + item.id">
                                                    <i class="uil uil-trash-alt"></i>
                                                </a> -->
                                                <button @click="removeMessage(date, item.id)" class="p-0 text-gray-400 border-0 btn dropdown-toggle dark:text-gray-100" role="button" >
                                                    <i class="uil uil-trash-alt"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <!-- <div class="font-medium text-gray-700 text-14 dark:text-gray-300">Doris Brown</div> -->
                                    </div>
                                </li>

                                <li v-else>
                                    <div  class="flex gap-2 mb-2 ltr:justify-end rtl:justify-start">
                                        <div class="relative order-2 px-5 py-3 text-gray-700 rounded-lg ltr:rounded-br-none rtl:rounded-bl-none bg-gray-50 dark:bg-zinc-700 dark:text-gray-50">
                                            <p class="mb-0">
                                                {{item.message}}
                                            </p>
                                            <template v-if="Array.isArray(item.files) && item.files.length > 0">
                                                <ul class="flex flex-wrap relative mb-0 mt-2">
                                                    <li v-for="file in item.files" class="relative inline-block mr-2">
                                                        <div v-if="['jpg', 'jpeg', 'png'].includes(file.ext)">
                                                            <div>
                                                                <a class="inline-block m-1 popup-img" :href="`${file.pile_path}`" title="Project 1">
                                                                    <img :src="`${file.file_path}`" alt="" class="border rounded h-28">
                                                                </a>
                                                            </div>
                                                            <div class="absolute right-[10px] left-auto bottom-[10px]">
                                                                <ul>
                                                                    <li class="inline-block p-2">
                                                                        <a download="img-1.jpg" href="assets/images/small/img-1.jpg" class="font-medium">
                                                                            <i class="text-lg text-white uil uil-import"></i>
                                                                        </a>
                                                                    </li>

                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div v-else>
                                                            <div class="p-2 mb-2 bg-white rounded dark:bg-zinc-800">
                                                                <div class="flex flex-wrap items-center gap-2 attached-file">
                                                                    <div
                                                                        class="flex items-center justify-center w-12 h-12 rounded group-data-[theme-color=violet]:bg-violet-500/20 group-data-[theme-color=green]:bg-green-500/20 group-data-[theme-color=red]:bg-red-500/20 group-data-[theme-color=violet]:text-violet-500 group-data-[theme-color=green]:text-green-500 group-data-[theme-color=red]:text-red-500">
                                                                        <i class="uil uil-file-alt"></i>
                                                                    </div>
                                                                    <div class="overflow-hidden flex-grow-1">
                                                                        <div class="text-start">
                                                                            <h5 class="mb-1 truncate text-14 dark:text-gray-50">
                                                                                {{file.name}}</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div>
                                                                        <a  :download="`${file.name}`"
                                                                            :href="`${file.file_path}`"
                                                                            class="font-medium ">
                                                                            <i class="text-lg group-data-[theme-color=green]:text-green-500 uil uil-import"></i>
                                                                        </a>
                                                                    </div>
                                                            </div>
                                                            </div>

                                                        </div>
                                                    </li>

                                                </ul>
                                            </template>
                                            <p class="mt-1 mb-0 text-xs text-left text-gray-500 dark:text-gray-300"><i class="align-middle uil uil-clock"></i> <span class="align-middle">{{dayjs(item.created_at).format('HH:mm')}}</span></p>
                                            <div class="before:content-[''] before:absolute before:border-[5px] before:border-transparent ltr:before:border-r-gray-50 ltr:before:border-t-gray-50 rtl:before:border-l-gray-50 rtl:before:border-t-gray-50 ltr:before:right-0 rtl:before:left-0 before:-bottom-2 ltr:dark:before:border-t-zinc-700 ltr:dark:before:border-r-zinc-700 rtl:dark:before:border-t-zinc-700 rtl:dark:before:border-l-zinc-700"></div>
                                        </div>
                                        <!-- <a class="p-0 text-gray-400 border-0 btn dropdown-toggle dark:text-gray-100" href="#" role="button" data-bs-toggle="dropdown" :id="'dropdownMenuButton' + item.id">
                                            <i class="uil uil-trash-alt"></i>
                                        </a> -->
                                        <button @click="removeMessage(date, item.id)" class="p-0 text-gray-400 border-0 btn dropdown-toggle dark:text-gray-100" role="button" >
                                            <i class="uil uil-trash-alt"></i>
                                        </button>
                                    </div>
                                </li>
                            </template>

                        </template>
                    </ul>
                </div>
            </div>
        </div>
</div>
<div class="simplebar-placeholder" style="width: 1102px; height: 1264px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="width: 0px; display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: visible;"><div class="simplebar-scrollbar" style="height: 452px; transform: translate3d(0px, 0px, 0px); display: block;"></div></div></div>
        <!-- end chat conversation end -->

        <!-- start chat input section ***-->
        <form @submit.prevent="sendMessage" class="z-40 w-full p-6 mb-0 bg-white border-t lg:mb-1 border-gray-50 dark:bg-zinc-800 dark:border-zinc-700">
            <div class="flex gap-2">
                <div class="flex-grow">
                    <input
                        type="text"
                        v-model="message"
                        class="w-full border-transparent rounded bg-gray-50 placeholder:text-14 text-14 dark:bg-zinc-700 dark:placeholder:text-gray-300 dark:text-gray-300"
                        placeholder="Enter Message..."
                    >
                </div>
                <div>
                    <div>
                        <ul class="mb-0">
                            <li class="inline-block" title="Attached File">
                                <label class="cursor-pointer text-16 text-green-500 mx-3">
                                    <i class="uil uil-paperclip"></i>
                                   <input
                                        type="file"
                                        class="hidden"
                                        multiple
                                        @change="handleFileChange"
                                        accept="image/*,.doc,.docx,.pdf,.xls,.xlsx"
                                    />

                                </label>
                            </li>
                            <li class="inline-block">
                                <button type="submit" class=" btn  text-green-500 transition-all duration-300 ease-in-out rounded bg-green-500/20 hover:bg-green-500 hover:text-white">
                                    <i class="uil uil-message"></i>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Список выбранных файлов -->
            <ul v-if="files.length" class="mt-3 text-sm text-gray-700">
                <li
                    v-for="(file, index) in files"
                    :key="index"
                    class="flex items-center gap-2"
                >
                    📎 {{ file.name }}
                <button
                    type="button"
                    @click="removeFile(index)"
                    class="text-red-500 hover:underline text-xs"
                    >
                    <i class="uil uil-times-square text-sm"></i>
                </button>
                </li>
            </ul>

            <div v-if="successMessage" class="text-green-500 text-sm mb-2">
                {{ successMessage }}
            </div>
            <div v-if="errorMessage" class="text-red-500 text-sm mb-2">
                {{ errorMessage }}
            </div>

        </form>
        <!-- end chat input section -->

    </div>

    <div v-show="!props.roomId" class="relative w-full overflow-hidden chat-contain">
        <div class="p-4 text-gray-500">Выберите комнату для отображения сообщений</div>
    </div>

    <CommentMarkModal
        v-if="openModal.show"
        :task-id="openModal.taskId"
        :notification-id="openModal.notificationId"
        :locale="$page.props.locale"
        @close="openModal.show = false"
        @submitted="handleFeedbackSubmitted"
    />
</template>

