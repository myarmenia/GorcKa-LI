<script setup>
import { ref, watch, defineExpose} from 'vue';
import axios from 'axios';
import { useTrans } from '/resources/js/trans';

const props = defineProps({
    model: String,
    route: String,
    options: Array,
    border: {
        type: Boolean,
        default: true, // По умолчанию границы есть
    }
});

const search = ref('');
const isOpen = ref(false); // Состояние, контролирующее открытие/закрытие списка
const filteredOptions = ref([]); // Начально пустой массив

const emit = defineEmits(['update:modelValue']);

// Следим за изменениями props.options и обновляем filteredOptions
watch(() => props.options, (newOptions) => {
    filteredOptions.value = newOptions ?? [];
}, { immediate: true });


const searchItems = async () => {

    if (search.value.length < 2) {
        filteredOptions.value = props.options; // Показываем все опции, если запрос пустой или меньше 2 символов
        return;
    }

    try {
        const response = await axios.get(`/${props.route}/${search.value}`);

        filteredOptions.value = response.data.map(item => ({
            value: item.id,
            text: item.name
        }));
    } catch (error) {
        console.error('Error fetching search results:', error);
    }
};

const selectOption = (option) => {
    search.value = option.text;
    emit('update:modelValue', option.value); // Передаем ID в v-model
    isOpen.value = false; // Закрываем список после выбора
};


const handleBlur = () => {
    // Закрыть список при потере фокуса, с задержкой, чтобы успеть кликнуть на элемент
    setTimeout(() => {
        isOpen.value = false;
    }, 200);
};

// Следим за очисткой поля
watch(search, (newValue) => {
    if (!newValue.length) {
        emit('update:modelValue', null); // Отправляем null
        filteredOptions.value = props.options;
    }
});


// Метод для очистки поиска
const clearSearch = () => {
  search.value = ''; // Очистить поле ввода
};

// add search input text before change language
const addInputText = (inputText) => {
    search.value = inputText;
};


defineExpose({ clearSearch, addInputText });

</script>

<template>
    <div class="relative w-full">
        <!-- Обертка для поля ввода и выпадающего списка -->
        <div class="relative">
            <!-- Поле ввода -->
            <input
                v-model="search"
                @input="searchItems"
                @focus="isOpen = true"
                @blur="handleBlur"
                type="text"
                :placeholder="useTrans('form.select_placeholder')"
                :class="border ? 'bordered ' : 'no-border '"
                class="filter-job-input-box w-full py-2 pl-5 pr-10 rounded border-gray-100 bg-white focus:outline-none input:outline-none"
            />

            <!-- Стрелка -->
            <div class="absolute top-0 right-0 flex items-center justify-center h-full pr-3 ">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                <path d="M1.5 5.5a.5.5 0 0 1 .708 0L8 10.793l5.793-5.793a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                </svg>
            </div>

            <!-- Выпадающий список -->
            <div v-if="isOpen && (filteredOptions.length || !search.length)" class="absolute w-full mt-1 bg-white border border-gray-300 rounded shadow-lg z-10">
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
    </div>
</template>



<style scoped>
    /* Для стрелки */
    .bi-chevron-down {
        transition: transform 0.3s ease;
    }

    .bordered {
        border: 1px solid rgb(204 206 214 / 0.5) !important;
    }

    /* Без границы */
    .no-border {
        border: none !important;
    }

</style>
