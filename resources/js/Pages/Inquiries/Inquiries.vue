<template>
    <Head title="Anfragen" />

    <AuthenticatedLayout>
        <template #header>
            Alle Anfragen
        </template>

        <div class="py-12">
            <PageBoxWrapper>
                <InquiriesTable></InquiriesTable>

            </PageBoxWrapper>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>

import PageBoxWrapper from "@/Components/PageBoxWrapper.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/inertia-vue3";
import InquiriesTable from "@/Pages/Inquiries/Partials/InquiriesTable.vue"
</script>