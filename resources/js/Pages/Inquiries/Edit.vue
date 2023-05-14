<template>
    <Head title='Anfrage Bearbeiten' />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <div class="">Anfrage (ID {{ inquiryDataForm.id }}) Daten Bearbeiten:</div>
                <div class="space-x-3">
                    <BaseButton color="danger" class="!px-3 rounded-full text-sm">
                        <i class="fa-solid fa-trash"></i>
                    </BaseButton>
                    <BaseButton :href="route('inquiries.show', inquiry.id)" color="back" class="!px-3 rounded-full text-sm">
                        <i class="fa-solid fa-delete-left"></i>
                    </BaseButton>
                </div>
            </div>
        </template>

        <div class="py-12">
            <PageBoxWrapper>
                <form class="flex gap-6 w-full">
                    <div class="w-1/2 space-y-3" @submit.prevent="" action="#">
                        <h3 class="heading-3">Daten:</h3>
                        <div class="flex items-center gap-3">
                            <InputLabel class="w-1/4" for="id">ID:</InputLabel>
                            <div class="w-full">{{ inquiryDataForm.id }}</div>
                        </div>
                        <div class="flex items-center gap-3">
                            <InputLabel class="w-1/4" for="title">Titel:</InputLabel>
                            <TextInput class="w-3/4" id="title" v-model="inquiryDataForm.title" type="text" name="title" />
                        </div>
                        <div class="flex items-center gap-3">
                            <InputLabel class="w-1/4" for="status">Status:</InputLabel>
                            <div class="text-start w-full py-2">
                                <StatusBadge :status="inquiryDataForm.status" />
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <InputLabel class="w-1/4" for="offers_until">Angebote bis:</InputLabel>
                            <DatePicker class="w-full" v-model="inquiryDataForm.offers_until" />
                        </div>
                        <div class="flex items-center gap-3">
                            <InputLabel class="w-1/4" for="delivery_date">Lieferdatum:</InputLabel>
                            <DatePicker class="w-full" v-model="inquiryDataForm.delivery_date" />
                        </div>
                        <div class="flex items-center justify-end gap-3">
                            <InputLabel class="w-1/4" for="project">Projekt Nr:</InputLabel>
                            <TextInput class="w-3/4" id="project" v-model="inquiryDataForm.project" type="text"
                                name="project">
                            </TextInput>
                        </div>
                        <div class="flex items-center justify-end gap-3">
                            <InputLabel class="w-1/4" for="pm">Projektleiter:</InputLabel>
                            <TextInput class="w-3/4" id="pm" v-model="inquiryDataForm.pm" type="text" name="title">
                            </TextInput>
                        </div>
                        <div class="flex items-center justify-end gap-3">
                            <InputLabel class="w-1/4" for="client">Kunde:</InputLabel>
                            <TextInput class="w-3/4" id="client" v-model="inquiryDataForm.client" type="text" name="title">
                            </TextInput>
                        </div>
                    </div>
                    <div class="w-1/2">
                        <div class="">
                            <h3 class="heading-3 mb-3">
                                Beschreibung:
                            </h3>
                            <div class="border border-gray-300 rounded-md">
                                <div class="px-4 py-2 bg-white rounded-md">
                                    <textarea id="description" rows="20"
                                        class="w-full px-0 text-gray-900 bg-white border-0 focus:ring-0"
                                        v-model="inquiryDataForm.description" placeholder="Hier kommt die Beschreibung hin."
                                        required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </PageBoxWrapper>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import PageBoxWrapper from '@/Components/PageBoxWrapper.vue'
import BaseButton from '@/Components/BaseButton.vue'
import InputLabel from '@/Components/InputLabel.vue'
import TextInput from '@/Components/TextInput.vue'
import StatusBadge from '@/Components/StatusBadge.vue'
import DatePicker from '@/Components/DatePicker.vue'
import { Head, useForm } from "@inertiajs/vue3";

const props = defineProps({
    inquiry: Object,
})

const inquiryDataForm = useForm(props.inquiry)

</script>