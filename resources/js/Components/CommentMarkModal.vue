<script setup>
import { useForm } from '@inertiajs/vue3'
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { locale } from 'dayjs';

const props = defineProps({
    locale: String,
    notificationId: Number,
})

const emit = defineEmits(['close', 'submitted'])

const form = useForm({
  notification_id: props.notificationId,
  comment: '',
  mark: 0,
})


const submit = () => {

    form.post(route('user.comment_mark', { locale: props.locale }), {

        onFinish: () =>{
            emit('submitted')
            emit('close')
            form.reset()
        }
    });
};
</script>

<template>
    <teleport to="body">
        <div class="fixed inset-0 bg-black/40 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-xl w-full max-w-md relative shadow-xl">
                <!-- <button class="absolute top-2 right-2 text-xl" @click="$emit('close')"><i class="uil uil-times"></i></button> -->
                <button @click="$emit('close')" class="w-10 h-10 text-lg absolute top-2 right-2 text-red-500 rounded bg-red-500/20 flex items-center justify-center hover:bg-red-500/30 transition"><i class="uil uil-multiply"></i></button>

                <h2 class="text-xl font-bold mb-4">Оставьте отзыв</h2>

                <form @submit.prevent="submit">
                    <textarea
                        v-model="form.comment"
                        class="w-full border rounded p-2 mb-4"
                        rows="4"
                        placeholder="Комментарий..."
                    ></textarea>

                    <div class="flex items-center gap-1 mb-4">
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

                    <PrimaryButton type="submit" :disabled="form.processing">
                    {{ form.processing ? 'Отправка...' : 'Отправить' }}
                    </PrimaryButton>

                    <div v-if="form.errors.comment" class="text-red-500 mt-2 text-sm">
                    {{ form.errors.comment }}
                    </div>
                    <div v-if="form.errors.mark" class="text-red-500 mt-2 text-sm">
                    {{ form.errors.mark }}
                    </div>
                </form>
            </div>
        </div>
    </teleport>
  </template>

