<template>
    <section>
        <header>
            <h2 class="heading-2">Passwort Ändern</h2>

            <p class="mt-1 text-sm text-gray-600">
                Stelle bitte sicher, dass dein Passwort lang ist und aus zufälligen Zeichen besteht.

            </p>
        </header>

        <form @submit.prevent="updatePassword"
              class="mt-6 space-y-6">
            <div>
                <InputLabel for="current_password"
                            value="Aktuelles Passwort" />

                <TextInput
                    id="current_password"
                    ref="currentPasswordInput"
                    v-model="form.current_password"
                    type="password"
                    class="mt-1 block w-full"
                    autocomplete="current-password"
                />

                <InputError :message="form.errors.current_password"
                            class="mt-2" />
            </div>

            <div>
                <InputLabel for="password"
                            value="Neues Passwort" />

                <TextInput
                    id="password"
                    ref="passwordInput"
                    v-model="form.password"
                    type="password"
                    class="mt-1 block w-full"
                    autocomplete="new-password"
                />

                <InputError :message="form.errors.password"
                            class="mt-2" />
            </div>

            <div>
                <InputLabel for="password_confirmation"
                            value="Neues Passwort Bestätigen" />

                <TextInput
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    autocomplete="new-password"
                />

                <InputError :message="form.errors.password_confirmation"
                            class="mt-2" />
            </div>

            <div class="flex items-center gap-4">
                <BaseButton color="primary"
                            :disabled="form.processing">Speichern
                </BaseButton>

                <Transition enter-from-class="opacity-0"
                            leave-to-class="opacity-0"
                            class="transition ease-in-out">
                    <p v-if="form.recentlySuccessful"
                       class="text-sm text-gray-600">Gespeichert.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>

<script setup>
import BaseButton from '@/Components/BaseButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import {useForm} from '@inertiajs/inertia-vue3';
import {ref} from 'vue';

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = useForm(
    {
        current_password     : '',
        password             : '',
        password_confirmation: '',
    });

const updatePassword = () => {
    form.put(route('password.update'), {
        preserveScroll: true,
        onSuccess     : () => form.reset(),
        onError       : () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation');
                passwordInput.value.focus();
            }
            if (form.errors.current_password) {
                form.reset('current_password');
                currentPasswordInput.value.focus();
            }
        },
    });
};
</script>