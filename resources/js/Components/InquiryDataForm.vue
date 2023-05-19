<template>
    <form class="flex gap-6 w-full" @submit.prevent="" action="#">
        <div class="absolute right-12">
            <div class="flex gap-3">
                <DeleteInquiryWithConfirmation :id="'DeleteModalWithButton-' + inquiryDataForm.id"
                    :inquiry="inquiryDataForm" button-type="button">
                </DeleteInquiryWithConfirmation>

                <BaseButton @click="submitInquiryUpdateForm" color="success" btn-type="rounded">
                    <i class="fa-solid fa-save" />
                </BaseButton>
            </div>
        </div>
        <div class="w-1/2 space-y-3">
            <h3 class="heading-3">Daten:</h3>

            <div class="flex items-center gap-3">
                <InputLabel class="w-1/4" for="status">Status:</InputLabel>

                <div class="text-start w-full">
                    <InquiryStatusDropdown :current-status="inquiryDataForm.status" @select-status="selectStatus" />
                </div>
            </div>

            <div class="flex items-center gap-3">
                <InputLabel class="w-1/4" for="title">Titel:</InputLabel>
                <TextInput class="w-3/4" id="title" v-model="inquiryDataForm.title" type="text" name="title" />
            </div>

            <div class="flex items-center gap-3">
                <InputLabel class="w-1/4" for="offers_until">Angebote bis:</InputLabel>
                <div class="w-full">
                    <DatePicker v-model="inquiryDataForm.offers_until" />
                </div>
            </div>

            <div class="flex items-center gap-3">
                <InputLabel class="w-1/4" for="delivery_date">Lieferdatum:</InputLabel>
                <div class="w-full">
                    <DatePicker v-model="inquiryDataForm.delivery_date" />
                </div>
            </div>

            <div class="flex items-center justify-end gap-3">
                <InputLabel class="w-1/4" for="project">Projekt Nr:</InputLabel>
                <TextInput class="w-3/4" id="project" v-model="inquiryDataForm.project" type="text" name="project" />
            </div>

            <div class="flex items-center justify-end gap-3">
                <InputLabel class="w-1/4" for="pm">Projektleiter:</InputLabel>
                <TextInput class="w-3/4" id="pm" v-model="inquiryDataForm.pm" type="text" name="title" />
            </div>

            <div class="flex items-center justify-end gap-3">
                <InputLabel class="w-1/4" for="client">Kunde:</InputLabel>
                <TextInput class="w-3/4" id="client" v-model="inquiryDataForm.client" type="text" name="title" />
            </div>
        </div>

        <div class="w-1/2">
            <h3 class="heading-3 mb-6">
                Beschreibung:
            </h3>

            <div class="border border-gray-300 rounded-md">
                <div class="px-4 py-2 bg-white rounded-md">
                    <textarea id="description" rows="20" class="w-full px-0 text-gray-900 bg-white border-0 focus:ring-0"
                        v-model="inquiryDataForm.description" placeholder="Hier kommt die Beschreibung hin." required />
                </div>
            </div>
        </div>
    </form>
</template>

<script setup>
import DeleteInquiryWithConfirmation from '@/Pages/Inquiries/Partials/DeleteInquiryWithConfirmation.vue'
import InquiryStatusDropdown from '@/Pages/Inquiries/Partials/InquiryStatusDropdown.vue'
import BaseButton from '@/Components/BaseButton.vue'
import InputLabel from '@/Components/InputLabel.vue'
import TextInput from '@/Components/TextInput.vue'
import DatePicker from '@/Components/DatePicker.vue'
import { router, useForm } from "@inertiajs/vue3";

const props = defineProps({
    inquiry: Object
});

const emits = defineEmits(['updateInquiry']);

const inquiryDataForm = useForm(props.inquiry)

function submitInquiryUpdateForm() {
    router.patch(route('inquiries.patch', inquiryDataForm))
}

function selectStatus(status) {
    inquiryDataForm.status = status;
}
</script>
