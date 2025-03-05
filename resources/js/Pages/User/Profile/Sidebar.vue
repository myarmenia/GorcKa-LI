<script setup>
    // import { Link } from '@inertiajs/vue3';
    import { usePage, Link } from '@inertiajs/vue3';
    import axios from 'axios';

    import { onMounted,ref, watch , computed} from 'vue';
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



</script>
<style>
    .profile-user-img:hove {
        background-color:blue;
        cursor:pointer;

    }
</style>
<template>
      <div class="col-span-12 lg:col-span-4">
                                    <div class="border rounded border-gray-100/50 dark:border-neutral-600">
                                        <div class="p-5 border-b border-gray-100/50 dark:border-neutral-600">
                                            <div class="text-center">
                                                <input  @change="handelFileChange" ref="fileInput" type="file" class="">

                                                <img @click="openFileInput" :src = "profilePictureUrl ?profilePictureUrl : '/assets/user/images/user/profile.jpg'" alt="" class="w-20 h-20 p-1 mx-auto border-2 rounded-full border-gray-200/20 profile-user-img">
                                                <h6 class="mt-4 mb-0 text-lg text-gray-900 dark:text-gray-50">Jansh Dickens</h6>
                                                <p class="mb-4 text-gray-500 dark:text-gray-300">Developer</p>
                                                <ul class="flex flex-wrap justify-center gap-2 mb-0">
                                                    <li class="w-10 h-10 text-lg leading-10 transition-all duration-300 ease-in-out rounded bg-violet-500/20 text-violet-500 hover:bg-violet-500 hover:text-white">
                                                        <a href="javascript:void(0)" class="social-link rounded-3 "><i class="uil uil-facebook-f"></i></a>
                                                    </li>
                                                    <li class="w-10 h-10 text-lg leading-10 transition-all duration-300 ease-in-out rounded bg-sky-500/20 text-sky-500 hover:bg-sky-500 hover:text-white">
                                                        <a href="javascript:void(0)" class="social-link rounded-3 btn-soft-info"><i class="uil uil-twitter-alt"></i></a>
                                                    </li>
                                                    <li class="w-10 h-10 text-lg leading-10 text-green-500 transition-all duration-300 ease-in-out rounded bg-green-500/20 hover:bg-green-500 hover:text-white">
                                                        <a href="javascript:void(0)" class="social-link rounded-3 btn-soft-success"><i class="uil uil-whatsapp"></i></a>
                                                    </li>
                                                    <li class="w-10 h-10 text-lg leading-10 text-red-500 transition-all duration-300 ease-in-out rounded bg-red-500/20 hover:bg-red-500 hover:text-white">
                                                        <a href="javascript:void(0)" class="social-link rounded-3 btn-soft-danger"><i class="uil uil-phone-alt"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="p-5">
                                            <div class="pb-5 border-b border-gray-100/50 dark:border-neutral-600">
                                                <h6 class="mb-5 font-semibold text-gray-900 text-17 dark:text-gray-50">Documents</h6>
                                                <ul class="">
                                                    <li>
                                                        <div class="flex items-center mt-4 ">
                                                            <div class="text-2xl text-gray-500 shrink-0">
                                                                <i class="uil uil-file"></i>
                                                            </div>
                                                            <div class="ml-4">
                                                                <h6 class="mb-0 text-gray-900 text-16 dark:text-gray-50">Resume.pdf</h6>
                                                                <p class="mb-0 text-gray-500 dark:text-gray-300">1.25 MB</p>
                                                            </div>
                                                            <div class="ml-auto text-xl">
                                                                <a href="assets/images/dark-logo.png" download="" class="text-gray-500 fs-20"><i class="uil uil-import"></i></a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="flex items-center mt-4 ">
                                                            <div class="text-2xl text-gray-500 shrink-0">
                                                                <i class="uil uil-file"></i>
                                                            </div>
                                                            <div class="ml-4">
                                                                <h6 class="mb-0 text-gray-900 text-16 dark:text-gray-50">Cover-letter.pdf</h6>
                                                                <p class="mb-0 text-gray-500 dark:text-gray-300">1.25 MB</p>
                                                            </div>
                                                            <div class="ml-auto text-xl">
                                                                <a href="assets/images/dark-logo.png" download="" class="text-gray-500 fs-20"><i class="uil uil-import"></i></a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>

                                        </div>
                                        <div class="p-5 pt-0">
                                            <h6 class="mb-3 font-semibold text-gray-900 text-17 dark:text-gray-50">Contacts</h6>
                                            <ul class="mb-0">
                                                <li class="pb-3">
                                                    <div class="flex">
                                                        <label class="w-32 font-medium text-gray-900 dark:text-gray-50">Email</label>
                                                        <div>
                                                            <p class="mb-0 text-gray-500 text-break dark:text-gray-300">
                                                                Jansh@gmail.com
                                                            </p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="pb-3">
                                                    <div class="flex">
                                                        <label class="w-32 font-medium text-gray-900 dark:text-gray-50">Phone Number</label>
                                                        <div>
                                                            <p class="mb-0 text-gray-500 dark:text-gray-300">+2 345 678 0000</p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="pb-3">
                                                    <div class="flex">
                                                        <label class="w-32 font-medium text-gray-900 dark:text-gray-50">Location</label>
                                                        <div>
                                                            <p class="mb-0 text-gray-500 dark:text-gray-300">New Caledonia</p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="pb-3">
                                                    <div class="flex">
                                                        <label class="w-32 font-medium text-gray-900 dark:text-gray-50"></label>
                                                        <div>


                                                            <Link :href="route('task.list',{locale:usePage().props.locale})">Task Page</Link><br>
                                                            <Link :href="route('task.create',{locale:usePage().props.locale})">Task create</Link>

                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>

                                    </div>
      </div>

</template>
