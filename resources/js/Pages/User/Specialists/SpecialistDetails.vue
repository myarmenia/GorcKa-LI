<script setup>
import Layout from '@/Layouts/User/Layout.vue';
import { defineProps, computed } from 'vue'
import UserInfo from '@/Components/UserInfo.vue';
import { useTrans } from '@/trans';
import PreferredCategories from '@/Components/PreferredCategories.vue';
import ContactDetails from '@/Components/ContactDetails.vue';
import Comment from '@/Components/Comment.vue';
import UserWorks from '@/Components/UserWorks.vue';

const props = defineProps({
  locale: String,
  user: Object,
  socialMedias:Array,
  categories:Array,

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
                                            <h6 class="mb-0 text-gray-900 text-17 fw-bold dark:text-gray-50">{{ useTrans('page.comments') }}</h6>
                                            <Comment
                                                :comments="props.user.received_comments"
                                            />
                                        </div>
                                         <div class="pt-10">
                                            <UserWorks
                                               :files="props.user.files"
                                            />
                                         </div>



                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

      </Layout>
</template>
