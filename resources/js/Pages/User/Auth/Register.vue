<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Select from '@/Components/Select.vue';
import Checkbox from '@/Components/Checkbox.vue'
import WhiteButton from '@/Components/WhiteButton.vue';

import TextInput from '@/Components/TextInput.vue';
import Layout from '@/Layouts/User/Layout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

import { usePage } from '@inertiajs/vue3';
import { useTrans } from '/resources/js/trans';

const props = defineProps({
  locations: Array
});

const locationOptions = props.locations.map(location => ({
  value: location.id,
  text: location.translations[0]?.name,
}));

console.log(locationOptions)
const form = useForm({
    name: '',
    email: '',
    phone: '',
    location_id: '',
    password: '',
    password_confirmation: '',
    agree_terms: ''
});

const submit = () => {

    form.post(route('register', { locale: usePage().props.locale }), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Layout >
        <Head title="Register" />
                <section class="flex items-center justify-center min-h-screen pt-40 pb-20 group-data-[theme-color=green]:bg-green-500/10 dark:bg-neutral-700">
                    <div class="container mx-auto">
                        <div class="grid grid-cols-12">
                            <div class="col-span-12 lg:col-span-10 lg:col-start-2">
                                <div class="flex flex-col bg-white rounded-lg dark:bg-neutral-800">
                                    <div class="grid flex-col grid-cols-12">
                                        <div class="col-span-6 ltr:rounded-l-lg rtl:rounded-r-lg">
                                            <div class="p-10">
                                                <a href="">
                                                    <img src="/assets/user/images/logo-light.png" alt=""
                                                        class="hidden mx-auto dark:block">
                                                    <img src="/assets/user/images/logo-dark.png" alt=""
                                                        class="block mx-auto dark:hidden">
                                                </a>
                                                <div class="mt-5">
                                                    <img src="/assets/user/images/auth/sign-up.png" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="col-span-12 rounded-b-md lg:col-span-6 group-data-[theme-color=green]:bg-green-500  lg:ltr:rounded-r-lg rtl:rounded-l-lg">
                                            <div class="flex flex-col justify-center h-full p-12">
                                                <div class="text-center"> ----- {{ useTrans('page.title') }} ++++ {{ useTrans('form.name') }}
                                                    <h1 v-text=" useTrans('page.title')"></h1>
                                                    <h5 class="text-[18.5px] text-white">Let's Get Started 7777 {{ $page.props.translations.page.title }} </h5>
                                                    <p class="mt-3 text-gray-50">Sign Up and get access to all the
                                                        features
                                                        of Jobcy</p>
                                                </div>
                                                <form @submit.prevent="submit" class="mt-8">
                                                    <div class="mb-5">
                                                        <!-- <label for="usernameInput" class="text-white">Username</label> -->
                                                        <InputLabel for="name" value="Name" class="text-white" />
                                                        <!-- <input type="text"
                                                            class="w-full mt-1 group-data-[theme-color=violet]:bg-violet-400/40 group-data-[theme-color=sky]:bg-sky-400/40 group-data-[theme-color=red]:bg-red-400/40 group-data-[theme-color=green]:bg-green-400/40 group-data-[theme-color=pink]:bg-pink-400/40 group-data-[theme-color=blue]:bg-blue-400/40 py-2.5 rounded border-transparent placeholder:text-sm placeholder:text-gray-50 text-white"
                                                            required="" id="usernameInput"
                                                            placeholder="Enter your username"> -->
                                                        <TextInput id="name" type="text"
                                                            class="w-full mt-1 group-data-[theme-color=violet]:bg-violet-400/40 group-data-[theme-color=sky]:bg-sky-400/40 group-data-[theme-color=red]:bg-red-400/40 group-data-[theme-color=green]:bg-green-400/40 group-data-[theme-color=pink]:bg-pink-400/40 group-data-[theme-color=blue]:bg-blue-400/40 py-2.5 rounded border-transparent placeholder:text-sm placeholder:text-gray-50 text-white"
                                                            v-model="form.name" required
                                                            placeholder="Enter your username" />

                                                        <InputError class="mt-2 opacity-60 "
                                                            :message="form.errors.name" />
                                                    </div>


                                                    <div class="mb-5">
                                                        <InputLabel for="email" value="Email" class="text-white" />

                                                        <TextInput id="email" type="text"
                                                            class="w-full mt-1 group-data-[theme-color=violet]:bg-violet-400/40 group-data-[theme-color=sky]:bg-sky-400/40 group-data-[theme-color=red]:bg-red-400/40 group-data-[theme-color=green]:bg-green-400/40 group-data-[theme-color=pink]:bg-pink-400/40 group-data-[theme-color=blue]:bg-blue-400/40 py-2.5 rounded border-transparent placeholder:text-sm placeholder:text-gray-50 text-white"
                                                            v-model="form.email" required
                                                            placeholder="Enter your email" />

                                                        <InputError class="mt-2 opacity-60"
                                                            :message="form.errors.email" />
                                                    </div>

                                                    <div class="mb-5">
                                                        <InputLabel for="phone" value="Phone" class="text-white" />

                                                        <TextInput id="phone" type="text"
                                                            class="w-full mt-1 group-data-[theme-color=violet]:bg-violet-400/40 group-data-[theme-color=sky]:bg-sky-400/40 group-data-[theme-color=red]:bg-red-400/40 group-data-[theme-color=green]:bg-green-400/40 group-data-[theme-color=pink]:bg-pink-400/40 group-data-[theme-color=blue]:bg-blue-400/40 py-2.5 rounded border-transparent placeholder:text-sm placeholder:text-gray-50 text-white"
                                                            v-model="form.phone" required
                                                            placeholder="Enter your phone number" />

                                                        <InputError class="mt-2 opacity-60"
                                                            :message="form.errors.phone" />
                                                    </div>

                                                     <div class="mb-5 relative filler-job-form">
                                                        <InputLabel for="location_id" value="Location" class="text-white"  />
                                                         <!-- <i class="uil uil-location-point"></i> -->
                                                        <Select
                                                            id="location_id"
                                                            :options="locationOptions"
                                                            v-model="form.location_id"

                                                        />
                                                        <InputError :message="form.errors.location_id" />
                                                    </div>

                                                    <div class="mb-5">
                                                        <InputLabel for="password" value="Passworg"
                                                            class="text-white" />

                                                        <TextInput id="password" type="password"
                                                            class="w-full mt-1 group-data-[theme-color=violet]:bg-violet-400/40 group-data-[theme-color=sky]:bg-sky-400/40 group-data-[theme-color=red]:bg-red-400/40 group-data-[theme-color=green]:bg-green-400/40 group-data-[theme-color=pink]:bg-pink-400/40 group-data-[theme-color=blue]:bg-blue-400/40 py-2.5 rounded border-transparent placeholder:text-sm placeholder:text-gray-50 text-white"
                                                            v-model="form.password" required
                                                            placeholder="Enter your password" />

                                                        <InputError class="mt-2 opacity-60"
                                                            :message="form.errors.password" />
                                                    </div>



                                                    <div class="mb-5">
                                                        <InputLabel for="password_confirmation" value="Confirm Password"
                                                            class="text-white" />

                                                        <TextInput id="password_confirmation" type="password"
                                                            class="w-full mt-1 group-data-[theme-color=violet]:bg-violet-400/40 group-data-[theme-color=sky]:bg-sky-400/40 group-data-[theme-color=red]:bg-red-400/40 group-data-[theme-color=green]:bg-green-400/40 group-data-[theme-color=pink]:bg-pink-400/40 group-data-[theme-color=blue]:bg-blue-400/40 py-2.5 rounded border-transparent placeholder:text-sm placeholder:text-gray-50 text-white"
                                                            v-model="form.password_confirmation" required
                                                            placeholder="Confirm Password" />

                                                        <InputError class="mt-2 opacity-60"
                                                            :message="form.errors.password_confirmation" />
                                                    </div>


                                                    <div class="mb-4">
                                                        <div class="flex">
                                                            <!-- <input
                                                                class="align-middle border-transparent rounded focus:ring-0 focus:ring-offset-0 group-data-[theme-color=violet]:checked:bg-violet-500 group-data-[theme-color=sky]:checked:bg-sky-500 group-data-[theme-color=red]:checked:bg-red-500 group-data-[theme-color=green]:checked:bg-green-500 group-data-[theme-color=pink]:checked:bg-pink-500 group-data-[theme-color=blue]:checked:bg-blue-500"
                                                                type="checkbox" id="flexCheckDefault" name="agree_terms">
                                                            <label class="text-white align-middle"
                                                                for="flexCheckDefault">I
                                                                agree to the
                                                                <a href="javascript:void(0)"
                                                                    class="pb-1 text-white underline align-middle">Terms
                                                                    and
                                                                    conditions
                                                                </a>
                                                            </label> -->
                                                            <Checkbox id="flexCheckDefault" v-model="form.agree_terms" class="align-middle border-transparent rounded focus:ring-0 focus:ring-offset-0 group-data-[theme-color=green]:checked:bg-green-500 mr-2"></Checkbox>

                                                            <InputLabel for="flexCheckDefault" value="agree to the"
                                                            class="text-white" />
                                                            <Link :href="route('login', { locale: usePage().props.locale })" class="text-white underline fw-medium">
                                                                  Terms and conditions </Link>

                                                        </div>
                                                        <InputError class="mt-2 opacity-60"
                                                                :message="form.errors.agree_terms" />
                                                    </div>
                                                    <div class="my-5 text-center">

                                                        <WhiteButton :class="{ 'opacity-25': form.processing }"
                                                            :disabled="form.processing">
                                                            Register
                                                        </WhiteButton>

                                                    </div>
                                                </form>
                                                <div class="text-center">
                                                    <Link :href="route('login', { locale: usePage().props.locale })" class="text-white underline fw-medium">
                                                    Sign In </Link>
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
