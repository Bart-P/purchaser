<template>
    <Head title='Anfrage Bearbeiten' />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <div class="">
                    Anfrage ID {{ props.inquiry.id }}:
                    <span class="text-gray-500">{{ props.inquiry.title }}</span>
                </div>
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
            <PageBoxWrapper>test</PageBoxWrapper>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PageBoxWrapper from '@/Components/PageBoxWrapper.vue'
import BaseButton from '@/Components/BaseButton.vue'
import { Head } from "@inertiajs/vue3";

const props = defineProps({
    inquiry: Object,
})

</script>

