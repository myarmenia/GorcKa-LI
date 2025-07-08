<script setup>
import { useTrans } from '/resources/js/trans';
import { useForm } from '@inertiajs/vue3'
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useModalStore } from '@/Stores/modalStore'

const modal = useModalStore()

const props = defineProps({
    locale: String,
    taskId: Number,
    notificationId: Number
})

const emit = defineEmits(['close', 'submitted'])

const form = useForm({
  task_id: props.taskId,
  notification_id: props.notificationId,
  description: '',
  mark: null,
})


const submit = async () => {
    try {
        const response = await axios.post(route('user.comment_mark', { locale: props.locale }), form)

        modal.showSuccess(response?.data?.message)

        emit('submitted', {
            notificationId: props.notificationId,
            taskId: props.taskId,
            message: response?.data?.message,
        })

        emit('close')
        form.reset()
    } catch (error) {

        let message = error?.response?.data?.message || 'Произошла ошибка при отправке комментария.'
        message = message.replace(/\s?\(and.*?\)$/i, '')

        modal.showError(message)
        console.error('Ошибка при отправке:', error)
    }
}


</script>

<template>
    <teleport to="body">
        <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-xl w-full max-w-md relative shadow-xl">
                <!-- <button class="absolute top-2 right-2 text-xl" @click="$emit('close')"><i class="uil uil-times"></i></button> -->
                <button @click="$emit('close')" class="w-10 h-10 text-lg absolute top-2 right-2 text-red-500 rounded bg-red-500/20 flex items-center justify-center hover:bg-red-500/30 transition"><i class="uil uil-multiply"></i></button>

                <h2 class="text-xl font-bold mb-4">{{useTrans('modal.comment_modal.title')}}</h2>

                <form @submit.prevent="submit">
                    <textarea
                        v-model="form.description"
                        class="w-full border rounded p-2 mb-4"
                        rows="4"
                        :placeholder="useTrans('modal.comment_modal.placeholder')"
                    ></textarea>

                    <div class="flex flex-col items-end justify-end gap-1 mb-2">
                        <div>
                            <span
                                v-for="n in 5"
                                :key="n"
                                @click="form.mark = n"
                                class="cursor-pointer text-2xl"
                                :class="form.mark >= n ? 'text-yellow-400' : 'text-gray-300'"
                            >
                                ★
                            </span>
                        </div>
                        <div>
                            <PrimaryButton type="submit" :disabled="form.processing">
                                {{ form.processing ? 'Отправка...' : useTrans('modal.comment_modal.button_save') }}
                            </PrimaryButton>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </teleport>
  </template>

