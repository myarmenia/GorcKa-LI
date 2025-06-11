<!-- SubCategoryTags.vue -->
<script setup>
import { defineProps } from 'vue'

const props = defineProps({
    subCategories: Array,
    withRemove: {
        type: Boolean,
        default: false
    },
    onRemove: {
        type: Function,
        default: null
    }
})
</script>

<template>
    <div class="flex flex-wrap gap-2">
        <span
            v-for="sub in subCategories"
            :key="sub.id"
            class="mt-2 text-13 px-3 py-2  rounded font-medium space-x-2"
            :class="`bg-${sub.color}-500/20 text-${sub.color}-500`"
        >
        <span>{{ sub.name }}</span>
        <button
            v-if="withRemove && onRemove"
            @click="onRemove(sub.id)"
            class="text-blue-600 hover:text-blue-800 text-13"
        >
            &times;
        </button>
        </span>
    </div>
</template>
