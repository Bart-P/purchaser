<template>
    <Head title="Anfragen" />

    <AuthenticatedLayout>
        <template #header>
            Alle Anfragen
        </template>

        <div class="py-12">
            <PageBoxWrapper>
                <div class="p-6 text-gray-900">Hier kommt die Tabelle mit allen Anfragen hin</div>
            </PageBoxWrapper>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>

import PageBoxWrapper from "@/Components/PageBoxWrapper.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/inertia-vue3";
</script>