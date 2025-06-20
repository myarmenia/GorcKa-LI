<script setup>
import { ref, onMounted } from "vue";
import { usePage } from "@inertiajs/vue3";
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    unread_notification_count: Number ,
});


const { auth } = usePage().props;
const user = ref(auth?.user || null);
const notificationCount = ref(props.unread_notification_count);

onMounted(() => {
    console.log(notificationCount, 'onmmmmmm')
    if (user.value) {
        window.Echo.private(`notification-count.${user.value.id}`)
            .listen(".NotificationEvent", (e) => {
                console.log( e.count, ' e.count')
                notificationCount.value = e.count;
            });
    }
});


</script>

<template>
   <div class="relative dropdown">
        <div class="relative">
            <Link :href="route('user.notifications', { locale: usePage().props.locale })">
                <button type="button" class="btn border-0 h-[70px] px-4 text-gray-500 dark:text-gray-300" >
                    <i class="text-2xl uil uil-bell bell-notify"></i>
                </button>
                <span class="absolute text-xs px-1.5 bg-red-500 text-white font-medium rounded-full left-6 top-3 ring-2 ring-white dark:ring-neutral-800">{{ notificationCount }}</span>
            </Link>
        </div>
    </div>
</template>

<style>
    .bell-notify{
        color: #048565;
    }
</style>

