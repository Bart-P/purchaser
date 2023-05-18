<template>
    <Head title="Anfrage" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <div class="">
                    Anfrage ID {{ props.inquiry.id }}:
                    <span class="text-gray-500">{{ props.inquiry.title }}</span>
                </div>

                <div class="space-x-3">
                    <BaseButton :href="route('inquiries')" color="back" class="!px-3 rounded-full text-sm">
                        <i class="fa-solid fa-delete-left"></i>
                    </BaseButton>
                </div>
            </div>
        </template>

        <div class="py-12 space-y-6">
            <PageBoxWrapper>
                <InquiryData :inquiry="inquiry"></InquiryData>
            </PageBoxWrapper>

            <PageBoxWrapper>
                <InquiryProductsTable :products="products"></InquiryProductsTable>
            </PageBoxWrapper>

            <PageBoxWrapper>
                <InquiryRequestsTable :inquiry-requests="inquiryRequests"></InquiryRequestsTable>
            </PageBoxWrapper>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PageBoxWrapper from '@/Components/PageBoxWrapper.vue'
import { Head } from "@inertiajs/vue3";
import BaseButton from '@/Components/BaseButton.vue';
import InquiryData from '@/Components/InquiryData.vue'
import InquiryProductsTable from '@/Components/InquiryProductsTable.vue'
import InquiryRequestsTable from '@/Components/InquiryRequestsTable.vue'

const props = defineProps({
    inquiry: Object,
    products: Object,
    inquiryRequests: Object
});
</script>