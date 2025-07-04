<script setup>
import { ref, watch, onMounted } from "vue";
import { Head, router, Link } from '@inertiajs/vue3';
import dayjs from 'dayjs';
import Index from '../Index.vue';
import Comment from '@/Components/Comment.vue'

const props = defineProps({
  comments: {
    type: Object,
    default: () => ({
      data: [],
      links: []
    })
  }

});


const localComments = ref([...props.comments.data]);
const paginationLinks = ref([...props.comments.links]);

console.log(props.comments.data, 'ddddddddddddd')
watch(
  () => props.comments,
  (newVal) => {
    localComments.value = [...newVal.data];
    paginationLinks.value = [...newVal.links];
  },
  { deep: true }
);



// Пагинация через Inertia
const changePage = (url) => {
    if (!url ) return;

  router.get(url, {}, {
    // preserveState: true,
    preserveScroll: false,
    only: ['notifications'],
    onFinish: () => {
    }
  });
};

</script>

<template>
  <Index>
    <Head title="Comments" />

    <template #content>
        <section class="py-16 m-6">
            <div class="container mx-auto">

            <div class="mt-5 flex justify-between">
                <h4 class=" text-gray-900 fs-16 dark:text-gray-50">Comments </h4>
            </div>

            <div class="mt-8 space-y-6">

                <Comment :comments="localComments"  />

                <div v-if="localComments.length === 0" class="text-center py-10">
                <p class="text-gray-500">No comments found</p>
                </div>
            </div>

            <!-- Пагинация -->
            <div class="grid grid-cols-12 mt-8" v-if="paginationLinks.length > 3">
                <div class="col-span-12">
                    <ul class="flex justify-center gap-2 mt-8">
                        <li v-for="(link,index) in paginationLinks"
                            :key="index"
                            :class="{active: link.active, disabled: !link.url, 'group-data-[theme-color=green]:bg-green-500 text-white': link.active, 'group-data-[theme-color=green]:bg-gray-200 ': !link.url }"
                            @click=" changePage(link.url)"
                            class="w-12 h-12 text-center text-gray-900 transition-all duration-300 border rounded cursor-pointer border-gray-100/50 hover:bg-green-100/30 focus:bg-gray-100/30 dark:border-gray-100/20 dark:text-gray-50 dark:hover:bg-gray-500/20">
                                <span class="text-16 leading-[2.8]" v-html="link.label"></span> <!-- Use v-html to render HTML -->
                        </li>
                    </ul>
                </div>
            </div>
            </div>
        </section>
    </template>

  </Index>
</template>

