<template>
    <Head title="Anfragen" />

    <AuthenticatedLayout>
        <template #header>
            Alle Anfragen
        </template>

        <div class="py-12">
            <PageBoxWrapper>

                <div class="w-full">
                    <BaseButton :href="route('inquiries.create')" color="success" btn-type="rounded" class="ml-auto mb-3">
                        <i class="fa-solid fa-plus"></i>
                    </BaseButton>
                </div>
                <InquiriesTable :inquiries="inquiries"></InquiriesTable>
            </PageBoxWrapper>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>

import PageBoxWrapper from "@/Components/PageBoxWrapper.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import InquiriesTable from "@/Components/InquiriesTable.vue"
import BaseButton from "@/Components/BaseButton.vue";

const props = defineProps({
    inquiries: Object
});
</script>