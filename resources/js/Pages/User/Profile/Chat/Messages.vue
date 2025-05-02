<script setup>
import { watch, ref, onMounted, computed, nextTick, onBeforeUnmount } from 'vue';
import { router } from '@inertiajs/vue3'
import axios from 'axios';
import dayjs from 'dayjs';


const props = defineProps({
  locale: String,
  roomId: Number,
  interlocutor: Object
});

const messages = ref([])
const interlocutor = computed(() => props.interlocutor)
const currentYear = dayjs().year();
const message = ref('')
const files = ref([])
const successMessage = ref('')
const errorMessage = ref('')
const now = dayjs().format('YYYY-MM-DD')

let echoChannel = null;
let globalUsersChannel = null;
const usersOnlineGlobal = ref([]);

const scrollContainer = ref(null)

const usersInRoomIds = ref(new Set());

watch(() => props.roomId, async (newId, oldId) => {
    if (newId) {
        try {
            const response = await axios.get(`chat/messages/${newId}`);
            messages.value = response.data.messages;

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
                    // usersInRoom.value = users;
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

                if (messages.value[now]) {
                    messages.value[now].other.push(e.message);
                } else {
                    messages.value[now] = { other: [e.message] };
                }

                 nextTick(() => {
                    scrollToBottom()
                })
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


    const formData = new FormData()
    formData.append('message', message.value)
    formData.append('room_id', props.roomId)

    files.value.forEach((file, index) => {
        formData.append(`files[${index}]`, file)
    })


    if (isInterlocutorInCurrentRoom.value) {
        formData.append('read_at', now);
    }


    // if (isInterlocutorInRoom) {
    //     formData.append('read_at', now)
    // }
    // if (isInterlocutorInCurrentRoom()) {
    //     formData.append('read_at', dayjs().format('YYYY-MM-DD'))
    // }
    // formData.append('mark_as_read', isInterlocutorInRoom ? 1 : 0); // 👈 добавляем флаг

    router.post('chat/messages/send', formData, {
        preserveScroll: true,
        forceFormData: true,
        onSuccess: () => {

            successMessage.value = 'Сообщение отправлено!'
            console.log(interlocutor.value.id, 333333)
                // добавим новое сообщение в список
                // const now = dayjs().format('YYYY-MM-DD')
                const newMessage = {
                    message: message.value,
                    user_id: 2, // заменишь на текущего user_id, если знаешь
                    created_at: dayjs().toISOString()
        }

        message.value = ''
        files.value = []

        nextTick(() => {
                scrollToBottom();
            });
        },

        onError: (errors) => {
        // Пример — показать первую ошибку
        console.log(errors, 4444444)
        errorMessage.value = errors.message || 'Ошибка при отправке сообщения'
        },

        onFinish: () => {
        // Можно использовать для скрытия лоадера
        }
  })
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
                                <i class="text-green-500 ltr:ml-1 rtl:mr-1 ri-record-circle-fill text-10 "></i></h5>
                            <h5 class="mb-0 truncate text-16 rtl:block ltr:hidden">
                                <i class="text-green-500 ltr:ml-1 rtl:mr-1 ri-record-circle-fill text-10 "></i>
                                <a href="#" class="text-gray-800 dark:text-gray-50">{{ interlocutor ? interlocutor.name : '' }}</a></h5>
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

                        <li class="px-3">
                            <div class="relative dropdown">
                                <button class="p-0 text-xl text-gray-500 border-0 btn dropdown-toggle dark:text-gray-300" type="button" data-bs-toggle="dropdown" id="dropdownMenuButton11">
                                    <i class="uil uil-ellipsis-h"></i>
                                </button>
                                <ul class="absolute z-50 hidden w-40 py-2 mx-4 mt-2 text-left list-none bg-white border rounded shadow-lg ltr:-right-4 border-gray-50 dropdown-menu top-8 dark:bg-zinc-600 bg-clip-padding dark:border-gray-600/50 rtl:-left-5" aria-labelledby="dropdownMenuButton11">

                                    <li>
                                        <a class="block w-full px-4 py-2 text-sm font-normal text-gray-700 bg-transparent dropdown-item whitespace-nowrap hover:bg-gray-100/30 dark:text-gray-100 dark:hover:bg-zinc-700 ltr:text-left rtl:text-right" href="#">
                                            Archive <i class="text-gray-500 rtl:float-left ltr:float-right dark:text-gray-300 uil uil-archive text-16"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="block w-full px-4 py-2 text-sm font-normal text-gray-700 bg-transparent dropdown-item whitespace-nowrap hover:bg-gray-100/30 dark:text-gray-100 dark:hover:bg-zinc-700 ltr:text-left rtl:text-right" href="#">
                                            Delete <i class="text-gray-500 rtl:float-left ltr:float-right dark:text-gray-300 uil uil-trash-alt text-16"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
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
                        <template v-for="items,date in messages">
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
                                                <a class="p-0 text-gray-400 border-0 btn dropdown-toggle dark:text-gray-100" href="#" role="button" data-bs-toggle="dropdown" :id="'dropdownMenuButton' + first.id">
                                                    <i class="uil uil-trash-alt"></i>
                                                </a>
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
                                        <a class="p-0 text-gray-400 border-0 btn dropdown-toggle dark:text-gray-100" href="#" role="button" data-bs-toggle="dropdown" :id="'dropdownMenuButton' + first.id">
                                            <i class="uil uil-trash-alt"></i>
                                        </a>
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
                                                    <p class="mt-1 mb-0 text-xs text-right text-gray-700/50"><i class="align-middle uil uil-clock"></i> <span class="align-middle">{{dayjs(item.created_at).format('HH:mm')}}</span></p>
                                                    <div class="before:content-[''] before:absolute before:border-[5px] before:border-transparent   group-data-[theme-color=green]:ltr:before:border-l-green-500 group-data-[theme-color=green]:ltr:before:border-t-green-500 group-data-[theme-color=red]:ltr:before:border-l-red-500 group-data-[theme-color=red]:ltr:before:border-t-red-500 group-data-[theme-color=violet]:rtl:before:border-r-violet-500  group-data-[theme-color=green]:rtl:before:border-r-green-500 group-data-[theme-color=green]:rtl:before:border-t-green-500 group-data-[theme-color=red]:rtl:before:border-r-red-500 group-data-[theme-color=red]:rtl:before:border-t-red-500 ltr:before:left-0 rtl:before:right-0 before:-bottom-2"></div>
                                                </div>
                                                <a class="p-0 text-gray-400 border-0 btn dropdown-toggle dark:text-gray-100" href="#" role="button" data-bs-toggle="dropdown" :id="'dropdownMenuButton' + item.id">
                                                    <i class="uil uil-trash-alt"></i>
                                                </a>
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
                                            <p class="mt-1 mb-0 text-xs text-left text-gray-500 dark:text-gray-300"><i class="align-middle uil uil-clock"></i> <span class="align-middle">{{dayjs(item.created_at).format('HH:mm')}}</span></p>
                                            <div class="before:content-[''] before:absolute before:border-[5px] before:border-transparent ltr:before:border-r-gray-50 ltr:before:border-t-gray-50 rtl:before:border-l-gray-50 rtl:before:border-t-gray-50 ltr:before:right-0 rtl:before:left-0 before:-bottom-2 ltr:dark:before:border-t-zinc-700 ltr:dark:before:border-r-zinc-700 rtl:dark:before:border-t-zinc-700 rtl:dark:before:border-l-zinc-700"></div>
                                        </div>
                                        <a class="p-0 text-gray-400 border-0 btn dropdown-toggle dark:text-gray-100" href="#" role="button" data-bs-toggle="dropdown" :id="'dropdownMenuButton' + item.id">
                                            <i class="uil uil-trash-alt"></i>
                                        </a>
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
                                        accept="image/*,application/pdf,
                                                application/msword,
                                                application/vnd.openxmlformats-officedocument.wordprocessingml.document,
                                                application/vnd.ms-excel,
                                                application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
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
</template>

