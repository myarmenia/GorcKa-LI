<script setup>
defineProps({
  modelValue: String, // Значение textarea
  placeholder: String, // Плейсхолдер
  rows: {
    type: Number,
    default: 4 // Количество строк по умолчанию
  },
});

defineEmits(["update:modelValue"]); // Эмит для v-model
</script>

<template>
  <textarea
    :value="modelValue"
    @input="$emit('update:modelValue', $event.target.value)"
    :placeholder="placeholder"
    :rows="rows"
    class="w-full p-2 border rounded border-gray-300 dark:bg-gray-800 dark:border-gray-600"
  ></textarea>
</template>
