<script setup>
import '../../../public/assets/user/css/preline-select.css';
import { ref, onMounted, watch, computed } from 'vue';
import { useTrans } from '/resources/js/trans';

import HSSelect from '../../../node_modules/preline/dist/select';

// Пропсы для компонента

const props = defineProps({
  modelValue: [String, Number],
  id: String,
  label: String,
  name: String,
  options: Array, // список объектов { value, text }
  value: [String, Number],
  disabled: Boolean,
  error: String, // сообщение об ошибке
  autoSelectFirst: Boolean,
});


// Эмитим обновление модели (v-model)
// const emit = defineEmits(['update:modelValue']);
const selected = ref(props.value ?? (props.autoSelectFirst && props.options?.length ? props.options[0].value : ''));

watch(() => props.value, (newValue) => {
  selected.value = newValue;
});


// watch(selected, (newValue) => {
//   emit('update:value', newValue);
// });

// const selectRef = ref(null);

onMounted(() => {

   const selectElement = document.querySelector('[data-hs-select]');
  if (selectElement) {
    new HSSelect(selectElement); // Пример инициализации плагина
  }
});

// Настройки для использования HS Select
const hsSelectOptions = {
  hasSearch: true,
  isSearchDirectMatch: false,
  searchPlaceholder: "Search...",
  searchPlaceholder: true,
  searchClasses: "block w-full text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 py-2 px-3",
  searchWrapperClasses: "bg-white p-2 -mx-1 sticky top-0 dark:bg-neutral-900",
  placeholder: useTrans('form.select_placeholder'),
  toggleTag: "<button type=\"button\" aria-expanded=\"false\"></button>",
  toggleClasses: "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 ps-4 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-neutral-600",
  dropdownClasses: "mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 dark:bg-neutral-900 dark:border-neutral-700",
  optionClasses: "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800",
  optionTemplate: "<div class=\"flex items-center\"><div class=\"me-2\" data-icon></div><div><div class=\"hs-selected:font-semibold text-sm text-gray-800 \" data-title></div></div><div class=\"ms-auto\"><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-4 text-blue-600\" xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" viewBox=\"0 0 16 16\"><path d=\"M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z\"/></svg></span></div></div>",
  extraMarkup: "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
};

const searchQuery = ref("");

// Метод для фильтрации опций по запросу
const filteredOptions = computed(() => {
  return props.options.filter(option => {
    return option.text.toLowerCase().includes(searchQuery.value.toLowerCase());
  });
});
</script>

<template>
  <div class="">
      <select
      v-model="selected"
      class="hs-select hidden"
      :name="name"
      :disabled="disabled"
      :data-hs-select="JSON.stringify(hsSelectOptions)"
    >
      <option v-for="(option, index) in filteredOptions" :key="index" :value="option.value" class="pl-2">
        {{ option.text }}
      </option>
    </select>
    <span v-if="error" class="text-red-600 text-sm">{{ error }}</span>
  </div>
</template>
