<script setup>
import '../../../../../public/assets/user/libs/glightbox/css/glightbox.min.css';
import Layout from '@/Layouts/User/Layout.vue';
import Jobs from '@/Components/Jobs.vue'
import { computed, ref, onMounted } from "vue";
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useModalStore } from '@/Stores/modalStore'

import { useTrans } from '/resources/js/trans';
import dayjs from 'dayjs';

import { initLightbox } from '@/modules/user/lightbox.init.js';
import gFunLightbox from '@/modules/user/glightbox.min';


onMounted(() => {
    gFunLightbox();
    initLightbox();

});


const props = defineProps({
    job: Object,
    related_jobs: Array
});

const modal = useModalStore()
const loading = ref(false)
const jobRef = ref(props.job);

const formattedDates = computed(() => ({
    created_at: jobRef.value.created_at ? dayjs(jobRef.value.created_at).format('DD.MM.YYYY') : null,
    start: jobRef.value.start_date ? dayjs(jobRef.value.start_date).format('DD.MM.YYYY') : null,
    end: jobRef.value.end_date ? dayjs(jobRef.value.end_date).format('DD.MM.YYYY') : null,
}));


async function submitApplication() {
    const locale = usePage().props.locale;
    const taskId = jobRef.value.id;
    loading.value = true;
console.log(loading.value,2222333)
    try {
        const response = await axios.post(route('apply_now', { locale, task: taskId }));

        modal.showSuccess(response?.data?.message);
        jobRef.value.auth_applicant = true;
        await router.reload({ only: ['auth'] });
    } catch (error) {
        if (error.response && error.response.status === 403) {
            modal.showError(error.response.data.error);

        } else {
            console.log('Произошла ошибка при отправке заявки.');
        }
    } finally {
        loading.value = false;
    }
}


</script>

<template>
    <Layout>
        <Head :title="useTrans('page.title')" />
        <section class="pt-28 lg:pt-44 pb-28 group-data-[theme-color=green]:bg-green-500 dark:bg-neutral-900 bg-[url('../user/images/home/page-title.png')] bg-center bg-cover relative">
            <div class="container mx-auto">
                <div class="grid">
                    <div class="col-span-12">
                        <div class="text-center text-white">
                            <h3 class="mb-4 text-[26px]">{{useTrans('page.title')}}</h3>
                            <div class="page-next">
                                <nav class="inline-block" aria-label="breadcrumb text-center">
                                    <ol class="flex flex-wrap justify-center text-sm font-medium uppercase">
                                        <li><Link :href="route('welcome', { locale: $page.props.locale })" class="text-white block ">{{useTrans('navbar.home')}}</Link></li>
                                        <li><i class="bx bxs-chevron-right align-middle px-2.5"></i><Link :href="route('jobs', { locale: $page.props.locale })" class="text-white">{{useTrans('page.jobs_title')}}</Link>
                                        </li>
                                        <li class="active" aria-current="page"><i class="bx bxs-chevron-right align-middle px-2.5"></i>{{useTrans('page.title')}}</li>
                                    </ol>

                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <img src="/assets/user/images/about/shape.png" alt="" class="absolute block bg-cover -bottom-0 dark:hidden">
            <img src="/assets/user/images/about/shape-dark.png" alt="" class="absolute hidden bg-cover -bottom-0 dark:block">
        </section>

        <section class="py-16">
            <div class="container mx-auto">
                <div class="grid grid-cols-12 gap-y-10 lg:gap-10">
                    <div class="col-span-12 lg:col-span-8">
                        <div class="border rounded-md border-gray-100/30 dark:border-neutral-600/80">

                            <div class="p-6">
                                <div class="grid grid-cols-12">
                                    <div class="col-span-12 lg:col-span-1 mr-3">
                                        <div class="relative">
                                            <img :src="jobRef.sub_category.category.icon
                                                ? `/assets/user/icons/categories/${jobRef.sub_category.category.icon}.png`
                                                : `/assets/user/icons/categories/it.png`"
                                                alt="" class="rounded-md img-fluid">
                                        </div>
                                    </div>
                                    <div class="col-span-12 lg:col-span-8">
                                        <div class="relative">
                                            <h5 class="mb-1 text-gray-900 dark:text-gray-50">{{jobRef.title}}</h5>
                                            <ul class="flex gap-4 text-gray-500 dark:text-gray-300">
                                                <li>
                                                    <i class="mdi mdi-account"></i> {{jobRef.user.name}}
                                                </li>
                                                <li class="text-yellow-500">
                                                    <span class="px-2 py-1 text-white bg-yellow-500 rounded text-13">4.8</span> <i class="align-middle mdi mdi-star"></i><i class="align-middle mdi mdi-star"></i><i class="align-middle mdi mdi-star"></i><i class="align-middle mdi mdi-star"></i><i class="align-middle mdi mdi-star-half-full"></i>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-span-12 lg:col-span-3" v-if="jobRef.task_type === 1">
                                        <div class="flex flex-wrap gap-1.5 justify-end">
                                            <span class="badge bg-green-500/20 text-green-500 text-13 px-2 py-0.5 font-medium rounded">{{useTrans('page.jobs.remote')}}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-5 pt-8">
                                    <h5 class="mb-3 text-gray-900 dark:text-gray-50">{{useTrans('page.job_description')}}</h5>
                                    <div>
                                        <p class="mb-0 text-gray-500 dark:text-gray-300">{{ jobRef.description }}</p>
                                    </div>
                                </div>

                                <div v-if="jobRef.files.some(file => ['png', 'jpg', 'jpeg'].includes(file.ext))" class="pt-8 my-10">
                                    <h6 class="mb-0 text-gray-900 text-17 fw-bold dark:text-gray-50">{{useTrans('page.images')}}</h6>
                                    <div class="mt-4 ">
                                        <div class="grid grid-cols-12 gap-5 ">
                                            <div v-for="file in jobRef.files" class="col-span-4 ">
                                                <div v-if="['png', 'jpg', 'jpeg'].includes(file.ext)" class="relative overflow-hidden rounded-md group/project h-[160px]">
                                                    <img   :src="file.file_path" alt="" class="transition-all duration-300 ease-in-out group-hover/project:scale-110">
                                                    <div class="transition-all duration-300 ease-in-out group-hover/project:bg-black/40 group-hover/project:absolute group-hover/project:inset-0"></div>
                                                    <div class="absolute top-[50%] left-[50%] -translate-x-5 -translate-y-5 group-hover/project:block hidden transition-all duration-300 ease-in-out text-2xl">
                                                        <a :href="file.file_path" class="text-white image-popup" ><i class="uil uil-search-alt"></i></a>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div  v-if="jobRef.files.some(file => ['xlsx', 'pdf', 'docx'].includes(file.ext))" class="pt-8 my-10">
                                    <h6 class="mb-0 text-gray-900 text-17 fw-bold dark:text-gray-50">Files</h6>
                                    <div class="mt-4 ">
                                        <div class="grid grid-cols-12 gap-5 ">
                                            <template v-for="file in jobRef.files" class="col-span-4 ">
                                                <div v-if="['xlsx', 'pdf', 'docx'].includes(file.ext)" class="col-span-12 relative overflow-hidden rounded-md">
                                                    <div class="transition-all duration-300 ease-in-out text-lg">
                                                        <a :href="file.file_path" target="_blank" >{{ file.name }} <i class="uil uil-download-alt font-bold group-data-[theme-color=green]:text-green-500"></i></a>
                                                    </div>
                                                </div>

                                            </template>

                                        </div>
                                    </div>
                                </div>

                                <div class="pt-3 mt-4">
                                    <ul class="flex flex-wrap items-center gap-3 mb-0">
                                        <li class="mt-1 dark:text-gray-50">
                                            {{useTrans('page.share_job')}}
                                        </li>
                                        <li class="mt-1">
                                            <a href="javascript:void(0)" class="btn group-data-[theme-color=green]:bg-green-500 border-transparent text-white hover:-translate-y-1.5"><i class="uil uil-facebook-f"></i> Facebook</a>
                                        </li>
                                        <li class="mt-1">
                                            <a href="javascript:void(0)" class="btn bg-red-600 border-transparent text-white hover:-translate-y-1.5"><i class="uil uil-google"></i> Google+</a>
                                        </li>
                                        <li class="mt-1">
                                            <a href="javascript:void(0)" class="btn bg-green-500 border-transparent text-white hover:-translate-y-1.5"><i class="uil uil-linkedin-alt"></i> linkedin</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                        <div class="mt-10 space-y-8">
                            <h5 class="text-gray-900 dark:text-gray-50">{{useTrans('page.related_jobs')}}</h5>


                            <Jobs :jobs="props.related_jobs"  />


                            <div v-if="props.related_jobs.length > 3" class="mt-4 text-center">
                                <Link :href="route('jobs', { locale: $page.props.locale, category_id: jobRef.sub_category.category.id })" class="font-medium text-gray-900 dark:text-gray-50">
                                    {{useTrans('page.view_more')}} <i class="mdi mdi-arrow-right"></i>
                                </Link>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 space-y-6 lg:col-span-4">
                        <div class="border rounded border-gray-100/30 dark:border-neutral-600/80">
                            <div class="p-6">
                                <h6 class="text-gray-900 text-17 dark:text-gray-50">{{useTrans('page.job_overview')}} </h6>

                                <ul>
                                    <li>
                                        <div class="flex mt-6">
                                            <i class="uil uil-user icon group-data-[theme-color=green]:bg-green-500/20 h-12 w-12 text-center leading-[2.4] text-xl group-data-[theme-color=green]:text-green-500 rounded-full"></i>
                                            <div class="ltr:ml-4 rtl:mr-4">
                                                <h6 class="mb-2 text-sm text-gray-900 dark:text-gray-50">{{useTrans('page.jobs.title')}} </h6>
                                                <p class="text-gray-500 dark:text-gray-300">{{jobRef.title}}</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="flex mt-6">
                                            <i class="uil uil-star-half-alt icon group-data-[theme-color=green]:bg-green-500/20 h-12 w-12 text-center leading-[2.4] text-xl group-data-[theme-color=green]:text-green-500 rounded-full"></i>
                                            <div class="ltr:ml-4 rtl:mr-4">
                                                <h6 class="mb-2 text-sm text-gray-900 dark:text-gray-50">{{useTrans('page.jobs.execution_time')}} </h6>
                                                <p class="text-gray-500 dark:text-gray-300"> {{formattedDates.start ? formattedDates.start + ' - ' : ' ' }}  {{ formattedDates.end }}</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="flex mt-6">
                                            <i class="uil uil-location-point icon group-data-[theme-color=green]:bg-green-500/20 h-12 w-12 text-center leading-[2.4] text-xl group-data-[theme-color=green]:text-green-500 rounded-full"></i>
                                            <div class="ltr:ml-4 rtl:mr-4">
                                                <h6 class="mb-2 text-sm text-gray-900 dark:text-gray-50">{{useTrans('page.jobs.location')}} </h6>
                                                <p class="text-gray-500 dark:text-gray-300"> {{jobRef.location.translation.name}}</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="flex mt-6">
                                            <i class="uil uil-usd-circle icon group-data-[theme-color=green]:bg-green-500/20 h-12 w-12 text-center leading-[2.4] text-xl group-data-[theme-color=green]:text-green-500 rounded-full"></i>
                                            <div class="ltr:ml-4 rtl:mr-4">
                                                <h6 class="mb-2 text-sm text-gray-900 dark:text-gray-50">{{useTrans('page.jobs.offered_salary')}} </h6>
                                                <p class="text-gray-500 dark:text-gray-300">{{jobRef.price_min ? job.price_min + ' - ':  ' '}}  {{jobRef.price_max}} ֏</p>
                                            </div>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="flex mt-6">
                                            <i class="uil uil-history icon group-data-[theme-color=green]:bg-green-500/20 h-12 w-12 text-center leading-[2.4] text-xl group-data-[theme-color=green]:text-green-500 rounded-full"></i>
                                            <div class="ltr:ml-4 rtl:mr-4">
                                                <h6 class="mb-2 text-sm text-gray-900 dark:text-gray-50">{{useTrans('page.jobs.date_posted')}}</h6>
                                                <p class="text-gray-500 dark:text-gray-300">{{formattedDates.created_at}}</p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>

                                <div class="mt-8 space-y-2">

                                    <PrimaryButton
                                        v-if="$page.props.auth.user && ($page.props.auth.user.id !== jobRef.user.id) && !jobRef.auth_applicant && $page.props.auth.user.verified"
                                        @click="submitApplication"
                                        class="btn w-full group-data-[theme-color=green]:bg-green-500 border-transparent text-white hover:-translate-y-1.5"
                                        :class="{ 'opacity-25': loading }"
                                        :loading="loading"
                                    >
                                            {{ useTrans('page.jobs.apply_now') }}
                                        <i class="uil uil-arrow-right"></i>
                                    </PrimaryButton>

                                    <Link v-else-if="$page.props.auth.user == null "
                                        :href="route('login', {locale: $page.props.locale})" class="btn w-full group-data-[theme-color=green]:bg-green-500 border-transparent text-white hover:-translate-y-1.5">
                                            {{ useTrans('page.jobs.sign_in_to_apply') }}
                                            <i class="uil uil-arrow-right"></i>
                                    </Link>

                                    <Link v-else-if="$page.props.auth.user != null &&  $page.props.auth.user.verified == null"
                                        :href="route('verification.notice', {locale: $page.props.locale})" class="btn w-full group-data-[theme-color=green]:bg-green-500 border-transparent text-white hover:-translate-y-1.5">
                                            {{ useTrans('page.jobs.confirm_email_to_apply') }}
                                            <i class="uil uil-arrow-right"></i>
                                    </Link>

                                    <div v-else-if="jobRef.auth_applicant"  class="btn w-full bg-green-500/20 border-transparent text-white hover:-translate-y-1.5">
                                        <i class="uil uil-exclamation-circle"></i>
                                        {{ useTrans('page.jobs.you_applied') }}
                                    </div>


                                    <!-- testi hamar -->
                                    <!-- <Link  :href="route('apply_now', {locale: $page.props.locale, task: jobRef.id})" class="btn w-full group-data-[theme-color=green]:bg-green-500 border-transparent text-white hover:-translate-y-1.5">
                                        {{ useTrans('page.jobs.apply_now') }}
                                        <i class="uil uil-arrow-right"></i>
                                    </Link> -->

                                    <!-- <a href="#applyNow" data-bs-toggle="modal" class="btn w-full group-data-[theme-color=green]:bg-green-500 border-transparent text-white hover:-translate-y-1.5">{{ useTrans('page.jobs.apply_now') }}<i class="uil uil-arrow-right"></i></a> -->
                                </div>
                            </div>
                        </div>
                        <div class="border rounded border-gray-100/30 dark:border-neutral-600/80">
                            <div class="p-6">
                                <div>
                                    <img src="assets/images/featured-job/img-02.png" alt="" class="mx-auto img-fluid">

                                    <div class="mt-4 text-center">
                                        <h6 class="text-gray-900 text-17 dark:text-gray-50">{{jobRef.user.name}}</h6>
                                        <!-- <p class="text-gray-500 dark:text-gray-300">Since July 2017</p> -->
                                    </div>

                                    <ul class="mt-4 space-y-4">
                                        <li v-if="jobRef.user.phone">
                                            <div class="flex">
                                                <i class="text-xl uil uil-phone-volume group-data-[theme-color=green]:text-green-500"></i>
                                                <div class="ltr:ml-3 rtl:mr-3">
                                                    <h6 class="mb-1 text-sm text-gray-900 dark:text-gray-50">{{useTrans('form.phone')}}</h6>
                                                    <p class="text-sm text-gray-500 dark:text-gray-300">{{jobRef.user.phone}}</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="mt-3" v-if="jobRef.user.email">
                                            <div class="flex">
                                                <i class="text-xl uil uil-envelope group-data-[theme-color=green]:text-green-500 "></i>
                                                <div class="ltr:ml-3 rtl:mr-3">
                                                    <h6 class="mb-1 text-sm text-gray-900 dark:text-gray-50">{{useTrans('form.email')}}</h6>
                                                    <p class="text-sm text-gray-500 dark:text-gray-300">{{jobRef.user.email}}</p>
                                                </div>
                                            </div>
                                        </li>

                                    </ul>

                                    <div class="mt-6">
                                        <a href="company-details.html" class="w-full text-white border-transparent btn group-data-[theme-color=green]:bg-green-500 "><i class="mdi mdi-eye"></i> {{useTrans('page.view_profile')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


        </section>
    </Layout>
</template>

