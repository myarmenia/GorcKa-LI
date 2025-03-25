<script setup>
import { onMounted, inject } from "vue";
import { initNavbar } from "@/modules/user/navbar.js";
import { useTrans } from '/resources/js/trans';

import { router, Link } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';

import { initFirebase, requestPermission } from '../../firebase';

const { auth, firebaseConfig, firebaseVapIdKey } = usePage().props;
const locale_lng = usePage().props.locale; // Получаем локаль

const user = ref(auth?.user || null);

onMounted(() => {
    initNavbar(); // Запускаем `initNavbar` после монтирования компонента
    initFirebase(firebaseConfig);

    // Если пользователь авторизован и верифицирован, запрашиваем разрешение на уведомления
    if (user.value && user.value.verified) {
        requestPermission(firebaseVapIdKey);
    }
});


const changeLanguage = (lang) => {


    // localStorage.setItem('locale', lang);

    const path = window.location.pathname.split('/');

    // Replace the current locale (first segment) with the new one
    path[1] = lang;

    // Получаем текущие параметры запроса
    const searchParams = new URLSearchParams(window.location.search);

    // Формируем новый URL с параметрами запроса
    const newUrl = `${path.join('/')}?${searchParams.toString()}`;

    // Construct the new URL using the updated path

    // Navigate to the new URL without reloading the page
    router.get(newUrl, {}, { preserveState: true, preserveScroll: true });
};

</script>

<template>
    <div class="hidden px-5 mx-auto border-gray-200 container-fluid lg:px-24 bg-gray-50 md:block dark:bg-neutral-600">
        <div class="grid items-center grid-cols-12">
            <div class="col-span-7">
                <ul class="flex items-center py-3">
                    <li>
                        <ul class="flex flex-wrap gap-4 text-gray-800 ">
                            <li class="transition-all duration-200 ease-in hover:text-green-500 dark:text-gray-50 dark:hover:text-green-500">
                                <a href="https://wa.me/796077707907" class="social-link" target="w"><i class="uil uil-whatsapp"></i></a></li>
                            <li class="transition-all duration-200 ease-in hover:text-green-500 dark:text-gray-50 dark:hover:text-green-500">
                                <a href="javascript:void(0)" class="social-link"><i class="uil uil-facebook-messenger-alt"></i></a></li>
                            <li class="transition-all duration-200 ease-in hover:text-green-500 dark:text-gray-50 dark:hover:text-green-500">
                                <a href="https://www.instagram.com/gorc_ka.am?igsh=dnRqZDVta3ZqZHln&utm_source=qr" target="i" class="social-link"><i class="uil uil-instagram"></i></a>
                            </li>
                            <li class="transition-all duration-200 ease-in hover:text-green-500 dark:text-gray-50 dark:hover:text-green-500">
                                <a href="mailto:gorckaarm@gmail.com" target="m" class="social-link"><i class="uil uil-envelope"></i></a>
                            </li>
                            <li class="transition-all duration-200 ease-in hover:text-green-500 dark:text-gray-50 dark:hover:text-green-500">
                                <a href="https://t.me/webextechno" target="t" class="social-link"><i class="uil uil-telegram"></i></a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>
    </div>

    <nav class="navbar fixed right-0 left-0 top-0 lg:top-[44.5px] px-5 lg:px-24 transition-all duration-500 ease shadow-lg shadow-gray-200/20 bg-white border-gray-200 dark:bg-neutral-800 z-40 dark:shadow-neutral-900" id="navbar">
        <div class="mx-auto container-fluid">
            <div class="flex flex-wrap items-center justify-between mx-auto">
                <a href="index.html" class="flex items-center">
                    <img src="/assets/user/images/logo-dark.png" alt="" class="logo-dark h-[22px] block dark:hidden">
                    <img src="/assets/user/images/logo-light.png" alt="" class="logo-dark h-[22px] hidden dark:block">
                </a>
                <button data-collapse-toggle="navbar-collapse" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg navbar-toggler group lg:hidden hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-sticky" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                </button>
                <div class="flex items-center lg:order-2 ">

                    <div v-if="$page.props.auth.user">
                        <Link :href="route('task.create', { locale: usePage().props.locale })" class="mr-2 text-white bg-yellow-600 border-transparent hover:bg-yellow-600 focus:bg-yellow-600 focus:ring ring-yellow-500/30 rounded hover:-translate-y-2 sm:px-4 sm:py-2 md:px-6 md:py-3 lg:px-4 lg:py-3 py-2 px-3">{{useTrans('navbar.post_job')}} </Link>
                    </div>
                    <div v-if="$page.props.auth.user" class="flex items-center">
                        <span class="text-lg dark:text-gray-500">1000</span>
                        <i class="text-2xl uil uil-usd-circle group-data-[theme-color=green]:text-green-500"></i>
                    </div>
                    <div v-if="$page.props.auth.user">

                        <div class="relative dropdown">
                            <div class="relative">
                                <button type="button" class="btn border-0 h-[70px] dropdown-toggle px-4 text-gray-500 dark:text-gray-300" aria-expanded="false" data-dropdown-toggle="notification">
                                    <i class="text-2xl uil uil-usd-circle group-data-[theme-color=green]:text-green-500"></i>
                                    <img src="/assets/user/icons/gicon.png" alt="" >
                                </button>
                                    <span class="absolute text-xs px-1.5 bg-green-500 text-white font-medium rounded-full left-6 top-3 ring-2 ring-white dark:ring-neutral-800">856</span>
                            </div>

                        </div>
                    </div>
                    <div v-if="$page.props.auth.user">

                        <div class="relative dropdown">
                            <div class="relative">
                                <button type="button" class="btn border-0 h-[70px] dropdown-toggle px-4 text-gray-500 dark:text-gray-300" aria-expanded="false" data-dropdown-toggle="notification">
                                    <i class="text-2xl uil uil-usd-circle group-data-[theme-color=green]:text-green-500"></i>
                                </button>
                                    <span class="absolute text-xs px-1.5 bg-yellow-600 text-white font-medium rounded-full left-6 top-3 ring-2 ring-white dark:ring-neutral-800">856</span>
                            </div>

                        </div>
                    </div>
                    <div v-if="$page.props.auth.user">

                        <div class="relative dropdown">
                            <div class="relative">
                                <button type="button" class="btn border-0 h-[70px] dropdown-toggle px-4 text-gray-500 dark:text-gray-300" aria-expanded="false" data-dropdown-toggle="notification">
                                    <i class="text-2xl mdi mdi-bell"></i>
                                </button>
                                    <span class="absolute text-xs px-1.5 bg-red-500 text-white font-medium rounded-full left-6 top-3 ring-2 ring-white dark:ring-neutral-800">3</span>
                            </div>
                            <div class="absolute right-0 top-auto left-auto z-50 hidden list-none bg-white rounded shadow dropdown-menu w-72 dark:bg-neutral-800 " id="notification">
                                <div class="border rounded border-gray-50 dark:border-neutral-600" aria-labelledby="notification">
                                    <div class="grid grid-cols-1 ">
                                        <div class="p-4 bg-gray-50 dark:bg-neutral-700">
                                            <h6 class="mb-1 text-gray-800 dark:text-gray-50"> Notification </h6>
                                            <p class="mb-0 text-gray-500 text-13 dark:text-gray-300">You have 4 unread Notification</p>
                                        </div>
                                    </div>
                                    <div class="h-60" data-simplebar>
                                        <div>
                                            <a href="#!">
                                                <div class="flex p-4 hover:bg-gray-50/30 dark:hover:bg-neutral-600/50">
                                                    <div class="flex-shrink-0 ltr:mr-3 rtl:ml-3">
                                                        <div class="h-10 w-10 bg-violet-500/20 rounded-full text-center leading-[2.8]">
                                                            <i class="text-lg text-violet-500 mdi mdi-user-check"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow">
                                                        <h6 class="mb-1 text-sm text-gray-700 dark:text-gray-300">22 verified registrations</h6>
                                                        <div class="text-gray-600 text-13 dark:text-gray-300">
                                                            <p class="mb-0"><i class="mdi mdi-clock-outline dark:text-gray-300"></i> <span>3 hour ago</span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>

                                            <a href="#!">
                                                <div class="flex items-center p-4 hover:bg-gray-50/30 dark:hover:bg-neutral-600/50">
                                                    <div class="flex-shrink-0 ltr:mr-3 rtl:ml-3">
                                                        <img src="assets/user/images/user/img-01.jpg" class="w-10 h-10 rounded-full" alt="user-pic">
                                                    </div>
                                                    <div class="flex-grow">
                                                        <h6 class="mb-1 text-sm text-gray-700 dark:text-gray-300">Kevin Stewart</h6>
                                                        <div class="text-gray-600 text-13 dark:text-gray-300">
                                                            <p class="mb-0"><i class="mdi mdi-clock-outline dark:text-gray-300"></i> <span>1 hour ago</span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>

                                            <a href="#!">
                                                <div class="flex items-center p-4 hover:bg-gray-50/30 dark:hover:bg-neutral-600/50">
                                                    <div class="flex-shrink-0 ltr:mr-3 rtl:ml-3">
                                                        <img src="assets/user/images/featured-job/img-04.png" class="w-10 h-10 rounded-full" alt="user-pic">
                                                    </div>
                                                    <div class="flex-grow">
                                                        <h6 class="mb-1 text-sm text-gray-700 dark:text-gray-300">Applications has been approved</h6>
                                                        <div class="text-gray-600 text-13 dark:text-gray-300">
                                                            <p class="mb-0"><i class="mdi mdi-clock-outline dark:text-gray-300"></i> <span>45 min ago</span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>

                                            <a href="#!">
                                                <div class="flex items-center p-4 hover:bg-gray-50/30 dark:hover:bg-neutral-600/50">
                                                    <div class="flex-shrink-0 ltr:mr-3 rtl:ml-3">
                                                        <img src="assets/user/images/user/img-02.jpg" class="w-10 h-10 rounded-full" alt="user-pic">
                                                    </div>
                                                    <div class="flex-grow">
                                                        <h6 class="mb-1 text-sm text-gray-700 dark:text-gray-300">Salena Layfield</h6>
                                                        <div class="text-gray-600 text-13 dark:text-gray-300">
                                                            <p class="mb-0"><i class="mdi mdi-clock-outline dark:text-gray-300"></i> <span>15 min ago</span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>

                                            <a href="#!">
                                                <div class="flex items-center p-4 hover:bg-gray-50/30 dark:hover:bg-neutral-600/50">
                                                    <div class="flex-shrink-0 ltr:mr-3 rtl:ml-3">
                                                        <img src="assets/user/images/featured-job/img-01.png" class="w-10 h-10 rounded-full" alt="user-pic">
                                                    </div>
                                                    <div class="flex-grow">
                                                        <h6 class="mb-1 text-sm text-gray-700 dark:text-gray-300">Creative Agency</h6>
                                                        <div class="text-gray-600 text-13 dark:text-gray-300">
                                                            <p class="mb-0"><i class="mdi mdi-clock-outline dark:text-gray-300"></i> <span>15 min ago</span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>

                                        </div>
                                    </div>
                                    <div class="grid p-1 border-t border-gray-50 dark:border-zinc-600 justify-items-center bg-gray-50 dark:bg-neutral-700">
                                        <a class="border-0 group-data-[theme-color=green]:text-green-500 btn dark:text-gray-50" href="javascript:void(0)">
                                            <i class="mr-1 mdi mdi-arrow-right-circle"></i> <span>View More..</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div  v-if="$page.props.auth.user" class="relative dropdown ltr:mr-4 rtl:ml-4">

                            <button type="button" class="flex items-center px-4 py-5 dropdown-toggle" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <img class="w-8 h-8 rounded-full ltr:xl:mr-2 rtl:xl:ml-2"
                                    :src="$page.props.auth.user?.avatar ?? '/assets/user/images/user.svg'" alt="Header Avatar">
                                <span class="hidden fw-medium xl:block dark:text-gray-50">{{$page.props.auth.user.name}}</span>
                            </button>
                            <ul class="absolute top-auto z-50 hidden w-48 p-3 list-none bg-white border rounded shadow-lg dropdown-menu border-gray-500/20 xl:ltr:-left-3 ltr:-left-32 rtl:-right-3 dark:bg-neutral-800" id="profile/log" aria-labelledby="navNotifications">

                                <li v-if="$page.props.auth.user.verified" class="p-2 dropdown-item group/dropdown dark:text-gray-300">
                                    <Link :href="route('user.profile',{locale: usePage().props.locale })" class="text-15 font-medium text-gray-800 group-data-[theme-color=green]:group-hover/dropdown:text-green-500 group-hover:pl-1.5 transition-all duration-300 ease-in dark:text-gray-50">My Profile</Link>

                                </li>
                                <li class="p-2 dropdown-item group/dropdown dark:text-gray-300">
                                    <Link :href="route('logout', { locale: usePage().props.locale })" method="post" class="text-15 font-medium text-gray-800 group-data-[theme-color=green]:group-hover/dropdown:text-green-500 group-hover:pl-1.5 transition-all duration-300 ease-in dark:text-gray-50">Logout</Link>

                                </li>

                            </ul>
                        </div>
                        <div v-else class="relative dropdown ltr:mr-2 rtl:ml-2">
                            <Link :href="route('login', { locale: usePage().props.locale })" class="mr-2 text-white bg-yellow-600 border-transparent hover:bg-yellow-600 focus:bg-yellow-600 focus:ring ring-yellow-600/30 rounded hover:-translate-y-2 sm:px-4 sm:py-2 md:px-6 md:py-3 lg:px-4 lg:py-3 py-2 px-3">{{useTrans('navbar.post_job')}} </Link>
                            <Link :href="route('login', { locale: usePage().props.locale })" class="text-white border-transparent  group-data-[theme-color=green]:bg-green-500 rounded hover:-translate-y-2 sm:px-4 sm:py-2 md:px-6 md:py-3 lg:px-4 lg:py-3 py-2 px-3">{{useTrans('form.sign_in')}} </Link>
                            <!-- <Link :href="route('register', { locale: usePage().props.locale })" class="text-white border-transparent group-data-[theme-color=green]:bg-green-500  rounded hover:-translate-y-2 sm:px-4 sm:py-2 md:px-6 md:py-3 lg:px-4 lg:py-3 py-2 px-3">{{useTrans('form.register')}} </Link> -->
                        </div>
                    </div>

                    <div>

                        <div class="relative dropdown ">
                            <button type="button" class="flex items-center py-5 dropdown-toggle" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <span class="mx-2 text-gray-800 uppercase">{{ $page.props.locale}}</span>
                                <span class=" fw-medium xl:block dark:text-gray-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="gray" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="2" y1="12" x2="22" y2="12"></line>
                                    <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10A15.3 15.3 0 0 1 12 2z"></path>
                                    </svg>
                                </span>
                            </button>
                            <ul class="absolute top-auto z-50 hidden w-48 p-3 list-none bg-white border rounded shadow-lg dropdown-menu border-gray-500/20 xl:ltr:-left-3 ltr:-left-32 rtl:-right-3 dark:bg-neutral-800" id="profile/log" aria-labelledby="navNotifications">
                                <li class="p-2 dropdown-item group/dropdown dark:text-gray-300">
                                    <button class="uppercase text-15 font-medium text-gray-800 group-data-[theme-color=green]:group-hover/dropdown:text-green-500 group-hover:pl-1.5 transition-all duration-300 ease-in dark:text-gray-50" @click="changeLanguage('am')">am</button>
                                </li>
                                <li class="p-2 dropdown-item group/dropdown dark:text-gray-300">
                                    <button class="uppercase text-15 font-medium text-gray-800 group-data-[theme-color=green]:group-hover/dropdown:text-green-500 group-hover:pl-1.5 transition-all duration-300 ease-in dark:text-gray-50" @click="changeLanguage('en')">en</button>
                                </li>
                                <li class="p-2 dropdown-item group/dropdown dark:text-gray-300">
                                    <button class="uppercase text-15 font-medium text-gray-800 group-data-[theme-color=green]:group-hover/dropdown:text-green-500 group-hover:pl-1.5 transition-all duration-300 ease-in dark:text-gray-50" @click="changeLanguage('ru')">ru</button>
                                </li>

                            </ul>
                        </div>
                        <!-- <div class="select-lng"><span>Arm <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-globe" viewBox="0 0 16 16"><path d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm7.5-6.923c-.67.204-1.335.82-1.887 1.855A7.97 7.97 0 0 0 5.145 4H7.5V1.077zM4.09 4a9.267 9.267 0 0 1 .64-1.539 6.7 6.7 0 0 1 .597-.933A7.025 7.025 0 0 0 2.255 4H4.09zm-.582 3.5c.03-.877.138-1.718.312-2.5H1.674a6.958 6.958 0 0 0-.656 2.5h2.49zM4.847 5a12.5 12.5 0 0 0-.338 2.5H7.5V5H4.847zM8.5 5v2.5h2.99a12.495 12.495 0 0 0-.337-2.5H8.5zM4.51 8.5a12.5 12.5 0 0 0 .337 2.5H7.5V8.5H4.51zm3.99 0V11h2.653c.187-.765.306-1.608.338-2.5H8.5zM5.145 12c.138.386.295.744.468 1.068.552 1.035 1.218 1.65 1.887 1.855V12H5.145zm.182 2.472a6.696 6.696 0 0 1-.597-.933A9.268 9.268 0 0 1 4.09 12H2.255a7.024 7.024 0 0 0 3.072 2.472zM3.82 11a13.652 13.652 0 0 1-.312-2.5h-2.49c.062.89.291 1.733.656 2.5H3.82zm6.853 3.472A7.024 7.024 0 0 0 13.745 12H11.91a9.27 9.27 0 0 1-.64 1.539 6.688 6.688 0 0 1-.597.933zM8.5 12v2.923c.67-.204 1.335-.82 1.887-1.855.173-.324.33-.682.468-1.068H8.5zm3.68-1h2.146c.365-.767.594-1.61.656-2.5h-2.49a13.65 13.65 0 0 1-.312 2.5zm2.802-3.5a6.959 6.959 0 0 0-.656-2.5H12.18c.174.782.282 1.623.312 2.5h2.49zM11.27 2.461c.247.464.462.98.64 1.539h1.835a7.024 7.024 0 0 0-3.072-2.472c.218.284.418.598.597.933zM10.855 4a7.966 7.966 0 0 0-.468-1.068C9.835 1.897 9.17 1.282 8.5 1.077V4h2.355z"></path></svg></span><ul class="lng-list"><li id="ru">Rus</li><li id="en">Eng</li></ul></div> -->
                    </div>
                </div>

                <div id="navbar-collapse" class="navbar-res items-center lg:justify-between md:justify-end w-full text-sm lg:flex lg:w-auto lg:order-1 group-focus:[.navbar-toggler]:block hidden">
                    <ul class="flex flex-col items-start mt-5 mb-10 font-medium lg:mt-0 lg:mb-0 lg:items-center lg:flex-row" id="navigation-menu">
                        <li class="py-5 lg:px-4">
                            <Link
                                :href="route('welcome', { locale: $page.props.locale })"
                                :class="{
                                    'active': route().current('welcome')
                                }"
                                class="py-2.5 text-gray-800 font-medium leading-tight dark:text-gray-50"> {{useTrans('navbar.home')}}
                            </Link>
                        </li>

                        <li class="py-5 lg:px-4">
                            <Link
                                :href="route('jobs', { locale: $page.props.locale })"
                                :class="{
                                    'active': route().current('jobs')
                                }"
                                class="py-2.5 text-gray-800 font-medium leading-tight dark:text-gray-50" > {{ useTrans('navbar.jobs') }}
                            </Link>
                        </li>

                        <li class="py-5 lg:px-4">
                            <Link
                                :href="route('specialists', { locale: $page.props.locale })"
                                :class="{
                                        'active': route().current('specialists')
                                    }"
                                class="py-2.5 text-gray-800 font-medium leading-tight dark:text-gray-50"> {{useTrans('navbar.specialists')}}
                            </Link>
                        </li>

                        <li class="py-5 lg:px-4">
                            <Link
                                :href="route('categories', { locale: $page.props.locale })"
                                :class="{
                                        'active': route().current('categories')
                                    }"
                                class="py-2.5 text-gray-800 font-medium leading-tight dark:text-gray-50"> {{useTrans('navbar.categories')}}
                            </Link>

                        </li>
                        <li class="py-5 lg:px-4">
                            <Link
                                :href="route('welcome', { locale: $page.props.locale })"
                                class="py-2.5 text-gray-800 font-medium leading-tight dark:text-gray-50"> {{useTrans('navbar.contact')}}
                            </Link>

                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</template>
