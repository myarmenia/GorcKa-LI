<script setup>
import Layout from '@/Layouts/User/Layout.vue';
import { defineProps } from 'vue'
import UserInfo from './UserInfo.vue';

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
console.log(props.user,'4444')
console.log(props.categories,"categories")


// =====
// const getUserTranslatedSubCategories = computed(() => {
//   const result = [];

//   props.user.sub_categories.forEach(userSub => {
//     // Найти категорию
//     const category = props.categories.find(cat =>
//       cat.id === userSub.category_id
//     );

//     if (category) {
//       // Найти sub_category внутри этой категории
//       const subCategory = category.sub_categories.find(sc => sc.id === userSub.id);

//       if (subCategory) {
//         // Найти перевод
//         const translation = subCategory.item_translations?.find(
//           t => t.locale === currentLocale.value
//         );

//         result.push({
//           id: subCategory.id,
//           name: translation?.name ?? '-',
//           category_name: category.name,
//           color: category.color,
//         });
//       }
//     }
//   });

//   return result;
// });


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
                                            <h6 class="mb-3 font-semibold text-gray-900 text-17 dark:text-gray-50">Professional Skills</h6>
                                            <!-- <div class="flex flex-wrap gap-2">
                                                <span class="px-2 py-1 font-medium text-green-500 rounded bg-green-400/20 text-13">User Interface Design</span>
                                                <span class="px-2 py-1 font-medium text-green-500 rounded bg-green-400/20 text-13">Web Design</span>
                                                <span class="px-2 py-1 font-medium text-green-500 rounded bg-green-400/20 text-13">Responsive Design</span>
                                                <span class="px-2 py-1 font-medium text-green-500 rounded bg-green-400/20 text-13">Mobile App Design</span>
                                                <span class="px-2 py-1 font-medium text-green-500 rounded bg-green-400/20 text-13">UI Design</span>
                                            </div> -->

                                            <!-- <ul>
                                                <li v-for="sub in getUserTranslatedSubCategories" :key="sub.id">
                                                    <span :style="{ color: sub.color }">
                                                    {{ sub.category_name }} — {{ sub.name }}
                                                    </span>
                                                </li>
                                            </ul> -->
                                        </div>
                                        <div class="p-5">
                                            <h6 class="mb-3 font-semibold text-gray-900 text-17 dark:text-gray-50">Contact Details</h6>
                                            <ul>
                                                <li>
                                                    <div class="flex items-center mt-4">
                                                        <div class="group-data-[theme-color=violet]:bg-violet-500/20 group-data-[theme-color=sky]:bg-sky-500/20 group-data-[theme-color=red]:bg-red-500/20 group-data-[theme-color=green]:bg-green-500/20 group-data-[theme-color=pink]:bg-pink-500/20 group-data-[theme-color=blue]:bg-blue-500/20 h-11 w-11 text-xl text-center leading-[2.3] rounded-full group-data-[theme-color=violet]:text-violet-500 group-data-[theme-color=sky]:text-sky-500 group-data-[theme-color=red]:text-red-500 group-data-[theme-color=green]:text-green-500 group-data-[theme-color=pink]:text-pink-500 group-data-[theme-color=blue]:text-blue-500">
                                                            <i class="uil uil-envelope-alt"></i>
                                                        </div>
                                                        <div class="ltr:ml-3 rtl:mr-3">
                                                            <h6 class="mb-1 text-gray-900 text-14 dark:text-gray-50">Email</h6>
                                                            <p class="text-gray-500 dark:text-gray-300">gabrielpalmer@gmail.com</p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="flex items-center mt-4">
                                                        <div class="group-data-[theme-color=violet]:bg-violet-500/20 group-data-[theme-color=sky]:bg-sky-500/20 group-data-[theme-color=red]:bg-red-500/20 group-data-[theme-color=green]:bg-green-500/20 group-data-[theme-color=pink]:bg-pink-500/20 group-data-[theme-color=blue]:bg-blue-500/20 h-11 w-11 text-xl text-center leading-[2.3] rounded-full group-data-[theme-color=violet]:text-violet-500 group-data-[theme-color=sky]:text-sky-500 group-data-[theme-color=red]:text-red-500 group-data-[theme-color=green]:text-green-500 group-data-[theme-color=pink]:text-pink-500 group-data-[theme-color=blue]:text-blue-500">
                                                            <i class="uil uil-map-marker"></i>
                                                        </div>
                                                        <div class="ltr:ml-3 rtl:mr-3">
                                                            <h6 class="mb-1 text-gray-900 text-14 dark:text-gray-50">Address</h6>
                                                            <p class="text-gray-500 dark:text-gray-300">Dodge City, Louisiana</p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="flex items-center mt-4">
                                                        <div class="group-data-[theme-color=violet]:bg-violet-500/20 group-data-[theme-color=sky]:bg-sky-500/20 group-data-[theme-color=red]:bg-red-500/20 group-data-[theme-color=green]:bg-green-500/20 group-data-[theme-color=pink]:bg-pink-500/20 group-data-[theme-color=blue]:bg-blue-500/20 h-11 w-11 text-xl text-center leading-[2.3] rounded-full group-data-[theme-color=violet]:text-violet-500 group-data-[theme-color=sky]:text-sky-500 group-data-[theme-color=red]:text-red-500 group-data-[theme-color=green]:text-green-500 group-data-[theme-color=pink]:text-pink-500 group-data-[theme-color=blue]:text-blue-500">
                                                            <i class="uil uil-phone"></i>
                                                        </div>
                                                        <div class="ltr:ml-3 rtl:mr-3">
                                                            <h6 class="mb-1 text-gray-900 text-14 dark:text-gray-50">Phone</h6>
                                                            <p class="text-gray-500 dark:text-gray-300">+1(452) 125-6789</p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="flex items-center mt-4">
                                                        <div class="group-data-[theme-color=violet]:bg-violet-500/20 group-data-[theme-color=sky]:bg-sky-500/20 group-data-[theme-color=red]:bg-red-500/20 group-data-[theme-color=green]:bg-green-500/20 group-data-[theme-color=pink]:bg-pink-500/20 group-data-[theme-color=blue]:bg-blue-500/20 h-11 w-11 text-xl text-center leading-[2.3] rounded-full group-data-[theme-color=violet]:text-violet-500 group-data-[theme-color=sky]:text-sky-500 group-data-[theme-color=red]:text-red-500 group-data-[theme-color=green]:text-green-500 group-data-[theme-color=pink]:text-pink-500 group-data-[theme-color=blue]:text-blue-500">
                                                            <i class="uil uil-skype-alt"></i>
                                                        </div>
                                                        <div class="ltr:ml-3 rtl:mr-3">
                                                            <h6 class="mb-1 text-gray-900 text-14 dark:text-gray-50">Skype</h6>
                                                            <p class="text-gray-500 dark:text-gray-300">@gabrielpalmer</p>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                 <!-- <Info
                                        :user="props.user"
                                        :locations="locations"
                                        :socialMedias="props.socialMedias"
                                    /> -->
                                </div>
                                <div class="col-span-12 lg:col-span-8">
                                    <div class="p-6 border rounded border-gray-100/50 dark:border-neutral-600">
                                        <div>
                                            <h6 class="mb-3 text-gray-900 text-17 dark:text-gray-50">About Me</h6>
                                            <p class="mb-2 text-gray-500 dark:text-gray-300">Very well thought out and articulate communication. Clear milestones, deadlines and fast work. Patience. Infinite patience. No
                                                        shortcuts. Even if the client is being careless. Some quick example text to build on the card title and bulk the card's content Moltin gives you platform.</p>

                                            <p class="mb-0 text-gray-500 dark:text-gray-300">As a highly skilled and successfull product development and design specialist with more than 4 Years of My experience lies in successfully conceptualizing, designing, and modifying consumer products specific to interior design and home furnishings.</p>
                                        </div>
                                        <div class="pt-5">
                                            <h6 class="mb-0 text-gray-900 text-17 fw-bold dark:text-gray-50">Education</h6>
                                            <div class="relative flex mt-4">
                                                <div class="h-8 w-8 text-center leading-[2.2] group-data-[theme-color=violet]:bg-violet-500/20 group-data-[theme-color=sky]:bg-sky-500/20 group-data-[theme-color=red]:bg-red-500/20 group-data-[theme-color=green]:bg-green-500/20 group-data-[theme-color=pink]:bg-pink-500/20 group-data-[theme-color=blue]:bg-blue-500/20 group-data-[theme-color=violet]:text-violet-500 group-data-[theme-color=sky]:text-sky-500 group-data-[theme-color=red]:text-red-500 group-data-[theme-color=green]:text-green-500 group-data-[theme-color=pink]:text-pink-500 group-data-[theme-color=blue]:text-blue-500 shrink-0 rounded-full font-medium text-violet-500"> B </div>
                                                <div class="after:contant[''] after:border after:absolute after:h-24 ltr:after:left-4 rtl:after:right-4 after:top-10 after:border-dashed group-data-[theme-color=violet]:after:border-violet-500/30 group-data-[theme-color=sky]:after:border-sky-500/30 group-data-[theme-color=red]:after:border-red-500/30 group-data-[theme-color=green]:after:border-green-500/30 group-data-[theme-color=pink]:after:border-pink-500/30 group-data-[theme-color=blue]:after:border-blue-500/30 hidden md:block"></div>
                                                <div class="space-y-6 ltr:ml-4 rtl:mr-4">
                                                    <div>
                                                        <h6 class="mb-1 text-gray-900 text-16 dark:text-gray-50">BCA - Bachelor of Computer Applications</h6>
                                                        <p class="mb-2 text-gray-500 dark:text-gray-300">International University - (2004 - 2010)</p>
                                                        <p class="text-gray-500 dark:text-gray-300">There are many variations of passages of available, but the majority alteration in some form. As a highly skilled and successfull product development and design specialist with more than 4 Years of My experience.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="relative flex mt-8">
                                                <div class="h-8 w-8 text-center leading-[2.2] group-data-[theme-color=violet]:bg-violet-500/20 group-data-[theme-color=sky]:bg-sky-500/20 group-data-[theme-color=red]:bg-red-500/20 group-data-[theme-color=green]:bg-green-500/20 group-data-[theme-color=pink]:bg-pink-500/20 group-data-[theme-color=blue]:bg-blue-500/20 group-data-[theme-color=violet]:text-violet-500 group-data-[theme-color=sky]:text-sky-500 group-data-[theme-color=red]:text-red-500 group-data-[theme-color=green]:text-green-500 group-data-[theme-color=pink]:text-pink-500 group-data-[theme-color=blue]:text-blue-500 shrink-0 rounded-full font-medium text-violet-500"> M </div>
                                                <div class="after:contant[''] after:border after:absolute after:h-24 ltr:after:left-4 rtl:after:right-4 after:top-10 after:border-dashed group-data-[theme-color=violet]:after:border-violet-500/30 group-data-[theme-color=sky]:after:border-sky-500/30 group-data-[theme-color=red]:after:border-red-500/30 group-data-[theme-color=green]:after:border-green-500/30 group-data-[theme-color=pink]:after:border-pink-500/30 group-data-[theme-color=blue]:after:border-blue-500/30 hidden md:block"></div>
                                                <div class="space-y-6 ltr:ml-4 rtl:mr-4">
                                                    <div>
                                                        <h6 class="mb-1 text-gray-900 text-16 dark:text-gray-50">MCA - Master of Computer Application</h6>
                                                        <p class="mb-2 text-gray-500 dark:text-gray-300">International University - (2010 - 2012)</p>
                                                        <p class="text-gray-500 dark:text-gray-300">There are many variations of passages of available, but the majority alteration in some form. As a highly skilled and successfull product development and design specialist with more than 4 Years of My experience.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex mt-8">
                                                <div class="h-8 w-8 text-center leading-[2.2] group-data-[theme-color=violet]:bg-violet-500/20 group-data-[theme-color=sky]:bg-sky-500/20 group-data-[theme-color=red]:bg-red-500/20 group-data-[theme-color=green]:bg-green-500/20 group-data-[theme-color=pink]:bg-pink-500/20 group-data-[theme-color=blue]:bg-blue-500/20 group-data-[theme-color=violet]:text-violet-500 group-data-[theme-color=sky]:text-sky-500 group-data-[theme-color=red]:text-red-500 group-data-[theme-color=green]:text-green-500 group-data-[theme-color=pink]:text-pink-500 group-data-[theme-color=blue]:text-blue-500 shrink-0 rounded-full font-medium text-violet-500"> M </div>
                                                <div class="space-y-6 ltr:ml-4 rtl:mr-4">
                                                    <div>
                                                        <h6 class="mb-1 text-gray-900 text-16 dark:text-gray-50">Design Communication Visual</h6>
                                                        <p class="mb-2 text-gray-500 dark:text-gray-300">International University - (2012-2015)</p>
                                                        <p class="text-gray-500 dark:text-gray-300">There are many variations of passages of available, but the majority alteration in some form. As a highly skilled and successfull product development and design specialist with more than 4 Years of My experience.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                         <div class="pt-10">
                                            <h6 class="mb-0 text-gray-900 text-17 fw-bold dark:text-gray-50">Experience</h6>
                                            <div class="relative flex mt-4">
                                                <div class="h-8 w-8 text-center leading-[2.2] group-data-[theme-color=violet]:bg-violet-500/20 group-data-[theme-color=sky]:bg-sky-500/20 group-data-[theme-color=red]:bg-red-500/20 group-data-[theme-color=green]:bg-green-500/20 group-data-[theme-color=pink]:bg-pink-500/20 group-data-[theme-color=blue]:bg-blue-500/20 group-data-[theme-color=violet]:text-violet-500 group-data-[theme-color=sky]:text-sky-500 group-data-[theme-color=red]:text-red-500 group-data-[theme-color=green]:text-green-500 group-data-[theme-color=pink]:text-pink-500 group-data-[theme-color=blue]:text-blue-500 shrink-0 rounded-full font-medium text-violet-500"> W </div>
                                                <div class="after:contant[''] after:border after:absolute after:h-24 ltr:after:left-4 rtl:after:right-4 after:top-10 after:border-dashed group-data-[theme-color=violet]:after:border-violet-500/30 group-data-[theme-color=sky]:after:border-sky-500/30 group-data-[theme-color=red]:after:border-red-500/30 group-data-[theme-color=green]:after:border-green-500/30 group-data-[theme-color=pink]:after:border-pink-500/30 group-data-[theme-color=blue]:after:border-blue-500/30 hidden md:block"></div>
                                                <div class="space-y-6 ltr:ml-4 rtl:mr-4">
                                                    <div>
                                                        <h6 class="mb-1 text-gray-900 text-16 dark:text-gray-50">Web Design &amp; Development Team Leader</h6>
                                                        <p class="mb-2 text-gray-500 dark:text-gray-300">Creative Agency - (2013 - 2016)</p>
                                                        <p class="text-gray-500 dark:text-gray-300">There are many variations of passages of available, but the majority alteration in some form. As a highly skilled and successfull product development and design specialist with more than 4 Years of My experience.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex mt-8">
                                                <div class="h-8 w-8 text-center leading-[2.2] group-data-[theme-color=violet]:bg-violet-500/20 group-data-[theme-color=sky]:bg-sky-500/20 group-data-[theme-color=red]:bg-red-500/20 group-data-[theme-color=green]:bg-green-500/20 group-data-[theme-color=pink]:bg-pink-500/20 group-data-[theme-color=blue]:bg-blue-500/20 group-data-[theme-color=violet]:text-violet-500 group-data-[theme-color=sky]:text-sky-500 group-data-[theme-color=red]:text-red-500 group-data-[theme-color=green]:text-green-500 group-data-[theme-color=pink]:text-pink-500 group-data-[theme-color=blue]:text-blue-500 shrink-0 rounded-full font-medium text-violet-500"> P </div>
                                                <div class="space-y-6 ltr:ml-4 rtl:mr-4">
                                                    <div>
                                                        <h6 class="mb-1 text-gray-900 text-16 dark:text-gray-50">Project Manager</h6>
                                                        <p class="mb-2 text-gray-500 dark:text-gray-300">Jobcy Technology Pvt.Ltd - (Pressent)</p>
                                                        <p class="text-gray-500 dark:text-gray-300">There are many variations of passages of available, but the majority alteration in some form. As a highly skilled and successfull product development and design specialist with more than 4 Years of My experience.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                         <div class="pt-10">
                                            <h6 class="mb-0 text-gray-900 text-17 fw-bold dark:text-gray-50">Projects</h6>
                                            <div class="mt-4 ">
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
                                            </div>
                                        </div>
                                        <div class="pt-3 mt-4">
                                            <div class="sm:flex">
                                                <div class="shrink-0">
                                                    <img class="w-16 h-16 p-1 border-2 rounded-full border-gray-100/50" src="assets/images/user/img-04.jpg" alt="img">
                                                </div>
                                                <div class="grow ltr:ml-3 rtl:mr-3">
                                                    <div>
                                                        <p class="mb-2 text-sm text-gray-500 ltr:float-right rtl:float-left dark:text-gray-300">Jun 23, 2021</p>
                                                        <h6 class="text-gray-900 dark:text-gray-50">Michelle Durant</h6>
                                                        <div class="text-yellow-500 text-17">
                                                            <i class="mdi mdi-star"></i>
                                                            <i class="mdi mdi-star"></i>
                                                            <i class="mdi mdi-star"></i>
                                                            <i class="mdi mdi-star"></i>
                                                            <i class="mdi mdi-star-half-full"></i>
                                                        </div>
                                                        <p class="mt-3 italic text-gray-500 dark:text-gray-300">" There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour "</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-6 sm:flex">
                                                <div class="flex-shrink-0">
                                                    <img class="w-16 h-16 p-1 border-2 rounded-full border-gray-100/50" src="assets/images/user/img-02.jpg" alt="img">
                                                </div>
                                                <div class="grow ltr:ml-3 rtl:mr-3">
                                                    <div>
                                                        <p class="mb-2 text-sm text-gray-500 ltr:float-right rtl:float-left dark:text-gray-300">Jun 25, 2021</p>
                                                        <h6 class="text-gray-900 dark:text-gray-50">Jeffrey Montgomery</h6>
                                                        <div class="text-yellow-500 text-17">
                                                            <i class="mdi mdi-star"></i>
                                                            <i class="mdi mdi-star"></i>
                                                            <i class="mdi mdi-star"></i>
                                                            <i class="mdi mdi-star-half-full"></i>
                                                            <i class="mdi mdi-star-outline"></i>
                                                        </div>
                                                        <p class="mt-3 italic text-gray-500 dark:text-gray-300">" There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour "</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-5">
                                            <form action="#">
                                                <h6 class="font-semibold text-gray-900 text-17 dark:text-gray-50">Add a review</h6>
                                                <p class="mb-5 text-gray-500 dark:text-gray-300">Your Rating for this listing</p>
                                                <div class="grid grid-cols-12 gap-4">
                                                    <div class="col-span-12">
                                                        <div class="mb-3">
                                                            <label for="inputname" class="text-sm text-gray-900 dark:text-gray-50">Your Name</label>
                                                            <input type="text" class="w-full mt-1 rounded border-gray-100/50 placeholder:text-13 placeholder:text-gray-200 dark:bg-transparent dark:border-neutral-600 dark:text-gray-300 focus:ring-0 focus:ring-offset-0" id="inputname" placeholder="Enter your name">
                                                        </div>
                                                    </div><!--end col-->
                                                    <div class="col-span-12 lg:col-span-6">
                                                        <div class="mb-3">
                                                            <label for="inputemail" class="text-sm text-gray-900 dark:text-gray-50">Email</label>
                                                            <input type="email" class="w-full mt-1 rounded border-gray-100/50 placeholder:text-13 placeholder:text-gray-200 dark:bg-transparent dark:border-neutral-600 dark:text-gray-300 focus:ring-0 focus:ring-offset-0" id="inputemail" placeholder="Enter your email">
                                                        </div>
                                                    </div><!--end col-->
                                                    <div class="col-span-12 lg:col-span-6">
                                                        <div class="mb-3">
                                                            <label for="inputsubject" class="text-sm text-gray-900 dark:text-gray-50">Subject</label>
                                                            <input type="text" class="w-full mt-1 rounded border-gray-100/50 placeholder:text-13 placeholder:text-gray-200 dark:bg-transparent dark:border-neutral-600 dark:text-gray-300 focus:ring-0 focus:ring-offset-0" id="inputsubject" placeholder="Subject">
                                                        </div>
                                                    </div><!--end col-->
                                                    <div class="col-span-12">
                                                        <div class="mb-3">
                                                            <label for="inputcoment" class="text-sm text-gray-900 dark:text-gray-50">Review</label>
                                                            <textarea class="w-full mt-1 rounded border-gray-100/50 placeholder:text-13 placeholder:text-gray-200 dark:bg-transparent dark:border-neutral-600 dark:text-gray-300 focus:ring-0 focus:ring-offset-0" id="inputcoment" rows="3" placeholder="Add your review"></textarea>
                                                        </div>
                                                    </div><!--end col-->
                                                </div><!--end row-->
                                                <div class="text-end">
                                                    <button type="submit" class="text-white transition-all duration-500 ease-in-out border-transparent btn group-data-[theme-color=violet]:bg-violet-500 group-data-[theme-color=sky]:bg-sky-500 group-data-[theme-color=red]:bg-red-500 group-data-[theme-color=green]:bg-green-500 group-data-[theme-color=pink]:bg-pink-500 group-data-[theme-color=blue]:bg-blue-500 hover:-translate-y-2">Submit Review <i class="uil uil-angle-right-b"></i></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

      </Layout>
</template>
