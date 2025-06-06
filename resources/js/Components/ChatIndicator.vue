<script setup>
import { ref, onMounted } from "vue";
import { usePage } from "@inertiajs/vue3";
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    unread_messages_count: Number ,
});


const { auth } = usePage().props;
const user = ref(auth?.user || null);
const messagesCount = ref(props.unread_messages_count);

onMounted(() => {
    console.log(messagesCount, 'onmmmmmm')
    if (user.value) {
        window.Echo.private(`unread-message-count.${user.value.id}`)
            .listen(".ChatIndicatorEvent", (e) => {
                console.log( e.count, ' e.count')
                messagesCount.value = e.count;
            });
    }
});


</script>

<template>
   <div class="relative dropdown">
        <div class="relative">
            <button type="button" class="btn border-0 h-[70px] dropdown-toggle px-4 text-gray-500 dark:text-gray-300" aria-expanded="false" data-dropdown-toggle="notification">
                <!-- <i class="uil uil-chat-bubble-user chat-indicator"></i> -->
                <i class="uil uil-comments chat-indicator"></i>
            </button>
                <span class="absolute text-xs px-1.5 bg-red-500 text-white font-medium rounded-full left-6 top-3 ring-2 ring-white dark:ring-neutral-800">{{ messagesCount }}</span>
        </div>
    </div>
</template>

<style>
    .chat-indicator{
        color: #048565;
        font-size: 24px;
    }
</style>

