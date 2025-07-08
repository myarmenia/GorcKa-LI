<script setup>
    import { storeToRefs } from 'pinia'
    import { useModalStore } from '@/Stores/modalStore'

    const modal = useModalStore()
    const { successMessage, errorMessage, visible } = storeToRefs(modal)
</script>


<template>
    <Transition name="fade">
        <div
            v-if="visible"
            :class="[
            'fixed top-10 right-5 max-w-md w-full px-6 py-6 rounded-xl shadow-2xl z-50 text-lg',
            successMessage ? 'bg-green-500/20 text-green-600' : '',
            errorMessage ? 'bg-red-500/20 text-red-600' : ''
            ]"
        >
            {{ successMessage || errorMessage }}
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
