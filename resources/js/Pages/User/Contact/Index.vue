<script setup>

import Layout from '@/Layouts/User/Layout.vue';
import { defineProps, computed } from 'vue';
import { Head, useForm, router  } from '@inertiajs/vue3';
import UserInfo from '@/Components/UserInfo.vue';
import { useTrans } from '@/trans';
import PreferredCategories from '@/Components/PreferredCategories.vue';
import ContactDetails from '@/Components/ContactDetails.vue';
import Comment from '@/Components/Comment.vue';
import UserWorks from '@/Components/UserWorks.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import { useModalStore } from '@/Stores/modalStore'

const modal = useModalStore()



const props = defineProps({
  locale: String,


})


const form = useForm({
            name: '',
            email:'',
            subject:'',
            your_message:'',
        });

const submitForm = async () => {
    try {
        const response = await axios.post(route('contact.store', { locale: props.locale }), form)

        modal.showSuccess(response?.data?.message)


        form.reset()
    } catch (error) {

        let message = error?.response?.data?.message || 'Произошла ошибка при отправке писмо .'
        message = message.replace(/\s?\(and.*?\)$/i, '')

        modal.showError(message)
        console.error('Ошибка при отправке:', error)
    }
}




</script>
<template>
      <Layout>
         <section class="pt-28 lg:pt-44 pb-28 group-data-[theme-color=violet]:bg-violet-500 group-data-[theme-color=sky]:bg-sky-500 group-data-[theme-color=red]:bg-red-500 group-data-[theme-color=green]:bg-green-500 group-data-[theme-color=pink]:bg-pink-500 group-data-[theme-color=blue]:bg-blue-500 dark:bg-neutral-900 bg-[url('../images/home/page-title.png')] bg-center bg-cover relative" >
            <div class="container mx-auto">
                <div class="grid">
                    <div class="col-span-12">
                        <div class="text-center text-white">
                            <h3 class="mb-4 text-[26px]">{{useTrans('page.title')}}</h3>
                            <div class="page-next">
                                <nav class="inline-block" aria-label="breadcrumb text-center">

                                <ol class="flex flex-wrap justify-center text-sm font-medium uppercase text-white">
                                    <li>
                                        <Link :href="route('welcome', { locale: $page.props.locale })" class="block">
                                            {{ useTrans('navbar.home') }}
                                        </Link>
                                    </li>

                                    <li class="flex items-center px-2">
                                        <i class="bx bxs-chevron-right mr-1.5 text-base"></i>
                                        <Link :href="route('specialists', { locale: $page.props.locale })" class="block">
                                            {{ useTrans('navbar.specialists') }}
                                        </Link>
                                    </li>

                                    <li class="flex items-center active" aria-current="page">
                                        <i class="bx bxs-chevron-right mr-1.5 text-base"></i>
                                        {{ useTrans('page.title') }}
                                    </li>
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
     <section class="pt-16">
                        <div class="container mx-auto">
                            <div class="grid items-center grid-cols-12 mt-5 lg:gap-8 gap-y-8">
                                <div class="col-span-12 lg:col-span-6">
                                    <div class="mt-4">
                                        <h3 class="mb-2 text-3xl text-gray-900 dark:text-white">Get in touch</h3>
                                        <p class="text-gray-500 dark:text-gray-300">Start working with Jobcy that can provide everything you need to generate
                                            awareness, drive traffic, connect.</p>
                                        <form method="post"  @submit.prevent = "submitForm" onsubmit="return validateForm()" class="mt-4 contact-form" name="myForm" id="myForm">
                                            <span id="error-msg"></span>
                                            <div class="grid grid-cols-12 gap-5">
                                                <div class="col-span-12">
                                                    <div class="mb-3">
                                                        <InputLabel for="title"
                                                        :value="$page.props.translations.page.name"
                                                         class="text-grey" required />
                                                         <TextInput
                                                            v-model="form.name"
                                                            id="title"
                                                            type="text"
                                                            class="w-full mt-1 text-gray-500 border rounded border-gray-100/50 text-13 dark:bg-transparent dark:border-neutral-600"
                                                            autofocus
                                                            autocomplete="title"
                                                            :placeholder="useTrans('page.name')"

                                                            />

                                                        <!-- <label for="nameInput" class="text-gray-900 dark:text-gray-50">Name</label>
                                                        <input type="text" name="name" id="name" class="w-full mt-1 rounded border-gray-100/50 placeholder:text-sm placeholder:text-gray-400 dark:bg-transparent dark:border-gray-800 focus:ring-0 focus:ring-offset-0 dark:text-gray-200" placeholder="Enter your name"> -->
                                                    </div>
                                                </div><!--end col-->
                                                <div class="col-span-12 lg:col-span-6">
                                                    <div class="mb-3">
                                                         <InputLabel for="title"
                                                        :value="$page.props.translations.page.email"
                                                         class="text-grey" required />
                                                         <TextInput
                                                            v-model="form.email"
                                                            id="email"
                                                            type="email"
                                                            class="w-full mt-1 text-gray-500 border rounded border-gray-100/50 text-13 dark:bg-transparent dark:border-neutral-600"
                                                            autofocus
                                                            autocomplete="title"
                                                            :placeholder="useTrans('page.email')"

                                                            />

                                                        <!-- <label for="emailInput" class="text-gray-900 dark:text-gray-50">Email</label> -->
                                                        <!-- <input type="email" class="w-full mt-1 rounded border-gray-100/50 placeholder:text-sm placeholder:text-gray-400 dark:bg-transparent dark:border-gray-800 focus:ring-0 focus:ring-offset-0 dark:text-gray-200" id="emaiol" name="email" placeholder="Enter your email"> -->
                                                    </div>
                                                </div><!--end col-->
                                                <div class="col-span-12 lg:col-span-6">
                                                    <div class="mb-3">
                                                        <InputLabel for="title"
                                                        :value="$page.props.translations.page.subject"
                                                         class="text-grey" required />

                                                         <TextInput
                                                            v-model="form.subject"
                                                            id="subject"
                                                            type="text"
                                                            class="w-full mt-1 text-gray-500 border rounded border-gray-100/50 text-13 dark:bg-transparent dark:border-neutral-600"
                                                            autofocus
                                                            autocomplete="title"
                                                            :placeholder="useTrans('page.subject')"

                                                            />

                                                        <!-- <label for="subjectInput" class="text-gray-900 dark:text-gray-50">Subject</label> -->
                                                        <!-- <input type="text" class="w-full mt-1 rounded border-gray-100/50 placeholder:text-sm placeholder:text-gray-400 dark:bg-transparent dark:border-gray-800 focus:ring-0 focus:ring-offset-0 dark:text-gray-200" id="subjectInput" name="subject" placeholder="Enter your subject"> -->
                                                    </div>
                                                </div><!--end col-->
                                                <div class="col-span-12">
                                                    <div class="mb-3">
                                                        <InputLabel for="your_message"
                                                        :value="$page.props.translations.page.your_message"
                                                         class="text-grey" required />
                                                         <TextArea
                                                             v-model="form.your_message"
                                                              autofocus
                                                             :placeholder="useTrans('page.your_message')"
                                                            >

                                                            </TextArea>
                                                        <!-- <label for="meassageInput" class="text-gray-900 dark:text-gray-50">Your Message</label> -->
                                                        <!-- <textarea class="w-full mt-1 rounded border-gray-100/50 placeholder:text-sm placeholder:text-gray-400 dark:bg-transparent dark:border-gray-800 focus:ring-0 focus:ring-offset-0 dark:text-gray-200" id="meassageInput" placeholder="Enter your message" name="comments" rows="3"></textarea> -->
                                                    </div>
                                                </div><!--end col-->
                                            </div><!--end row-->
                                            <div class="text-right">
                                                <button type="submit" id="submit" name="submit" class="text-white border-transparent btn group-data-[theme-color=violet]:bg-violet-500 group-data-[theme-color=sky]:bg-sky-500 group-data-[theme-color=red]:bg-red-500 group-data-[theme-color=green]:bg-green-500 group-data-[theme-color=pink]:bg-pink-500 group-data-[theme-color=blue]:bg-blue-500"> Send Message <i class="uil uil-message ms-1"></i></button>
                                            </div>
                                        </form><!--end form-->
                                    </div>
                                </div><!--end col-->
                                <div class="col-span-12 lg:col-span-5 lg:ml-20">
                                    <div class="text-center">
                                        <img src="assets/images/contact.png" alt="" class="img-fluid">
                                    </div>
                                    <div class="pt-3 mt-4">
                                        <div class="flex items-center mt-2 text-gray-500">
                                            <div class="group-data-[theme-color=violet]:text-violet-500 group-data-[theme-color=sky]:text-sky-500 group-data-[theme-color=red]:text-red-500 group-data-[theme-color=green]:text-green-500 group-data-[theme-color=pink]:text-pink-500 group-data-[theme-color=blue]:text-blue-500 shrink-0 text-22">
                                                <i class="uil uil-map-marker"></i>
                                            </div>
                                            <div class="ltr:ml-2 rtl:mr-2 grow-1">
                                                <p class="mb-0 dark:text-gray-300">2453 Clinton StreetLittle Rock, California, USA</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center mt-2 text-gray-500">
                                            <div class="group-data-[theme-color=violet]:text-violet-500 group-data-[theme-color=sky]:text-sky-500 group-data-[theme-color=red]:text-red-500 group-data-[theme-color=green]:text-green-500 group-data-[theme-color=pink]:text-pink-500 group-data-[theme-color=blue]:text-blue-500 shrink-0 text-22">
                                                <i class="uil uil-envelope"></i>
                                            </div>
                                            <div class="ltr:ml-2 rtl:mr-2 grow-1">
                                                <p class="mb-0 dark:text-gray-300">contactus@Jobcy.com</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center mt-2 text-gray-500">
                                            <div class="group-data-[theme-color=violet]:text-violet-500 group-data-[theme-color=sky]:text-sky-500 group-data-[theme-color=red]:text-red-500 group-data-[theme-color=green]:text-green-500 group-data-[theme-color=pink]:text-pink-500 group-data-[theme-color=blue]:text-blue-500 shrink-0 text-22">
                                                <i class="uil uil-phone-alt"></i>
                                            </div>
                                            <div class="ltr:ml-2 rtl:mr-2 grow-1">
                                                <p class="mb-0 dark:text-gray-300">(+245) 223 1245</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                        </div>
                        <div class="pt-20">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6509157.364974411!2d-123.79641389801948!3d37.193115265681!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808fb9fe5f285e3d%3A0x8b5109a227086f55!2sCalifornia%2C%20USA!5e0!3m2!1sen!2sin!4v1628684675253!5m2!1sen!2sin" height="350" style="border:0;width: 100%;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </section>

      </Layout>
</template>
