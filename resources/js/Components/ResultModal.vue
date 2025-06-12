<script setup>
    import { storeToRefs } from 'pinia'
    import { useModalStore } from '@/Stores/modalStore'

    const modal = useModalStore()
    const { successMessage, visible } = storeToRefs(modal)
</script>


<template>
    <Transition name="fade">
        <div
            v-if="visible"
            class="fixed top-5 right-5 max-w-md w-full bg-green-500 text-green-600 px-6 py-4 rounded-xl shadow-2xl z-50 text-lg"
        >
            {{ successMessage }}
        </div>
    </Transition>
</template>


<style scoped>
    .fade-enter-active,
    .fade-leave-active {
    transition: opacity 0.3s ease;
    }
    .fade-enter-from,
    .fade-leave-to {
    opacity: 0;
    }
</style>
