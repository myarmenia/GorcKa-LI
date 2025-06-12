
<script setup>
import axios from 'axios';

import PrimaryButton from "@/Components/PrimaryButton.vue";
import { computed, ref, defineProps, watch } from "vue";
import { useModalStore } from '@/Stores/modalStore'
import SubCategoryTags from './SubCategoryTags.vue'

const modal = useModalStore()

const props = defineProps({
    categories: Array,
    locale: String,
    selectedSubCategories: Array
});


const openCategories = ref([])
const selectedIds = ref(props.selectedSubCategories.map(sub => sub.id))
const selectedSubCategories = ref([])
const emit = defineEmits(['update:selectedSubCategories'])

watch(
    () => props.selectedSubCategories,
    (newValue) => {
        if (Array.isArray(newValue)) {
            selectedIds.value = newValue.map(sub => sub.id)

            // Строим selectedSubCategories с именами из дерева категорий
            selectedSubCategories.value = []

            newValue.forEach(sub => {
                // Ищем подкатегорию по ID в props.categories
                props.categories.forEach(category => {
                    const found = category.sub_categories.find(s => s.id === sub.id)
                    if (found) {
                        selectedSubCategories.value.push({
                            id: found.id,
                            name: found.name,
                            color: category.color
                        })
                    }
                })
            })
        }
    },
    { immediate: true }
)


// Метод: раскрыть/свернуть категорию
function toggleCategory(categoryId) {
    if (openCategories.value.includes(categoryId)) {
        openCategories.value = openCategories.value.filter(id => id !== categoryId)
    } else {
        openCategories.value.push(categoryId)
    }
}

// Метод: обновить список выбранных подкатегорий
function syncSelectedSubCategories() {
    selectedSubCategories.value = []

    props.categories.forEach(category => {
        category.sub_categories.forEach(sub => {
            if (selectedIds.value.includes(sub.id)) {
                selectedSubCategories.value.push({ id: sub.id, name: sub.name, color: category.color })
            }
        })
    })
}

// Метод: удалить подкатегорию
function removeSubCategory(subId) {
    selectedIds.value = selectedIds.value.filter(id => id !== subId)
    syncSelectedSubCategories()
}


function submitSelectedSubCategories() {

    axios.post('submit-subcategories', {
        sub_categories: selectedSubCategories.value
    })
    .then(response => {
        emit('update:selectedSubCategories', selectedSubCategories.value)
        modal.showSuccess('Успешно сохранено!')

    })
    .catch(error => {
        console.error('Ошибка при отправке:', error)
    })
}

</script>

<template>
    <div class="space-y-6">
        <!-- Теги выбранных подкатегорий -->

        <SubCategoryTags
            :subCategories="selectedSubCategories"
            :withRemove="true"
            :onRemove="removeSubCategory"
        />

        <!-- Категории и подкатегории -->
        <div class="space-y-4">
            <div
                v-for="category in categories"
                :key="category.id"
                class="border rounded shadow"
            >
                <button
                    @click="toggleCategory(category.id)"
                    class="w-full text-left p-4 bg-green-500/20 text-green-600 hover:bg-green-500 hover:text-white flex justify-between items-center font-medium"
                >
                    <span>{{ category.name }}</span>
                    <svg
                        :class="{ 'rotate-180': openCategories.includes(category.id) }"
                        class="w-4 h-4 transition-transform"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div
                    v-if="openCategories.includes(category.id)"
                    class="p-4 border-t grid grid-cols-2 gap-2"
                >
                    <label
                        v-for="sub in category.sub_categories"
                        :key="sub.id"
                        class="flex items-center space-x-2"
                    >
                        <input
                            type="checkbox"
                            class="form-checkbox text-blue-600"
                            :value="sub.id"
                            v-model="selectedIds"
                            @change="syncSelectedSubCategories"
                        />
                        <span>{{ sub.name }}</span>
                    </label>
                </div>
            </div>
        </div>
        <div class="mt-6 text-right">
            <PrimaryButton @click="submitSelectedSubCategories"
                >
                Отправить
            </PrimaryButton>

        </div>
    </div>

</template>

