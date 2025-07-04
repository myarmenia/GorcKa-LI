<script setup>
import { useTrans } from '@/trans';
import { defineProps, computed } from 'vue'

const props = defineProps({

  user: Object,
  categories:Array,
})



const getTranslatedExecutorSubCategories = computed(() => {
  if (!props.user || !props.categories) return [];

  const result = [];

  props.user.executor_sub_categories?.forEach(userSub => {
    const subCategoryId = userSub.pivot?.sub_category_id;
    if (!subCategoryId) return;

    // Ищем по всем категориям
    for (const category of props.categories) {
      const sub = category.sub_categories.find(sc => sc.id === subCategoryId);
      if (sub) {
        result.push({
          id: sub.id,
          name: sub.name,
          color: category.color,
          categoryName: category.name
        });
        break;
      }
    }
  });

  return result;
});
console.log(getTranslatedExecutorSubCategories.value,"getTranslatedExecutorSubCategories")

</script>

<template>
    <h6 class="mb-3 font-semibold text-gray-900 text-17 dark:text-gray-50">{{ useTrans('page.preferred_categories') }}</h6>

    <div class="flex flex-wrap gap-2 mt-2">
        <span
            v-for="(item, index) in getTranslatedExecutorSubCategories"
            :key="index"
            class="px-2 py-1 font-medium rounded text-13"
            :class="`text-${item.color}-500 bg-${item.color}-500/20`"
        >
            {{ item.name }}
        </span>
    </div>
</template>
