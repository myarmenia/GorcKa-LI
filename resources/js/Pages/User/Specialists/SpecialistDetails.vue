<script setup>
import Layout from '@/Layouts/User/Layout.vue';
import { defineProps, computed } from 'vue'
import UserInfo from '@/Components/UserInfo.vue';
import { useTrans } from '@/trans';
import PreferredCategories from '@/Components/PreferredCategories.vue';
import ContactDetails from '@/Components/ContactDetails.vue';
import Comment from '@/Components/Comment.vue';

const props = defineProps({
  locale: String,
  user: Object,
  socialMedias:Array,
  categories:Array,
  defaultAvatar: {
    type: String,
    default: '/assets/user/images/user.svg',
  },
})
console.log(props.user,'user')
// console.log(props.categories,"categories")
// console.log(props.user.executor_sub_categories,'executor_sub_categories')




</script>
<template>
      <Layout>
        <section class="py-20">
                        <div class="container mx-auto">
                            <div class="grid grid-cols-12 gap-y-10 lg:gap-10">
                                <div class="col-span-12 lg:col-span-4">
                                     <div class="border rounded border-gray-100/50 dark:border-neutral-600">
                                        <div class="p-5 border-b border-gray-100/50 dark:border-neutral-600">
                                            <UserInfo
                                                :user="props.user"
                                                :socialMedias
                                            />
                                        </div>
                                        <div class="p-5 border-b border-gray-100/50 dark:border-neutral-600">
                                            <PreferredCategories
                                              :user = "props.user"
                                              :categories = "props.categories"
                                            />
                                        </div>
                                        <div class="p-5">
                                            <ContactDetails
                                               :user="props.user"
                                            />
                                        </div>
                                    </div>

                                </div>
                                <div class="col-span-12 lg:col-span-8">
                                    <div class="p-6 border rounded border-gray-100/50 dark:border-neutral-600">
                                        <div>
                                            <h6 class="mb-3 text-gray-900 text-17 dark:text-gray-50">{{ useTrans('page.about_specialist') }}</h6>
                                            <p class="mb-2 text-gray-500 dark:text-gray-300">{{ props.user.description }}</p>
                                        </div>


                                         <div class="pt-10">
                                            <h6 class="mb-0 text-gray-900 text-17 fw-bold dark:text-gray-50">Projects</h6>

                                            <!-- <div class="mt-4 ">
                                                <div class="grid grid-cols-12 gap-5">
                                                    <div class="col-span-4">
                                                        <div class="relative overflow-hidden rounded-md group/project">
                                                            <img src="assets/images/blog/img-01.jpg" alt="" class="transition-all duration-300 ease-in-out group-hover/project:scale-110">
                                                            <div class="transition-all duration-300 ease-in-out group-hover/project:bg-black/40 group-hover/project:absolute group-hover/project:inset-0"></div>
                                                            <div class="absolute top-[50%] left-[50%] -translate-x-5 -translate-y-5 group-hover/project:block hidden transition-all duration-300 ease-in-out text-2xl">
                                                                <a href="assets/images/blog/img-01.jpg" class="text-white image-popup" data-title="The Coding Awards" data-description="There are many variations of passages of available, but the majority alteration in some form."><i class="uil uil-search-alt"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-span-4">
                                                        <div class="relative overflow-hidden rounded-md group/project">
                                                            <img src="assets/images/blog/img-02.jpg" alt="" class="transition-all duration-300 ease-in-out group-hover/project:scale-110">
                                                            <div class="transition-all duration-300 ease-in-out group-hover/project:bg-black/40 group-hover/project:absolute group-hover/project:inset-0"></div>
                                                            <div class="absolute top-[50%] left-[50%] -translate-x-5 -translate-y-5 group-hover/project:block hidden transition-all duration-300 ease-in-out text-2xl">
                                                                <a href="assets/images/blog/img-02.jpg" class="text-white image-popup" data-title="Project Explained" data-description="There are many variations of passages of available, but the majority alteration in some form."><i class="uil uil-search-alt"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-span-4">
                                                        <div class="relative overflow-hidden rounded-md group/project">
                                                            <img src="assets/images/blog/img-03.jpg" alt="" class="transition-all duration-300 ease-in-out group-hover/project:scale-110">
                                                            <div class="transition-all duration-300 ease-in-out group-hover/project:bg-black/40 group-hover/project:absolute group-hover/project:inset-0"></div>
                                                            <div class="absolute top-[50%] left-[50%] -translate-x-5 -translate-y-5 group-hover/project:block hidden transition-all duration-300 ease-in-out text-2xl">
                                                                <a href="assets/images/blog/img-03.jpg" class="text-white image-popup" data-title="Social Geek Made" data-description="There are many variations of passages of available, but the majority alteration in some form."><i class="uil uil-search-alt"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> -->
                                            <Comment
                                                :comments="props.user.received_comments"
                                            />
                                        </div>
                                        


                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

      </Layout>
</template>
