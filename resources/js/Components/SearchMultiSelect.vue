<script setup>
import { ref, watch, onMounted, onUnmounted } from 'vue';
import { useTrans } from '/resources/js/trans';

const props = defineProps({
    modelValue: Array, // v-model
    options: Array, // [{ value: 1, text: "Category 1" }]
});

const emit = defineEmits(['update:modelValue']);

const search = ref('');
const isOpen = ref(false);
const selectedOptions = ref([]);
const filteredOptions = ref([...props.options]);

// Следим за изменением options
watch(() => props.options, (newOptions) => {
    filteredOptions.value = [...newOptions];
}, { immediate: true });

const searchItems = () => {
    filteredOptions.value = props.options.filter(option =>
        option.text.toLowerCase().includes(search.value.toLowerCase())
    );
};

const selectOption = (option) => {
    if (!selectedOptions.value.some(item => item.value === option.value)) {
        selectedOptions.value.push(option);
    }
    emit('update:modelValue', selectedOptions.value.map(item => item.value));
};

const removeOption = (option) => {
    selectedOptions.value = selectedOptions.value.filter(item => item.value !== option.value);
    emit('update:modelValue', selectedOptions.value.map(item => item.value));
};

const clickOutsideHandler = (event) => {
    if (!event.target.closest('.multi-select')) {
        isOpen.value = false;
    }
};

onMounted(() => document.addEventListener('click', clickOutsideHandler));
onUnmounted(() => document.removeEventListener('click', clickOutsideHandler));
</script>

<template>
    <div class="relative w-full multi-select ">
        <!-- Поле для поиска -->
        <div class="select-input relative w-full border border-gray-100 rounded bg-white pl-5 cursor-pointer" @click="isOpen = !isOpen">
            <div class="flex flex-wrap gap-1 pl-3">
                <!-- Выбранные элементы -->
                <span v-for="(option, index) in selectedOptions" :key="index"
                      class="bg-green-500 text-white px-2 py-1 m-1 rounded flex items-center">
                    {{ option.text }}
                    <button class=" ml-3 px-2 text-sm text-green border border-white rounded-md" @click.stop="removeOption(option)">X</button>
                </span>

                <!-- Поле поиска -->
                <input
                    v-model="search"
                    @input="searchItems"
                    @focus="isOpen = true"
                    type="text"
                    :placeholder="useTrans('form.select_placeholder')"
                    class="filter-job-input-box border border-white focus:outline-none input:outline-none flex-1 rounded pl-5 pr-10"
                />
                  <!-- Стрелка -->
                <div class="absolute top-0 right-0 flex items-center justify-center h-full pr-3 ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                        <path d="M1.5 5.5a.5.5 0 0 1 .708 0L8 10.793l5.793-5.793a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </div>
            </div>
        </div>
                    <!-- class="select-input filter-job-input-box w-full py-2 pl-5 pr-10 rounded border-gray-100 bg-white focus:outline-none input:outline-none" -->

        <!-- Выпадающий список -->
        <div v-if="isOpen" class="absolute w-full mt-1 bg-white border border-gray-300 rounded shadow-lg z-10">
            <div
                v-for="(option, index) in filteredOptions"
                :key="index"
                @click="selectOption(option)"
                class="cursor-pointer hover:bg-gray-100 px-3 py-2"
            >
                {{ option.text }}
            </div>
        </div>
    </div>
</template>

<style scoped>
.multi-select {
    position: relative;
}

.multi-select input {
    width: 100%;
    padding: 4px;
    outline: none;
}

.multi-select div {
    border-radius: 6px;
}

.select-input{
    border-color: rgb(204 206 214 / 0.5) !important;
}

</style>
