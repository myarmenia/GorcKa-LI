
<script setup>

import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { useForm } from '@inertiajs/vue3';

import { computed, ref, defineProps, watch } from "vue";
import { useModalStore } from '@/Stores/modalStore'
import { useTrans } from '/resources/js/trans';

const modal = useModalStore()

const props = defineProps({
    locale: String,
});

const currentLanguage = computed(() => props.locale);

watch(currentLanguage, () => {
  form.errors = {};
});


const form = useForm({
  current_password: '',
  password: '',
  password_confirmation: '',
})

const submit = () => {
  form.post(route('profile.password.update', { locale: props.locale }), {
    onSuccess: () => {
      modal.showSuccess(useTrans('app.messages.password_updated'))
      form.reset()
    },
    onError: () => {
      // Ошибки отобразятся через InputError
    },
  })
}




</script>

<template>
    <div class=" space-x-8">

        <form  @submit.prevent="submit" class="mt-8">

            <!--end socia-media-->
            <div class="mt-4">
                <h5 class="mb-3 font-semibold text-17 dark:text-gray-50">
                    {{ useTrans('page.change_password.title') }}
                </h5>
                <div class="grid grid-cols-12 gap-5">
                    <div class="col-span-12">

                        <div class="mb-3">
                            <InputLabel for="current-password-input" :value="useTrans('form.current_password')" class="text-sm text-gray-900 dark:text-gray-50" />

                            <TextInput id="current-password-input" type="password"
                                class="w-full mt-1 text-gray-500 border rounded border-gray-100/80 text-13 dark:bg-transparent dark:border-neutral-600"
                                v-model="form.current_password"
                                :placeholder="useTrans('form.current_password_placeholder')" />

                            <InputError class="mt-2 opacity-60"
                                :message="form.errors.current_password" />
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-span-12 lg:col-span-6">
                         <div class="mb-3">
                            <InputLabel for="password" :value="useTrans('form.password')" class="text-sm text-gray-900 dark:text-gray-50" />

                            <TextInput id="password" type="password"
                                class="w-full mt-1 text-gray-500 border rounded border-gray-100/80 text-13 dark:bg-transparent dark:border-neutral-600"
                                v-model="form.password"
                                :placeholder="useTrans('form.password_placeholder')" />

                            <InputError class="mt-2 opacity-60"
                                :message="form.errors.password" />
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-span-12 lg:col-span-6">
                        <div class="mb-3">
                            <InputLabel for="password_confirmation" :value="useTrans('form.password_confirmation')" class="text-sm text-gray-900 dark:text-gray-50" />

                            <TextInput id="password_confirmation" type="password"
                                class="w-full mt-1 text-gray-500 border rounded border-gray-100/80 text-13 dark:bg-transparent dark:border-neutral-600"
                                v-model="form.password_confirmation"
                                :placeholder="useTrans('form.password_confirmation_placeholder')" />

                            <InputError class="mt-2 opacity-60"
                                :message="form.errors.password_confirmation" />
                        </div>
                    </div>

                    <!--end col-->
                </div>
                <!--end row-->
            </div>
            <!--end Change-password-->
            <div class="mt-8 text-right">
                <PrimaryButton :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing">
                    {{ useTrans('page.default.save') }}
                </PrimaryButton>
            </div>
        </form>
    </div>

</template>

