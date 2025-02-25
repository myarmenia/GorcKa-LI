<script setup>
import { defineEmits, ref, watch, onMounted  } from 'vue';
import { useTrans } from '/resources/js/trans';
// Импортируем Preline
// import 'preline';
// import 'preline';  // Для JavaScript
import '../../../node_modules/preline/dist/select'


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

const emit = defineEmits(['update:value']);

// Синхронизация выбранного значения с родительским компонентом
// const selected = ref(props.value ?? (props.autoSelectFirst && props.options?.length ? props.options[0].value : ''));

// watch(selected, (newValue) => {
//   emit('update:modelValue', newValue);
// });
console.log('Options:', props.options);

const selected = ref(props.value ?? (props.autoSelectFirst && props.options?.length ? props.options[0].value : ''));

watch(() => props.value, (newValue) => {
  selected.value = newValue;
});


watch(selected, (newValue) => {
  emit('update:value', newValue);
});



onMounted(() => {
//   Preline.init();
});

// Создаем объект настроек для hs-select
const hsSelectOptions = {
  hasSearch: true,
  isSearchDirectMatch: false,
  searchPlaceholder: 'Search...',
  searchClasses: 'block w-full text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 py-2 px-3',
  searchWrapperClasses: 'bg-white p-2 -mx-1 sticky top-0',
  placeholder: 'Select multiple options...',
  toggleTag: "<button type='button' aria-expanded='false'></button>",
  toggleClasses: 'hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 ps-4 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500',
  dropdownClasses: 'mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto',
  optionClasses: 'py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100',
  extraMarkup: "<div class='absolute top-1/2 end-3 -translate-y-1/2'><svg class='shrink-0 size-3.5 text-gray-500' xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'><path d='m7 15 5 5 5-5'/><path d='m7 9 5-5 5 5'/></svg></div>"
};
</script>

<template>
  <div>
    <label :for="id" class="block text-sm font-medium text-gray-700">{{ label }}</label>
    <select
      :id="id"
      v-model="selected"
      class="hs-select hidden"
      :name="name"
      :disabled="disabled"
      :data-hs-select="hsSelectOptions"
    >
      <!-- <option v-if="!autoSelectFirst" value="" disabled>{{ useTrans('form.select_placeholder') }}</option> -->
      <option v-for="(option, index) in options" :key="index" :value="option.value" >
        {{ option.text }}
      </option>
    </select>
    <span v-if="error" class="text-red-600 text-sm">{{ error }}</span>
  </div>
</template>
