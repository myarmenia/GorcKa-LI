<script setup>
    // import { Link } from '@inertiajs/vue3';
    import { usePage, Link } from '@inertiajs/vue3';
    import axios from 'axios';

    import { onMounted,ref,onUnmounted, watch , computed} from 'vue';
    const locale_lng = usePage().props.locale;

    const fileInput = ref(null);

    const openFileInput = () =>{
        fileInput.value.click();
    }



    const profilePictureUrl = ref(null);

    const handelFileChange = (event) =>{
        const file = event.target.files[0];

        profilePictureUrl.value = URL.createObjectURL(file)

        console.log(profilePictureUrl.value);
        const formData = new FormData();
        formData.append('avatar',file);
        axios.post('/api/update-profile-avatar',formData,{
            headers: { 'Content-Type': 'multipart/form-data' }

        })
        .then((response)=>{
            console.log(response)

        })
    }
    onMounted(() => {

    // ========== style =============
      const link = document.createElement('link');
            link.rel = 'stylesheet';
            link.href = '/assets/user/tailwind2.css'; // путь к стилю
            link.id = 'chat-css';
            document.head.appendChild(link);
    // ==============================

    })

    // onUnmounted(() => {
    //     const link = document.getElementById('chat-css');

    //     if (link) {
    //         link.remove(); // удаляет элемент <link>
    //     }
    // });



</script>
<style>
    .profile-user-img:hove {
        background-color:blue;
        cursor:pointer;

    }
</style>
<template>
      <div class="col-span-12 lg:col-span-1 h-full">
            <div class="border rounded border-gray-100/50 dark:border-neutral-600 h-full">
                <div class="sidebar-menu w-full lg:w-[75px] shadow lg:flex lg:flex-col z-10 flex flex-row justify-between items-center fixed lg:relative bottom-0 bg-white dark:bg-zinc-600 ">
            <div class="hidden lg:my-5 lg:block">
                <a href="index.html" class="block dark:hidden">
                    <span>
                        <img src="/assets/user/images/logo.svg" alt="" class="h-[30px]">
                    </span>
                </a>

                <a href="index.html" class="hidden dark:block">
                    <span>
                        <img src="/assets/user/images/logo.svg" alt="" class="h-[30px]">
                    </span>
                </a>
            </div>
            <!-- end navbar-brand-box -->


            <!-- Start side-menu nav -->
            <!-- Tabs -->
            <div class="w-full mx-auto lg:my-auto">
                <ul id="tabs" class="flex flex-row justify-center w-full lg:flex-col lg:flex nav-tabs">
                    <li class="flex-grow lg:flex-grow-0">
                        <Link   :href="route('user.profile',{locale:usePage().props.locale})"
                                :class="{
                                            'active group-data-[theme-color=green]:text-green-500': route().current('user.profile')
                                        }"
                                class="tab-button flex relative items-center justify-center mx-auto h-14 w-14 leading-[14px] group/tab my-2 rounded-lg">
                            <div class="absolute items-center hidden -top-10 ltr:left-0 group-hover/tab:flex rtl:right-0">
                                <div class="absolute -bottom-1 left-[40%] w-3 h-3 rotate-45 bg-black"></div>
                                <span class="relative z-10 p-2 text-xs leading-none text-white whitespace-no-wrap bg-black rounded shadow-lg">Profile</span>
                            </div>
                            <i class="uil uil-user-square text-2xl"></i>
                        </Link>
                    </li>
                    <li class="flex-grow lg:flex-grow-0">
                        <Link   :href="route('task.list',{locale:usePage().props.locale})"
                                :class="{
                                            'active group-data-[theme-color=green]:text-green-500': route().current('task.list')
                                        }"
                                class="tab-button flex relative items-center justify-center mx-auto h-14 w-14 leading-[14px] group/tab my-2 rounded-lg">
                            <div class="absolute items-center hidden -top-10 ltr:left-0 group-hover/tab:flex rtl:right-0">
                                <div class="absolute -bottom-1 left-[40%] w-3 h-3 rotate-45 bg-black"></div>
                                <span class="relative z-10 p-2 text-xs leading-none text-white whitespace-no-wrap bg-black rounded shadow-lg">Task List</span>
                            </div>
                            <i class="uil uil-clipboard-notes text-2xl"></i>
                        </Link>
                    </li>
                    <li class="flex-grow lg:flex-grow-0">
                        <Link   :href="route('user.chat',{locale:usePage().props.locale})"
                                :class="{
                                            'active group-data-[theme-color=green]:text-green-500': route().current('user.chat')
                                        }"
                                class="tab-button flex relative items-center justify-center mx-auto h-14 w-14 leading-[14px] group/tab my-2 rounded-lg">
                            <div class="absolute items-center hidden -top-10 ltr:left-0 group-hover/tab:flex rtl:right-0">
                                <div class="absolute -bottom-1 left-[40%] w-3 h-3 rotate-45 bg-black"></div>
                                <span class="relative z-10 p-2 text-xs leading-none text-white whitespace-no-wrap bg-black rounded shadow-lg">Chat</span>
                            </div>
                            <i class="uil uil-comments  text-2xl"></i>
                        </Link>
                    </li>

                    <li class="flex-grow lg:flex-grow-0">
                        <Link   :href="route('user.notifications',{locale:usePage().props.locale})"
                                :class="{
                                            'active group-data-[theme-color=green]:text-green-500': route().current('user.notifications')
                                        }"
                                class="tab-button flex relative items-center justify-center mx-auto h-14 w-14 leading-[14px] group/tab my-2 rounded-lg">
                            <div class="absolute items-center hidden -top-10 ltr:left-0 group-hover/tab:flex rtl:right-0">
                                <div class="absolute -bottom-1 left-[40%] w-3 h-3 rotate-45 bg-black"></div>
                                <span class="relative z-10 p-2 text-xs leading-none text-white whitespace-no-wrap bg-black rounded shadow-lg">Notifications</span>
                            </div>
                            <i class="uil uil-bell text-2xl"></i>
                        </Link>
                    </li>

                </ul>
            </div>



        </div>
                <!-- <div class="p-5 border-b border-gray-100/50 dark:border-neutral-600">
                    <div class="text-center">

                        <ul class="flex flex-column mx-auto my-auto justify-center gap-2 mb-0">
                            <li>
                                <Link :href="route('task.list',{locale:usePage().props.locale})">Task Page</Link><br>

                            </li>
                            <li>

                                <Link :href="route('task.create',{locale:usePage().props.locale})">Task create</Link><br>

                            </li>
                            <li>

                                <Link :href="route('user.chat',{locale:usePage().props.locale})">Chat</Link>

                            </li>

                        </ul>
                    </div>
                </div> -->

            </div>
      </div>

</template>

<style scoped>

/* .sidebar-menu {
    height: 100% !important;
} */

@media (min-width: 960px) {
    .sidebar-menu {
        height: 100%;
    }
}
</style>
