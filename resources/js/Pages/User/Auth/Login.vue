<script setup>
import { computed, watch } from "vue";

import Checkbox from '@/Components/Checkbox.vue';
import Layout from '@/Layouts/User/Layout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import WhiteButton from '@/Components/WhiteButton.vue';

import { Head, Link, useForm } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import { useTrans } from '/resources/js/trans';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const currentLanguage = computed(() => usePage().props.locale);

watch(currentLanguage, () => {
  form.errors = {};
});

const form = useForm({
    email: '',
    password: ''
});

const submit = () => {
    form.post(route('login', { locale: usePage().props.locale }), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Layout>
        <Head :title="useTrans('page.title')" />

        <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <section class="flex items-center justify-center min-h-screen py-10 group-data-[theme-color=green]:bg-green-500/10 dark:bg-neutral-700">
                    <div class="container mx-auto">
                        <div class="grid grid-cols-12">
                            <div class="col-span-12 lg:col-span-10 lg:col-start-2">
                                <div class="flex flex-col bg-white rounded-lg dark:bg-neutral-800">
                                    <div class="grid flex-col grid-cols-12 ">
                                        <div class="col-span-12 lg:col-span-6 ltr:rounded-l-lg rtl:rounded-r-lg">
                                            <div class="p-10">
                                                <a href="index.html">
                                                    <img src="/assets/user/images/logo.png" alt="" class="hidden mx-auto dark:block">
                                                    <img src="/assets/user/images/logo.png" alt="" class="block mx-auto dark:hidden">
                                                </a>
                                                <div class="mt-5">
                                                    <img src="/assets/user/images/auth/sign-in.png" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-span-12 rounded-b-md lg:col-span-6 group-data-[theme-color=green]:bg-green-700 lg:rounded-b-none lg:ltr:rounded-r-lg rtl:rounded-l-lg">
                                            <div class="flex flex-col justify-center h-full p-12">
                                                <div class="text-center">
                                                    <h5 class="text-[18.5px] text-white">{{useTrans('page.title_h5')}}</h5>
                                                    <!-- <p class="mt-3 text-white/80">{{useTrans('page.title_p')}}</p> -->
                                                </div>
                                                 <div class="px-3 py-5 mt-2 mb-5 text-center text-yellow-800 rounded-md bg-yellow-50" role="alert"  v-if="status">
                                                    <p >{{status}}</p>
                                                </div>
                                                <form @submit.prevent="submit" class="mt-8">
                                                    <div class="mb-5">
                                                        <InputLabel for="email" :value="useTrans('form.email')" class="text-white" />
                                                        <TextInput
                                                            id="email"
                                                            type="email"
                                                            class="w-full mt-1 group-data-[theme-color=green]:bg-green-400/40 py-2.5 rounded border-transparent placeholder:text-sm placeholder:text-gray-50 text-white"
                                                            v-model="form.email"
                                                            autofocus
                                                            autocomplete="email"
                                                            :placeholder="useTrans('form.email_placeholder')"

                                                        />
                                                        <InputError class="mt-2 opacity-60" :message="form.errors.email" />
                                                    </div>

                                                    <div class="mb-5">
                                                        <InputLabel for="password" :value="useTrans('form.password')" class="text-white" />
                                                        <TextInput
                                                            id="password"
                                                            type="password"
                                                            class="w-full mt-1 group-data-[theme-color=green]:bg-green-400/40 py-2.5 rounded border-transparent placeholder:text-sm placeholder:text-gray-50 text-white"
                                                            v-model="form.password"
                                                            autocomplete="current-password"
                                                            :placeholder="useTrans('form.password_placeholder')"
                                                        />
                                                        <InputError class="mt-2 opacity-60" :message="form.errors.password" />
                                                    </div>

                                                    <div >
                                                        <Link
                                                            v-if="canResetPassword"
                                                            :href="route('password.request', { locale: usePage().props.locale })"
                                                            class="mb-4 text-white ltr:float-right rtl:float-left"
                                                        >
                                                            {{useTrans('page.forgot_password')}}
                                                        </Link>
                                                    </div>
                                                    <div class="my-8 text-center">
                                                         <WhiteButton
                                                            :class="{ 'opacity-25': form.processing }"
                                                            :disabled="form.processing"
                                                        >
                                                            {{useTrans('page.sign_in')}}
                                                        </WhiteButton>

                                                    </div>
                                                </form>
                                                <div class="text-center">
                                                    <p class="text-white">{{useTrans('page.not_registered')}}
                                                        <Link :href="route('register', { locale: usePage().props.locale })" class="text-white text-xl underline fw-medium">
                                                            {{useTrans('form.register')}}
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
