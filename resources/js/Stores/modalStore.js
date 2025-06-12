import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useModalStore = defineStore('modal', () => {
    const successMessage = ref('')
    const visible = ref(false)

    function showSuccess(message) {
        successMessage.value = message
        visible.value = true

        setTimeout(() => {
            visible.value = false
            successMessage.value = ''
        }, 3000)
    }

    function hide() {
        visible.value = false
        successMessage.value = ''
    }

    return {
        successMessage,
        visible,
        showSuccess,
        hide,
    }
})
