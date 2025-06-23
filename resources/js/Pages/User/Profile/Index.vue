<script setup>
import Layout from '@/Layouts/User/Layout.vue';
import { Head } from '@inertiajs/vue3';
import Sidebar from './Sidebar.vue';

const props = defineProps({
  title: {
    type: String,
    default: 'Index',
  }
});

</script>
<template>
    <Layout>
      <Head :title="props.title"  />
            <section class="py-20 mt-10">
                <div class="container mx-auto">
                    <div class="grid grid-cols-12 gap-y-10 lg:gap-10">
                        <Sidebar />

                        <div class="col-span-12 lg:col-span-10">
                            <div class="border rounded border-gray-100/50 dark:border-neutral-600 nav-tabs bottom-border-tab">
                                <slot name="content" ></slot>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
    </Layout>
</template>
