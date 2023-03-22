<template>
    <section class="space-y-6">
        <header>
            <h2 class="heading-2">Konto Löschen</h2>

            <p class="mt-1 text-sm text-gray-600">
                Sobald Ihr konto gelöscht ist, sind alle daten unwiederruflich weg!
            </p>
        </header>

        <BaseButton @click="confirmUserDeletion"
                    color="danger">Konto Löschen
        </BaseButton>

        <Modal :show="confirmingUserDeletion"
               @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">
                    Bist du Sicher?
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    Alle Daten werden unwiederruflich gelöscht! Bitte Passwort eingeben um dieses Konto permanent zu
                    Löschen.
                </p>

                <div class="mt-6">
                    <InputLabel for="password"
                                value="Password"
                                class="sr-only" />

                    <TextInput
                        id="password"
                        ref="passwordInput"
                        v-model="form.password"
                        type="password"
                        class="mt-1 block w-3/4"
                        placeholder="Password"
                        @keyup.enter="deleteUser"
                    />

                    <InputError :message="form.errors.password"
                                class="mt-2" />
                </div>

                <div class="mt-6 flex justify-end">
                    <BaseButton color="light"
                                @click="closeModal">Abbrechen
                    </BaseButton>

                    <BaseButton color="danger"
                                :class="{ 'opacity-25': form.processing }"
                                class="ml-3"
                                :disabled="form.processing"
                                @click="deleteUser">
                        Konto Löschen
                    </BaseButton>
                </div>
            </div>
        </Modal>
    </section>
</template>

<script setup>
import BaseButton from '@/Components/BaseButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import TextInput from '@/Components/TextInput.vue';
import {useForm} from '@inertiajs/inertia-vue3';
import {nextTick, ref} from 'vue';

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm(
    {
        password: '',
    });

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    nextTick(() => passwordInput.value.focus());
};

const deleteUser = () => {
    form.delete(route('profile.destroy'), {
        preserveScroll: true,
        onSuccess     : () => closeModal(),
        onError       : () => passwordInput.value.focus(),
        onFinish      : () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.reset();
};
</script>