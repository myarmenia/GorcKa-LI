<script setup>
import { computed } from 'vue';
import Layout from '@/Layouts/User/Layout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import WhiteButton from '@/Components/WhiteButton.vue';

import { Head, Link, useForm } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import { useTrans } from '/resources/js/trans';


const props = defineProps({
    status: {
        type: String,
    },
});

const form = useForm({});

const submit = () => {
    form.post(route('verification.send', { locale: usePage().props.locale }));
};

const verificationLinkSent = computed(
    () => props.status === 'verification-link-sent',
);
</script>

<template>
    <Layout>
        <Head :title="useTrans('page.title')" />

            <section class="flex items-center justify-center min-h-screen py-10 group-data-[theme-color=green]:bg-green-500/10 dark:bg-neutral-700">
                <div class="container mx-auto">
                    <div class="grid grid-cols-12">
                        <div class="col-span-12 lg:col-span-10 lg:col-start-2">
                            <div class="flex flex-col bg-white rounded-lg dark:bg-neutral-800">
                                <div class="grid flex-col grid-cols-12">
                                    <div class="col-span-12 lg:col-span-6 ltr:rounded-l-lg rtl:rounded-r-lg">
                                        <div class="p-10">
                                            <a href="">
                                                <img src="/assets/user/images/logo.png" alt="" class="hidden mx-auto dark:block">
                                                <img src="/assets/user/images/logo.png" alt="" class="block mx-auto dark:hidden">
                                            </a>
                                            <div class="mt-5">
                                                <img src="/assets/user/images/auth/reset-password.png" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-12 rounded-b-md lg:col-span-6 group-data-[theme-color=green]:bg-green-700 lg:rounded-b-none lg:ltr:rounded-r-lg rtl:rounded-l-lg">
                                        <div class="flex flex-col justify-center h-full p-12">
                                            <div class="text-center">
                                                <h5 class="text-[18.5px] text-white">{{useTrans('page.title_h5')}}</h5>
                                                <p class="mt-3 text-white/80">{{useTrans('page.title_p')}}</p>
                                            </div>

                                            <div class="px-3 py-5 mt-2 mb-5 text-center text-yellow-800 rounded-md bg-yellow-50" role="alert"  v-if="verificationLinkSent">
                                                <p >{{useTrans('page.verification_link_sent')}}</p>
                                            </div>
                                            <form @submit.prevent="submit" class="mt-8">
                                                <div class="my-5 text-center">
                                                    <WhiteButton :class="{ 'opacity-25': form.processing }"
                                                        :disabled="form.processing">
                                                        {{useTrans('page.resend_verification_email')}}
                                                    </WhiteButton>
                                                </div>
                                            </form>

                                            <div class="mt-8 text-center">
                                                <p class="text-white/50">{{useTrans('page.want_to')}}
                                                    <Link
                                                        :href="route('logout', { locale: usePage().props.locale })"
                                                        method="post"
                                                        as="button"
                                                        class="text-white underline fw-medium"
                                                        >{{useTrans('page.log_out')}}
                                                    </Link>
                                                </p>
                                            </div>
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
