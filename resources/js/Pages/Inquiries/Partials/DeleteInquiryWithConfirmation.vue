<template>
    <BaseButton v-if="buttonType === 'button'" @click="deleteConfirmationModal.show()" color="danger"
        class="!px-3 rounded-full text-sm">
        <i class="fa-solid fa-trash"></i>
    </BaseButton>

    <IconButton v-if="buttonType === 'icon'" @click="deleteConfirmationModal.show()" color="red">
        <i class="fa-solid fa-trash"></i>
    </IconButton>

    <DeleteConfirmationModal :id="id">
        <template #text>
            Die Anfrage
            <span class="font-bold">"{{ inquiry.title }} (ID: {{ inquiry.id }})"</span>
            wird unwiederruflich gelöscht!
        </template>

        <template #buttons>
            <BaseButton @click="deleteInquiry()" color="danger">
                Löschen
            </BaseButton>

            <BaseButton @click="deleteConfirmationModal.hide()" color="back">
                Abbrechen
            </BaseButton>
        </template>
    </DeleteConfirmationModal>
</template>

<script setup>

import BaseButton from '@/Components/BaseButton.vue'
import IconButton from '@/Components/IconButton.vue'
import DeleteConfirmationModal from '@/Components/DeleteConfirmationModal.vue'
import { router } from "@inertiajs/vue3";
import { onMounted } from 'vue'
import { initModals } from 'flowbite'

let deleteConfirmationModal

onMounted(() => {
    initModals()
    deleteConfirmationModal = new Modal(document.getElementById(props.id))
})

const props = defineProps({
    inquiry: Object,
    buttonType: String,
    id: String,
});

function deleteInquiry() {
    deleteConfirmationModal.hide()
    router.delete(route('inquiries.destroy', props.inquiry.id))
}

</script>








