<script setup>
import { defineEmits, ref, watch } from 'vue';

const props = defineProps({
  id: String,
  label: String,
  name: String,
  options: Array, // список объектов { value, text }
  value: [String, Number],
  disabled: Boolean,
  error: String, // сообщение об ошибке
});


const emit = defineEmits();

// Синхронизация выбранного значения с родительским компонентом
const selected = ref(props.value);

watch(selected, (newValue) => {
  emit('update:modelValue', newValue);
});
</script>

<template>
  <div>
    <label :for="id" class="block text-sm font-medium text-gray-700">{{ label }}</label>
    <select
      :id="id"
      v-model="selected"
      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
      :name="name"
      :disabled="disabled"
      required
    >
      <option value="" disabled>Select an option</option>
      <option v-for="(option, index) in options" :key="index" :value="option.value">
        {{ option.text }}
      </option>
    </select>
    <span v-if="error" class="text-red-600 text-sm">{{ error }}</span>
  </div>
</template>


