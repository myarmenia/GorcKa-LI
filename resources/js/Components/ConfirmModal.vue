<script setup>
import { useTrans } from '/resources/js/trans';

const props = defineProps({
    title: String,
    message: String
})

defineEmits(['confirm', 'cancel'])
</script>



<template>
    <teleport to="body">
        <div class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center">
            <div class="bg-white rounded-xl p-6 w-full max-w-md relative shadow-xl">
                <button @click="$emit('cancel')" class="w-10 h-10 text-lg absolute top-2 right-2 text-red-500 rounded bg-red-500/20 flex items-center justify-center hover:bg-red-500/30 transition"><i class="uil uil-multiply"></i></button>

                <h2 class="text-lg font-bold mb-4">{{ props.title }}</h2>
                <p class="mb-6">{{ props.message }}</p>

                <div class="flex justify-end gap-2">
                    <button @click="$emit('cancel')" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 transition">{{ useTrans('modal.confirm_modal_delete_all.cancel') }}</button>
                    <button @click="$emit('confirm')" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">{{ useTrans('modal.confirm_modal_delete_all.confirm') }}</button>
                </div>
            </div>
        </div>
    </teleport>
</template>


