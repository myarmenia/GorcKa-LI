<script setup>
import { computed } from 'vue';
import Layout from '@/Layouts/User/Layout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import WhiteButton from '@/Components/WhiteButton.vue';

import { Head, Link, useForm } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
const locale_lng = usePage().props.locale; // Получаем локаль

const props = defineProps({
    status: {
        type: String,
    },
});

const form = useForm({});

const submit = () => {
    form.post(route('verification.send', { locale: locale_lng }));
};

const verificationLinkSent = computed(
    () => props.status === 'verification-link-sent',
);
</script>

<template>
    <Layout>
        <Head title="Email Verification" />

            <section class="flex items-center justify-center min-h-screen py-10 group-data-[theme-color=green]:bg-green-500/10 dark:bg-neutral-700">
                <div class="container mx-auto">
                    <div class="grid grid-cols-12">
                        <div class="col-span-12 lg:col-span-10 lg:col-start-2">
                            <div class="flex flex-col bg-white rounded-lg dark:bg-neutral-800">
                                <div class="grid flex-col grid-cols-12">
                                    <div class="col-span-12 lg:col-span-6 ltr:rounded-l-lg rtl:rounded-r-lg">
                                        <div class="p-10">
                                            <a href="">
                                                <img src="/assets/user/images/logo-light.png" alt="" class="hidden mx-auto dark:block">
                                                <img src="/assets/user/images/logo-dark.png" alt="" class="block mx-auto dark:hidden">
                                            </a>
                                            <div class="mt-5">
                                                <img src="/assets/user/images/auth/reset-password.png" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-12 rounded-b-md lg:col-span-6 group-data-[theme-color=green]:bg-green-700 lg:rounded-b-none lg:ltr:rounded-r-lg rtl:rounded-l-lg">
                                        <div class="flex flex-col justify-center h-full p-12">
                                            <div class="text-center">
                                                <h5 class="text-[18.5px] text-white">Email Verification</h5>
                                                <p class="mt-3 text-white/80">Thanks for signing up! Before getting started, could you verify your
                                                        email address by clicking on the link we just emailed to you? If you
                                                        didn't receive the email, we will gladly send you another.</p>
                                            </div>

                                            <div class="px-3 py-5 mt-2 mb-5 text-center text-yellow-800 rounded-md bg-yellow-50" role="alert"  v-if="verificationLinkSent">
                                                <p > A new verification link has been sent to the email address you
                                                provided during registration.</p>
                                            </div>
                                            <form @submit.prevent="submit" class="mt-8">
                                                <div class="my-5 text-center">
                                                    <WhiteButton :class="{ 'opacity-25': form.processing }"
                                                        :disabled="form.processing">
                                                        Resend Verification Email
                                                    </WhiteButton>
                                                </div>
                                            </form>

                                            <div class="mt-8 text-center">
                                                <p class="text-white/50">If you want to ?
                                                    <Link
                                                        :href="route('logout', { locale: locale_lng })"
                                                        method="post"
                                                        as="button"
                                                        class="text-white underline fw-medium"
                                                        >Log Out
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
