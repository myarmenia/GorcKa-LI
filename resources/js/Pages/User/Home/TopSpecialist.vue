<script setup>
import { computed } from "vue";
import { useTrans } from '/resources/js/trans';
import { Head, Link } from '@inertiajs/vue3';
import { globalOnlineUsers } from '@/global/globalOnlineUsers';

console.log(globalOnlineUsers,888)
const props = defineProps({
  locale:"string",
  topSpecialistRating: Array
});
function isUserOnline(userId) {
  return globalOnlineUsers.value.some(u => u.id === userId);
}


function getStarData(mark) {
  const rating = parseFloat(mark);
  const fullStars = Math.floor(rating);
  const hasHalfStar = rating - fullStars >= 0.5;
  return { fullStars, hasHalfStar };
}


</script>
<template>
   <section class="py-20">
                        <div class="container mx-auto">
                            <div class="grid grid-cols-1 gap-5">
                                <div class="text-center">
                                    <h3 class="mb-3 text-3xl text-gray-900 dark:text-gray-50">{{useTrans('page.top_specialist_rating.h3')}}</h3>

                                </div>
                            </div>

                            <div class="mt-10">
                                <div class="grid grid-cols-12 gap-y-6 lg:gap-6">

                                    <div v-for="specialist in props.topSpecialistRating" :key="specialist.id" class="col-span-12 lg:col-span-4">
                                         <div class="relative p-5 border rounded-md border-gray-100/50 dark:border-neutral-600">

                                            <div class="flex mb-4">
                                                <div class="relative shrink-0">
                                                    <img :src="specialist.avatar_url" alt="" class="w-16 h-16 rounded">

                                                     <span :class="isUserOnline(specialist.id) ? 'bg-green-500' : 'bg-yellow-700/20'"
                                                                                                                class=" absolute h-3.5 w-3.5  border-2 border-white rounded-full -top-1  -right-1  dark:border-neutral-700"></span>
                                                </div>
                                                <div class="ltr:ml-3 rtl:mr-3">
                                                    <a href="candidate-details.html"><h5 class="mb-2 text-17 dark:text-white">{{ specialist.name }}</h5></a>

                                                </div>
                                            </div>

                                            <ul class="flex items-center justify-between">
                                                <li class="text-yellow-500 text-17">

                                                    <template v-for="n in 5" :key="n">
                                                        <i
                                                        v-if="n <= getStarData(specialist.average_mark).fullStars"
                                                        class="mdi mdi-star"
                                                        ></i>
                                                        <i
                                                        v-else-if="n === getStarData(specialist.average_mark).fullStars + 1 && getStarData(specialist.average_mark).hasHalfStar"
                                                        class="mdi mdi-star-half-full"
                                                        ></i>
                                                        <i
                                                        v-else
                                                        class="mdi mdi-star-outline"
                                                        ></i>
                                                    </template>
                                                </li>

                                            </ul>
                                            <div class="mt-4" >
                                                <p
                                                    class="text-gray-500 dark:text-gray-300 truncate w-64 min-h-[1.5rem]"
                                                    >
                                                    {{ specialist.description }}
                                                    </p>
                                            </div>

                                            <div class="mt-6">
                                                <Link :href="`/${props.locale}/specialist/${specialist.id}`"
                                                class="w-full mt-2 border-transparent btn group-data-[theme-color=violet]:bg-violet-500/20 group-data-[theme-color=sky]:bg-sky-500/20 group-data-[theme-color=red]:bg-red-500/20 group-data-[theme-color=green]:bg-green-500/20 group-data-[theme-color=pink]:bg-pink-500/20 group-data-[theme-color=blue]:bg-blue-500/20 group-data-[theme-color=violet]:text-violet-500 group-data-[theme-color=sky]:text-sky-500 group-data-[theme-color=red]:text-red-500 group-data-[theme-color=green]:text-green-500 group-data-[theme-color=pink]:text-pink-500 group-data-[theme-color=blue]:text-blue-500 hover:-translate-y-1 group-data-[theme-color=violet]:hover:bg-violet-500 group-data-[theme-color=violet]:hover:text-white group-data-[theme-color=sky]:hover:bg-sky-500 group-data-[theme-color=sky]:hover:text-white group-data-[theme-color=red]:hover:bg-red-500 group-data-[theme-color=red]:hover:text-white group-data-[theme-color=green]:hover:bg-green-500 group-data-[theme-color=green]:hover:text-white group-data-[theme-color=pink]:hover:bg-pink-500 group-data-[theme-color=pink]:hover:text-white group-data-[theme-color=blue]:hover:bg-blue-500 group-data-[theme-color=blue]:hover:text-white hover:ring group-data-[theme-color=violet]:hover:ring-violet-500/20 group-data-[theme-color=sky]:hover:ring-sky-500/20 group-data-[theme-color=red]:hover:ring-red-500/20 group-data-[theme-color=green]:hover:ring-green-500/20 group-data-[theme-color=pink]:hover:ring-pink-500/20 group-data-[theme-color=blue]:hover:ring-blue-500/20"
                                                ><i class="mdi mdi-eye"></i> {{ useTrans('page.top_specialist_rating.view_profile') }}</Link>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="grid grid-cols-1">
                                    <div class="mt-5 text-center">
                                        <Link :href="route('specialists', { locale: $page.props.locale })" class="text-white border-transparent group-data-[theme-color=green]:bg-green-500 btn hover:-translate-y-2">{{ useTrans('page.jobs.view_more') }} <i class="uil uil-arrow-right ms-1"></i></Link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
</template>
<style>
    .ellipsis {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
