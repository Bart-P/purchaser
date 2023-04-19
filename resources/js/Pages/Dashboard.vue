<script setup>
import PageBoxWrapper from '@/Components/PageBoxWrapper.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            Übersicht
        </template>

        <div class="py-12">
            <PageBoxWrapper>
                <div class="p-6 text-gray-900">
                    Mal gucken ob wir das Dashboard brauchen. Solle eine Übersicht sein mit
                    offenen Anfragen und Lieferanten bei den noch angebote ausstehen
                </div>
            </PageBoxWrapper>
        </div>
    </AuthenticatedLayout>
</template>