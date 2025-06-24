
<script setup>
  import { computed, defineProps, defineEmits } from "vue";

  const props = defineProps({
    modelValue: [String, Number, null], // Значение, которое выбрано
    options: Array, // [{ value: 1, text: "Ереван" }, { value: 2, text: "Гюмри" }]
    id: String,
    label: String,
    placeholder: String,
    required: {
        type: Boolean,
        default: false,
    },
  });


  const emit = defineEmits(["update:modelValue"]);


  // Обновляем значение при изменении
  const selectedValue = computed({
    get: () => props.modelValue,
    set: (newValue) => emit("update:modelValue", newValue),
  });
  </script>

<template>
    <div>
      <label v-if="label" class="block text-sm font-medium text-gray-700">
        {{ label }}
         <span v-if="required" class="text-red-500">*</span>
      </label>
      <select
        :id="id"
        v-model="selectedValue"
        class="w-full mt-1 p-2 border rounded text-gray-500 dark:bg-transparent dark:border-neutral-600"
      >
        <option v-if="placeholder" value="" disabled>
          {{ placeholder }}
        </option>
        <option
          v-for="option in options"
          :key="option.value"
          :value="option.value"
        >
          {{ option.text }}
        </option>
      </select>
    </div>
  </template>

