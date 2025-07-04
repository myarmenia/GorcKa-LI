<script setup>
import { useTrans } from '/resources/js/trans';
import dayjs from 'dayjs';

const props = defineProps({
    comments: Array
});


</script>

<template>
    <div v-if="(Array.isArray(props.comments) && props.comments.length > 0)">
        <div
            v-for="(comment, index) in props.comments"
            :key="comment.id"
            class="p-4 border border-gray-100/50 rounded-md relative hover:-translate-y-1.5 transition-all duration-500 ease-in-out group-data-[theme-color=violet]:hover:border-violet-500 group-data-[theme-color=sky]:hover:border-sky-500 group-data-[theme-color=red]:hover:border-red-500 group-data-[theme-color=green]:hover:border-green-500 group-data-[theme-color=pink]:hover:border-pink-500 group-data-[theme-color=blue]:hover:border-blue-500 hover:shadow-md hover:shadow-gray-100/30 dark:border-neutral-600 dark:hover:shadow-neutral-900"
        >
            <div class="sm:flex">
                <div class="shrink-0">
                    <img class="w-16 h-16 p-1 border-2 rounded-full border-gray-100/50" src="assets/images/user/img-04.jpg" alt="img">
                </div>
                <div class="grow ltr:ml-3 rtl:mr-3">
                    <div>
                        <p class="mb-2 text-sm text-gray-500 ltr:float-right rtl:float-left dark:text-gray-300"> {{dayjs(comment.created_at).format('DD.MM.YYYY')}}</p>
                        <h6 class="text-gray-900 dark:text-gray-50">{{comment.author.name}}</h6>
                        <div class="flex items-center gap-1 mb-4">
                            <span
                                v-for="n in 5"
                                :key="n"
                                class="cursor-pointer text-2xl"
                                :class="comment.mark >= n ? 'text-yellow-400' : 'text-gray-300'"
                            >
                                ★
                            </span>
                        </div>
                        <p class="mt-3 italic text-gray-500 dark:text-gray-300">{{ comment.description }}</p>
                    </div>
                    <div>
                        <p v-if="comment.task">Task name: {{ comment.task.title }}</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div v-else class="space-y-8 text-center">{{ useTrans('page.comments.no_result') }}</div>


</template>

