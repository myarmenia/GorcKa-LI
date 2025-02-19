<script setup>
import { onMounted, ref, defineProps, watch } from 'vue';

const props = defineProps({
    modelValue: {
        type: Array,
        default: () => [], // Default to an empty array
    },
});

const emit = defineEmits(['update:modelValue']); // Emit event for v-model binding

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

const handleFileChange = (event) => {
    const files = Array.from(event.target.files);
    emit('update:modelValue', files); // Emit the new value to the parent
};
</script>

<template>
    <div>
        <input
            type="file"
            class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            ref="input"
            @change="handleFileChange"
            multiple
        />
        <ul v-if="modelValue && modelValue.length > 0">
            <li v-for="(file, index) in modelValue" :key="index">{{ file.name }}</li>
        </ul>
    </div>
</template>
