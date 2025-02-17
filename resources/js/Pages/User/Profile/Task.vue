<script setup>

import { Head } from '@inertiajs/vue3';
import Index from './Index.vue';
import InputLabel from 'vendor/laravel/breeze/stubs/inertia-react/resources/js/Components/InputLabel';




</script>

<template>
    <Index>
        <Head title = "Profile" />
        <template #content>
            <div class="w-full tab-pane block" id="settings-tab">
                                                    <div class="pt-8 space-x-8">
                                                        <form  @submit.prevent = submit >
                                                            <div>
                                                                <h5 class="mb-3 text-gray-900 fs-17 fw-semibold dark:text-gray-50">My Account</h5>
                                                                <!-- <div class="text-center">
                                                                    <div class="relative mb-4">
                                                                        <img src="assets/images/user/img-02.jpg" class="w-40 h-40 p-1 mx-auto border-2 rounded-full border-gray-100/50 dark:border-neutral-600" id="profile-img" alt="">
                                                                        <div class="absolute w-8 h-8 leading-8 text-center rounded-full shadow-md bottom-2 right-[42%] z-40 bg-gray-50 dark:bg-neutral-700 dark:text-white">
                                                                            <input id="profile-img-file-input" type="file" class="hidden" onchange="previewImg()">
                                                                            <label for="profile-img-file-input" class="">
                                                                                <i class="uil uil-edit"></i>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div> -->
                                                                <div class="mt-5">
                                                                    <div class="grid grid-cols-12 gap-5">
                                                                        <div class="col-span-12 lg:col-span-6">
                                                                            <div class="mb-3">
                                                                                <InputLabel for="category" value="category name" class="text-white" />

                                                                                <!-- <label for="firstName" class="text-sm text-gray-900 dark:text-gray-50">First Name</label> -->
                                                                                <input type="text" class="w-full mt-1 text-gray-500 border rounded border-gray-100/50 text-13 dark:bg-transparent dark:border-neutral-600" id="firstName" value="Jansh">
                                                                            </div>
                                                                        </div>
                                                                        <!--end col-->
                                                                        <div class="col-span-12 lg:col-span-6">
                                                                            <div class="mb-3">
                                                                                <label for="lastName" class="text-sm text-gray-900 dark:text-gray-50">Last Name</label>
                                                                                <input type="text" class="w-full mt-1 text-gray-500 border rounded border-gray-100/50 text-13 dark:bg-transparent dark:border-neutral-600" id="lastName" value="Dickens">
                                                                            </div>
                                                                        </div>
                                                                        <!--end col-->
                                                                        <div class="col-span-12 lg:col-span-6">
                                                                            <div class="mb-3">
                                                                                <label for="choices-single-categories" class="text-sm text-gray-900 dark:text-gray-50">Account Type</label>
                                                                                <div class="mt-1">
                                                                                    <div class="choices" data-type="select-one" tabindex="0" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-expanded="false"><div class="choices__inner"><select class="form-select choices__input" data-trigger="" name="choices-single-categories" id="choices-single-categories" aria-label="Default select example" hidden="" tabindex="-1" data-choice="active"><option value="4" data-custom-properties="[object Object]">Accounting</option></select><div class="choices__list choices__list--single"><div class="choices__item choices__item--selectable" data-item="" data-id="1" data-value="4" data-custom-properties="[object Object]" aria-selected="true">Accounting</div></div></div><div class="choices__list choices__list--dropdown" aria-expanded="false"><input type="search" name="search_terms" class="choices__input choices__input--cloned" autocomplete="off" autocapitalize="off" spellcheck="false" role="textbox" aria-autocomplete="list" aria-label="null" placeholder=""><div class="choices__list" role="listbox"><div id="choices--choices-single-categories-item-choice-1" class="choices__item choices__item--choice is-selected choices__item--selectable is-highlighted" role="option" data-choice="" data-id="1" data-value="4" data-select-text="Press to select" data-choice-selectable="" aria-selected="true">Accounting</div><div id="choices--choices-single-categories-item-choice-2" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="2" data-value="5" data-select-text="Press to select" data-choice-selectable="">Banking</div><div id="choices--choices-single-categories-item-choice-3" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="3" data-value="1" data-select-text="Press to select" data-choice-selectable="">IT &amp; Software</div><div id="choices--choices-single-categories-item-choice-4" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="4" data-value="3" data-select-text="Press to select" data-choice-selectable="">Marketing</div></div></div></div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!--end col-->
                                                                        <div class="col-span-12 lg:col-span-6">
                                                                            <div class="mb-3">
                                                                                <label for="email" class="text-sm text-gray-900 dark:text-gray-50">Email</label>
                                                                                <input type="text" class="w-full mt-1 text-gray-500 border rounded border-gray-100/50 text-13 dark:bg-transparent dark:border-neutral-600" id="email" value="Jansh@gmail.com">
                                                                            </div>
                                                                        </div>
                                                                        <!--end col-->
                                                                    </div>
                                                                </div>
                                                                <!--end row-->
                                                            </div>
                                                            <!--end account-->
                                                            <div class="mt-4">
                                                                <h5 class="mb-3 font-semibold text-gray-900 text-17 dark:text-gray-50">Profile</h5>
                                                                <div class="grid grid-cols-12 gap-5">
                                                                    <div class="col-span-12">
                                                                        <div class="mb-3">
                                                                            <label for="exampleFormControlTextarea1" class="form-label dark:text-gray-300">Introduce Yourself</label>
                                                                            <textarea class="w-full mt-1 text-sm rounded border-gray-100/50 dark:bg-transparent dark:border-neutral-600 dark:text-gray-300" id="exampleFormControlTextarea1" rows="5">Developer with over 5 years' experience working in both the public and private sectors. Diplomatic, personable, and adept at managing sensitive situations. Highly organized, self-motivated, and proficient with computers. Looking to boost students’ satisfactions scores for International University. Bachelor's degree in communications.</textarea>
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                    <div class="col-span-12 lg:col-span-6">
                                                                        <div class="mb-3">
                                                                            <label for="languages" class="text-sm text-gray-900 dark:text-gray-50">Languages</label>
                                                                            <input type="text" class="w-full mt-1 text-gray-500 border rounded border-gray-100/50 text-13 dark:bg-transparent dark:border-neutral-600" id="languages" value="English, German, French">
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                    <div class="col-span-12 lg:col-span-6">
                                                                        <div class="mb-3">
                                                                            <label for="choices-single-location" class="text-sm text-gray-900 dark:text-gray-50">Location</label>
                                                                            <div class="mt-1">
                                                                                <div class="choices" data-type="select-one" tabindex="0" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-expanded="false"><div class="choices__inner"><select class="form-select choices__input" data-trigger="" name="choices-single-location" id="choices-single-location" aria-label="Default select exam
                                                                                    ple" hidden="" tabindex="-1" data-choice="active"><option value="ME" data-custom-properties="[object Object]">Montenegro</option></select><div class="choices__list choices__list--single"><div class="choices__item choices__item--selectable" data-item="" data-id="1" data-value="ME" data-custom-properties="[object Object]" aria-selected="true">Montenegro</div></div></div><div class="choices__list choices__list--dropdown" aria-expanded="false"><input type="search" name="search_terms" class="choices__input choices__input--cloned" autocomplete="off" autocapitalize="off" spellcheck="false" role="textbox" aria-autocomplete="list" aria-label="null" placeholder=""><div class="choices__list" role="listbox"><div id="choices--choices-single-location-item-choice-1" class="choices__item choices__item--choice is-selected choices__item--selectable is-highlighted" role="option" data-choice="" data-id="1" data-value="ME" data-select-text="Press to select" data-choice-selectable="" aria-selected="true">Montenegro</div><div id="choices--choices-single-location-item-choice-2" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="2" data-value="MS" data-select-text="Press to select" data-choice-selectable="">Montserrat</div><div id="choices--choices-single-location-item-choice-3" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="3" data-value="MA" data-select-text="Press to select" data-choice-selectable="">Morocco</div><div id="choices--choices-single-location-item-choice-4" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="4" data-value="MZ" data-select-text="Press to select" data-choice-selectable="">Mozambique</div></div></div></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                    <div class="col-span-12">
                                                                        <div class="mb-3 ">
                                                                            <div class="mb-3">
                                                                                <label for="formFileLg" class="inline-block mb-2 text-neutral-700 dark:text-neutral-200">Large file input example</label>
                                                                                <input class="relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-gray-100/50 bg-clip-padding pr-3 py-[0.32rem] font-normal leading-[2.15] text-neutral-700 transition duration-300 ease-in-out file:mr-2 file:-my-[0.32rem] file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-gray-100/30 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-neutral-200 focus:border-primary focus:text-neutral-700 focus:shadow-te-primary focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:file:bg-neutral-700 dark:file:text-neutral-100 dark:focus:border-primary" id="formFileLg" type="file">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                </div>
                                                                <!--end row-->
                                                            </div>
                                                            <!--end profile-->
                                                            <div class="mt-4">
                                                                <h5 class="mb-3 font-semibold text-gray-900 text-17 dark:text-gray-50">Social Media</h5>
                                                                <div class="grid grid-cols-12 gap-5">
                                                                    <div class="col-span-12 lg:col-span-6">
                                                                        <div class="mb-3">
                                                                            <label for="facebook" class="text-sm text-gray-900 dark:text-gray-50">Facebook</label>
                                                                            <input type="text" class="w-full mt-1 text-gray-500 border rounded border-gray-100/50 text-13 dark:bg-transparent dark:border-neutral-600" id="facebook" value="https://www.facebook.com">
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                    <div class="col-span-12 lg:col-span-6">
                                                                        <div class="mb-3">
                                                                            <label for="twitter" class="text-sm text-gray-900 dark:text-gray-50">Twitter</label>
                                                                            <input type="text" class="w-full mt-1 text-gray-500 border rounded border-gray-100/50 text-13 dark:bg-transparent dark:border-neutral-600" id="twitter" value="https://www.twitter.com">
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                    <div class="col-span-12 lg:col-span-6">
                                                                        <div class="mb-3">
                                                                            <label for="linkedin" class="text-sm text-gray-900 dark:text-gray-50">Linkedin</label>
                                                                            <input type="text" class="w-full mt-1 text-gray-500 border rounded border-gray-100/50 text-13 dark:bg-transparent dark:border-neutral-600" id="linkedin" value="https://www.linkedin.com">
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                    <div class="col-span-12 lg:col-span-6">
                                                                        <div class="mb-3">
                                                                            <label for="whatsapp" class="text-sm text-gray-900 dark:text-gray-50">Whatsapp</label>
                                                                            <input type="text" class="w-full mt-1 text-gray-500 border rounded border-gray-100/50 text-13 dark:bg-transparent dark:border-neutral-600" id="whatsapp" value="https://www.whatsapp.com">
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                </div>
                                                                <!--end row-->
                                                            </div>
                                                            <!--end socia-media-->
                                                            <div class="mt-4">
                                                                <h5 class="mb-3 font-semibold text-17 dark:text-gray-50">
                                                                    Change Password
                                                                </h5>
                                                                <div class="grid grid-cols-12 gap-5">
                                                                    <div class="col-span-12">
                                                                        <div class="mb-3">
                                                                            <label for="current-password-input" class="text-sm text-gray-900 dark:text-gray-50">Current
                                                                                password</label>
                                                                            <input type="password" class="w-full mt-1 text-gray-500 border rounded border-gray-100/50 text-13 dark:bg-transparent dark:border-neutral-600" placeholder="Enter Current password" id="current-password-input">
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                    <div class="col-span-12 lg:col-span-6">
                                                                        <div class="mb-3">
                                                                            <label for="new-password-input" class="text-sm text-gray-900 dark:text-gray-50">New
                                                                                password</label>
                                                                            <input type="password" class="w-full mt-1 text-gray-500 border rounded border-gray-100/50 text-13 dark:bg-transparent dark:border-neutral-600" placeholder="Enter new password" id="new-password-input">
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                    <div class="col-span-12 lg:col-span-6">
                                                                        <div class="mb-3">
                                                                            <label for="confirm-password-input" class="text-sm text-gray-900 dark:text-gray-50">Confirm Password</label>
                                                                            <input type="password" class="w-full mt-1 text-gray-500 border rounded border-gray-100/50 text-13 dark:bg-transparent dark:border-neutral-600" placeholder="Confirm Password" id="confirm-password-input">
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                    <div class="col-span-12">
                                                                        <div class="form-check">
                                                                            <input class="align-middle rounded cursor-pointer focus:ring-0 focus:ring-offset-0 bg-gray-50 border-gray-100/50 checked:bg-violet-500 checked:border-transparent dark:bg-transparent dark:border-neutral-600 dark:checked:bg-violet-500 dark:checked:border-transparent" type="checkbox" value="" id="verification">
                                                                            <label class="ml-2 align-middle dark:text-gray-300" for="verification">
                                                                                Enable Two-Step Verification via email
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                </div>
                                                                <!--end row-->
                                                            </div>
                                                            <!--end Change-password-->
                                                            <div class="mt-8 text-right">
                                                                <a href="javascript:void(0)" class="text-white btn group-data-[theme-color=violet]:bg-violet-500 group-data-[theme-color=sky]:bg-sky-500 group-data-[theme-color=red]:bg-red-500 group-data-[theme-color=green]:bg-green-500 group-data-[theme-color=pink]:bg-pink-500 group-data-[theme-color=blue]:bg-blue-500 border-transparent focus:ring group-data-[theme-color=violet]:focus:ring-violet-500/20 group-data-[theme-color=sky]:focus:ring-sky-500/20 group-data-[theme-color=red]:focus:ring-red-500/20 group-data-[theme-color=green]:focus:ring-green-500/20 group-data-[theme-color=pink]:focus:ring-pink-500/20 group-data-[theme-color=blue]:focus:ring-blue-500/20">Update</a>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
        </template>
    </Index>

</template>
