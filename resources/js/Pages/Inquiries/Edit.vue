<template>
    <Head title='Anfrage Bearbeiten' />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h1><b>ID: {{ inquiry.id }}</b> Anfrage Daten Bearbeiten</h1>
                <div class="space-x-3">
                    <BaseButton :href="route('inquiries')" color="back" btn-type="rounded">
                        <i class="fa-solid fa-delete-left"></i>
                    </BaseButton>
                </div>
            </div>
        </template>

        <div class="py-12 space-y-6">
            <PageBoxWrapper class="relative">
                <InquiryDataForm :inquiry="inquiry"></InquiryDataForm>
            </PageBoxWrapper>

            <PageBoxWrapper>
                <InquiryProductsTable :products="products"></InquiryProductsTable>
            </PageBoxWrapper>

            <PageBoxWrapper>
                <InquiryRequestsTable :inquiry-requests="requests"></InquiryRequestsTable>
            </PageBoxWrapper>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import PageBoxWrapper from '@/Components/PageBoxWrapper.vue'
import InquiryDataForm from '@/Components/InquiryDataForm.vue'
import BaseButton from '@/Components/BaseButton.vue'
import InquiryProductsTable from '@/Components/InquiryProductsTable.vue'
import InquiryRequestsTable from '@/Components/InquiryRequestsTable.vue'
import { Head } from "@inertiajs/vue3";

const props = defineProps({
    inquiry: Object,
    products: Object,
    requests: Object,
})
</script>